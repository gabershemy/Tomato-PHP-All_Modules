<?php

namespace Modules\TomatoOrders\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class OrderLogController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoOrders\App\Models\OrderLog::class;
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
            view: 'tomato-orders::order-logs.index',
            table: \Modules\TomatoOrders\App\Tables\OrderLogTable::class
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
            model: \Modules\TomatoOrders\App\Models\OrderLog::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::order-logs.create',
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
            model: \Modules\TomatoOrders\App\Models\OrderLog::class,
            validation: [
            'user_id' => 'nullable|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'status' => 'nullable|max:255|string',
            'note' => 'required|max:65535',
            'is_closed' => 'nullable'
            ],
            message: __('Order Log created successfully'),
            redirect: 'admin.order-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\OrderLog $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoOrders\App\Models\OrderLog $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::order-logs.show',
        );
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\OrderLog $model
     * @return View
     */
    public function edit(\Modules\TomatoOrders\App\Models\OrderLog $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::order-logs.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoOrders\App\Models\OrderLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoOrders\App\Models\OrderLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'user_id' => 'nullable|exists:users,id',
            'order_id' => 'sometimes|exists:orders,id',
            'status' => 'nullable|max:255|string',
            'note' => 'sometimes|max:65535',
            'is_closed' => 'nullable'
            ],
            message: __('Order Log updated successfully'),
            redirect: 'admin.order-logs.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\OrderLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoOrders\App\Models\OrderLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Order Log deleted successfully'),
            redirect: 'admin.order-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
