<?php

namespace Modules\TomatoOrders\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class DeliveryController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoOrders\App\Models\Delivery::class;
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
            view: 'tomato-orders::deliveries.index',
            table: \Modules\TomatoOrders\App\Tables\DeliveryTable::class
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
            model: \Modules\TomatoOrders\App\Models\Delivery::class,
            filters: [
                'shipping_vendor_id'
            ]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::deliveries.create',
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
            model: \Modules\TomatoOrders\App\Models\Delivery::class,
            validation: [
                'shipping_vendor_id' => 'required|integer|exists:shipping_vendors,id',
                'name' => 'required|max:255|string',
                'phone' => 'required|max:255',
                'address' => 'nullable|max:255|string',
                'is_activated' => 'nullable'
            ],
            message: __('Delivery created successfully'),
            redirect: 'admin.deliveries.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Delivery $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoOrders\App\Models\Delivery $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::deliveries.show',
        );
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Delivery $model
     * @return View
     */
    public function edit(\Modules\TomatoOrders\App\Models\Delivery $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::deliveries.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoOrders\App\Models\Delivery $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoOrders\App\Models\Delivery $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'shipping_vendor_id' => 'required|integer|exists:shipping_vendors,id',
                'name' => 'sometimes|max:255|string',
                'phone' => 'sometimes|max:255',
                'address' => 'nullable|max:255|string',
                'is_activated' => 'nullable'
            ],
            message: __('Delivery updated successfully'),
            redirect: 'admin.deliveries.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Delivery $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoOrders\App\Models\Delivery $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Delivery deleted successfully'),
            redirect: 'admin.deliveries.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
