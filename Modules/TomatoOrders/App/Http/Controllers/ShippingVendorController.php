<?php

namespace Modules\TomatoOrders\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ShippingVendorController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoOrders\App\Models\ShippingVendor::class;
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
            view: 'tomato-orders::shipping-vendors.index',
            table: \Modules\TomatoOrders\App\Tables\ShippingVendorTable::class
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
            model: \Modules\TomatoOrders\App\Models\ShippingVendor::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::shipping-vendors.create',
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
            model: \Modules\TomatoOrders\App\Models\ShippingVendor::class,
            validation: [
                'name' => 'required|max:255|string',
                'contact_person' => 'nullable|max:255|string',
                'delivery_estimation' => 'nullable|max:255|string',
                'phone' => 'nullable|max:255',
                'address' => 'nullable|max:255|string',
                'is_activated' => 'nullable',
                'integration' => 'nullable'
            ],
            message: __('Shipping Vendor created successfully'),
            redirect: 'admin.shipping-vendors.index',
            hasMedia: true,
            collection: [
                "logo" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\ShippingVendor $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoOrders\App\Models\ShippingVendor $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::shipping-vendors.show',
            hasMedia: true,
            collection: [
                "logo" => false
            ]
        );
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\ShippingVendor $model
     * @return View
     */
    public function edit(\Modules\TomatoOrders\App\Models\ShippingVendor $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::shipping-vendors.edit',
            hasMedia: true,
            collection: [
                "logo" => false
            ]
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoOrders\App\Models\ShippingVendor $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoOrders\App\Models\ShippingVendor $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'name' => 'sometimes|max:255|string',
                'contact_person' => 'nullable|max:255|string',
                'delivery_estimation' => 'nullable|max:255|string',
                'phone' => 'nullable|max:255',
                'address' => 'nullable|max:255|string',
                'is_activated' => 'nullable',
                'integration' => 'nullable'
            ],
            message: __('Shipping Vendor updated successfully'),
            redirect: 'admin.shipping-vendors.index',
            hasMedia: true,
            collection: [
                "logo" => false
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\ShippingVendor $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoOrders\App\Models\ShippingVendor $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Shipping Vendor deleted successfully'),
            redirect: 'admin.shipping-vendors.index',
            hasMedia: true,
            collection: [
                "logo" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
