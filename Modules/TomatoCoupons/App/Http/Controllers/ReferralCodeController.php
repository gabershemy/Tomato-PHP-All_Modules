<?php

namespace Modules\TomatoCoupons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ReferralCodeController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCoupons\App\Models\ReferralCode::class;
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
            view: 'tomato-coupons::referral-codes.index',
            table: \Modules\TomatoCoupons\App\Tables\ReferralCodeTable::class
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
            model: \Modules\TomatoCoupons\App\Models\ReferralCode::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-coupons::referral-codes.create',
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
            model: \Modules\TomatoCoupons\App\Models\ReferralCode::class,
            validation: [
            'account_id' => 'nullable|exists:accounts,id',
            'name' => 'required|max:255|string',
            'code' => 'required|max:255|string',
            'counter' => 'nullable',
            'is_activated' => 'nullable',
            'is_public' => 'nullable'
            ],
            message: __('Referral Code created successfully'),
            redirect: 'admin.referral-codes.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\ReferralCode $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoCoupons\App\Models\ReferralCode $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::referral-codes.show',
        );
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\ReferralCode $model
     * @return View
     */
    public function edit(\Modules\TomatoCoupons\App\Models\ReferralCode $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::referral-codes.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCoupons\App\Models\ReferralCode $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCoupons\App\Models\ReferralCode $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'account_id' => 'nullable|exists:accounts,id',
            'name' => 'sometimes|max:255|string',
            'code' => 'sometimes|max:255|string',
            'counter' => 'nullable',
            'is_activated' => 'nullable',
            'is_public' => 'nullable'
            ],
            message: __('Referral Code updated successfully'),
            redirect: 'admin.referral-codes.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCoupons\App\Models\ReferralCode $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCoupons\App\Models\ReferralCode $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Referral Code deleted successfully'),
            redirect: 'admin.referral-codes.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
