<?php

namespace Modules\TomatoPms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TimerController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoPms\App\Models\Timer::class;
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
            view: 'tomato-pms::timers.index',
            table: \Modules\TomatoPms\App\Tables\TimerTable::class
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
            model: \Modules\TomatoPms\App\Models\Timer::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-pms::timers.create',
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
            model: \Modules\TomatoPms\App\Models\Timer::class,
            validation: [
                            'project_id' => 'nullable|exists:projects,id',
            'issue_id' => 'nullable|exists:issues,id',
            'account_id' => 'nullable|exists:accounts,id',
            'employee_id' => 'required|exists:users,id',
            'type' => 'nullable|max:255|string',
            'status' => 'nullable|max:255|string',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255',
            'description' => 'nullable|max:255|string',
            'total_time' => 'nullable',
            'total_money' => 'nullable',
            'rounds' => 'nullable',
            'is_running' => 'nullable',
            'is_done' => 'nullable',
            'is_billable' => 'nullable',
            'is_paid' => 'nullable'
            ],
            message: __('Timer updated successfully'),
            redirect: 'admin.timers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Timer $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoPms\App\Models\Timer $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::timers.show',
        );
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Timer $model
     * @return View
     */
    public function edit(\Modules\TomatoPms\App\Models\Timer $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-pms::timers.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoPms\App\Models\Timer $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoPms\App\Models\Timer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'project_id' => 'nullable|exists:projects,id',
            'issue_id' => 'nullable|exists:issues,id',
            'account_id' => 'nullable|exists:accounts,id',
            'employee_id' => 'sometimes|exists:users,id',
            'type' => 'nullable|max:255|string',
            'status' => 'nullable|max:255|string',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255',
            'description' => 'nullable|max:255|string',
            'total_time' => 'nullable',
            'total_money' => 'nullable',
            'rounds' => 'nullable',
            'is_running' => 'nullable',
            'is_done' => 'nullable',
            'is_billable' => 'nullable',
            'is_paid' => 'nullable'
            ],
            message: __('Timer updated successfully'),
            redirect: 'admin.timers.index',
        );

        if($model->is_done){
            $model->end_at = Carbon::now();
            $model->total_time = $model->start_at->diffInMinutes($model->end_at) / 60;
            if($model->issue?->project?->rate){
                if($model->issue?->project?->rate_per == 'hour'){
                    $model->total_money = $model->total_time * $model->issue?->project?->rate;
                }
                if($model->issue?->project?->rate_per == 'day'){
                    $model->total_money = $model->total_time * ($model->issue?->project?->rate/8);
                }
                if($model->issue?->project?->rate_per == 'week'){
                    $model->total_money = $model->total_time * ($model->issue?->project?->rate/40);
                }
                if($model->issue?->project?->rate_per == 'month'){
                    $model->total_money = $model->total_time * ($model->issue?->project?->rate/160);
                }

                $model->save();
            }
        }

         if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \Modules\TomatoPms\App\Models\Timer $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoPms\App\Models\Timer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Timer deleted successfully'),
            redirect: 'admin.timers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }
}
