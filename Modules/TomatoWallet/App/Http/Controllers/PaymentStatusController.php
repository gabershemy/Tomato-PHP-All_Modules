<?php

namespace Modules\TomatoWallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PaymentStatusController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoWallet\App\Models\PaymentStatus::class;
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
            view: 'tomato-wallet::payment-status.index',
            table: \Modules\TomatoWallet\App\Tables\PaymentStatusTable::class
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
            model: \Modules\TomatoWallet\App\Models\PaymentStatus::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::payment-status.create',
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
            model: \Modules\TomatoWallet\App\Models\PaymentStatus::class,
            validation: [
            'name' => 'required',
            'description' => 'nullable',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255'
            ],
            message: __('PaymentStatus updated successfully'),
            redirect: 'admin.payment-status.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoWallet\App\Models\PaymentStatus $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoWallet\App\Models\PaymentStatus $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-status.show',
        );
    }

    /**
     * @param \Modules\TomatoWallet\App\Models\PaymentStatus $model
     * @return View
     */
    public function edit(\Modules\TomatoWallet\App\Models\PaymentStatus $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-status.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoWallet\App\Models\PaymentStatus $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoWallet\App\Models\PaymentStatus $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'name' => 'sometimes',
            'description' => 'nullable',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255'
            ],
            message: __('Payment Status updated successfully'),
            redirect: 'admin.payment-status.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoWallet\App\Models\PaymentStatus $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoWallet\App\Models\PaymentStatus $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Payment Status deleted successfully'),
            redirect: 'admin.payment-status.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
