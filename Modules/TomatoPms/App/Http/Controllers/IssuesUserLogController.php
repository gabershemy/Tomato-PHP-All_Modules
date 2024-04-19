<?php

namespace Modules\TomatoPms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class IssuesUserLogController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoPms\App\Models\IssuesUserLog::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-pms::issues-user-logs.index',
            table: \Modules\TomatoPms\App\Tables\IssuesUserLogTable::class
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
            model: \Modules\TomatoPms\App\Models\IssuesUserLog::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-pms::issues-user-logs.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoPms\App\Models\IssuesUserLog::class,
            validation: [
                            'user_id' => 'required|exists:users,id',
            'model_type' => 'nullable|max:255|string',
            'model_id' => 'nullable',
            'status' => 'nullable|max:255|string',
            'action' => 'nullable|max:255|string',
            'description' => 'nullable',
            'data' => 'nullable'
            ],
            message: __('IssuesUserLog updated successfully'),
            redirect: 'admin.issues-user-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoPms\App\Models\IssuesUserLog $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoPms\App\Models\IssuesUserLog $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::issues-user-logs.show',
        );
    }

    /**
     * @param \Modules\TomatoPms\App\Models\IssuesUserLog $model
     * @return View
     */
    public function edit(\Modules\TomatoPms\App\Models\IssuesUserLog $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::issues-user-logs.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoPms\App\Models\IssuesUserLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoPms\App\Models\IssuesUserLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'user_id' => 'sometimes|exists:users,id',
            'model_type' => 'nullable|max:255|string',
            'model_id' => 'nullable',
            'status' => 'nullable|max:255|string',
            'action' => 'nullable|max:255|string',
            'description' => 'nullable',
            'data' => 'nullable'
            ],
            message: __('IssuesUserLog updated successfully'),
            redirect: 'admin.issues-user-logs.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoPms\App\Models\IssuesUserLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoPms\App\Models\IssuesUserLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('IssuesUserLog deleted successfully'),
            redirect: 'admin.issues-user-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
