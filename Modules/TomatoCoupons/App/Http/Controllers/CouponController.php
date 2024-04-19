<?php

namespace Modules\TomatoCoupons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CouponController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCoupons\App\Models\Coupon::class;
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
            view: 'tomato-coupons::coupons.index',
            table: \Modules\TomatoCoupons\App\Tables\CouponTable::class
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
            model: \Modules\TomatoCoupons\App\Models\Coupon::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-coupons::coupons.create',
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
            model: \Modules\TomatoCoupons\App\Models\Coupon::class,
            validation: [
                'code' => 'required|max:255|string',
                'type' => 'nullable|max:255|string',
                'amount' => 'required',
                'is_limited' => 'nullable',
                'use_limit' => 'nullable',
                'use_limit_by_user' => 'nullable',
                'order_total_limit' => 'nullable',
                'is_activated' => 'nullable',
                'is_marketing' => 'nullable',
                'marketer_name' => 'nullable|max:255|string',
                'marketer_type' => 'nullable|max:255|string',
                'marketer_amount' => 'nullable',
                'marketer_amount_max' => 'nullable',
                'marketer_show_amount_max' => 'nullable',
                'marketer_hide_total_sales' => 'nullable',
                'is_used' => 'nullable',
                'apply_to' => 'nullable',
                'except' => 'nullable'
            ],
            message: __('Coupon created successfully'),
            redirect: 'admin.coupons.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\Coupon $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoCoupons\App\Models\Coupon $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::coupons.show',
        );
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\Coupon $model
     * @return View
     */
    public function edit(\Modules\TomatoCoupons\App\Models\Coupon $model): View
    {
        $model->apply_to ?? $model->apply_to  = (object)['categories' => [], 'products' => []];
        $model->except ?? $model->except = (object)['categories' => [], 'products' => []];

        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::coupons.edit'
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCoupons\App\Models\Coupon $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCoupons\App\Models\Coupon $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'code' => 'sometimes|max:255|string',
                'type' => 'nullable|max:255|string',
                'amount' => 'sometimes',
                'is_limited' => 'nullable',
                'use_limit' => 'nullable',
                'use_limit_by_user' => 'nullable',
                'order_total_limit' => 'nullable',
                'is_activated' => 'nullable',
                'is_marketing' => 'nullable',
                'marketer_name' => 'nullable|max:255|string',
                'marketer_type' => 'nullable|max:255|string',
                'marketer_amount' => 'nullable',
                'marketer_amount_max' => 'nullable',
                'marketer_show_amount_max' => 'nullable',
                'marketer_hide_total_sales' => 'nullable',
                'is_used' => 'nullable',
                'apply_to' => 'nullable',
                'except' => 'nullable'
            ],
            message: __('Coupon updated successfully'),
            redirect: 'admin.coupons.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\Coupon $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCoupons\App\Models\Coupon $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Coupon deleted successfully'),
            redirect: 'admin.coupons.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
