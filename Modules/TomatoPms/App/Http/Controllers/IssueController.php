<?php

namespace Modules\TomatoPms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoPms\App\Models\IssuesUserLog;
use Modules\TomatoPms\App\Models\Timer;

class IssueController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoPms\App\Models\Issue::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = $this->model::query();
        if($request->has('parent_id')){
            $query->where('parent_id', $request->parent_id);
        }
        else {
            $query->whereNull('parent_id');
        }
        if($request->has('sprint_id')){
            $query->where('sprint_id', $request->sprint_id);
        }
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-pms::issues.index',
            table: \Modules\TomatoPms\App\Tables\IssueTable::class,
            query: $query
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \Modules\TomatoPms\App\Models\Issue::class,
            filters: [
                'project_id',
                'sprint_id'
            ]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-pms::issues.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->merge([
           "reporter_id" => auth('web')->user()->id,
        ]);

        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoPms\App\Models\Issue::class,
            validation: [
                'reporter_id' => 'required|exists:users,id',
                'project_id' => 'required|exists:projects,id',
                'account_id' => 'nullable|exists:accounts,id',
                'closed_by_id' => 'nullable|exists:users,id',
                'last_update_by' => 'nullable',
                'sprint_id' => 'nullable|exists:sprints,id',
                'parent_id' => 'nullable',
                'type' => 'nullable|max:255|string',
                'status' => 'nullable|max:255|string',
                'priority' => 'nullable|max:255|string',
                'summary' => 'required|max:255|string',
                'description' => 'nullable',
                'points' => 'nullable',
                'icon' => 'nullable|max:255',
                'color' => 'nullable|max:255',
                'order' => 'nullable',
                'is_closed' => 'nullable'
            ],
            message: __('Issue updated successfully'),
            redirect: 'admin.issues.index',
        );

        IssuesUserLog::create([
            'user_id' => auth('web')->user()->id,
            'action' => 'created',
            'model_type' => 'Modules\TomatoPms\App\Models\Issue',
            'model_id' => $response->record->id,
            'status' => $response->record->status,
            'description' => 'Issue created',
        ]);

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Issue $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoPms\App\Models\Issue $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::issues.show',
        );
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Issue $model
     * @return View
     */
    public function edit(\Modules\TomatoPms\App\Models\Issue $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::issues.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoPms\App\Models\Issue $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoPms\App\Models\Issue $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'reporter_id' => 'sometimes|exists:users,id',
                'project_id' => 'sometimes|exists:projects,id',
                'account_id' => 'nullable|exists:accounts,id',
                'closed_by_id' => 'nullable|exists:users,id',
                'last_update_by' => 'nullable',
                'sprint_id' => 'nullable|exists:sprints,id',
                'parent_id' => 'nullable',
                'type' => 'nullable|max:255|string',
                'status' => 'nullable|max:255|string',
                'priority' => 'nullable|max:255|string',
                'summary' => 'sometimes|max:255|string',
                'description' => 'nullable',
                'points' => 'nullable',
                'icon' => 'nullable|max:255',
                'color' => 'nullable|max:255',
                'order' => 'nullable',
                'is_closed' => 'nullable'
            ],
            message: __('Issue updated successfully'),
            redirect: 'admin.issues.index',
        );

        IssuesUserLog::create([
            'user_id' => auth('web')->user()->id,
            'action' => 'updated',
            'model_type' => 'Modules\TomatoPms\App\Models\Issue',
            'model_id' => $response->record->id,
            'status' => $response->record->status,
            'description' => 'Issue updated',
        ]);

         if($response instanceof JsonResponse){
             return $response;
         }

        return back();
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Issue $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoPms\App\Models\Issue $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Issue deleted successfully'),
            redirect: 'admin.issues.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    public function comment(\Modules\TomatoPms\App\Models\Issue $model, Request $request)
    {
        $request->validate([
            "comment" => "required|string"
        ]);

        $model->issuesMetas()->create([
            'user_id' => auth('web')->user()->id,
            'key'=> 'comments',
            'value' => $request->get('comment'),
        ]);

        IssuesUserLog::create([
            'user_id' => auth('web')->user()->id,
            'action' => 'comment',
            'model_type' => 'Modules\TomatoPms\App\Models\Issue',
            'model_id' => $model->id,
            'status' => $model->status,
            'description' => $request->get('comment'),
        ]);

        return redirect()->to(route('admin.issues.show', $model->id).'?tab=comments');
    }

    public function timer(\Modules\TomatoPms\App\Models\Issue $model)
    {
        $hasActiveTimer = Timer::where('employee_id', auth('web')->user()->id)->where('end_at', null)->first();
        if($hasActiveTimer){
            Toast::danger(__('Sorry You Have Active Timer Please Close It First'))->autoDismiss(2);
            return back();
        }
        else {
            $model->timers()->create([
                'type' => $model->type,
                'description' => $model->summary,
                'status' => $model->status,
                'employee_id' => auth('web')->user()->id,
                'project_id' => $model->project_id,
                'sprint_id' => $model->sprint_id,
                'start_at' => Carbon::now(),
            ]);

            IssuesUserLog::create([
                'user_id' => auth('web')->user()->id,
                'action' => 'timer',
                'model_type' => 'Modules\TomatoPms\App\Models\Issue',
                'model_id' => $model->id,
                'status' => $model->status,
                'description' => 'Timer started',
            ]);
        }

        return back();
    }
}
