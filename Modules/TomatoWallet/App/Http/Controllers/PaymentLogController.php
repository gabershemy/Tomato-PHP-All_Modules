<?php

namespace Modules\TomatoWallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PaymentLogController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoWallet\App\Models\PaymentLog::class;
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
            view: 'tomato-wallet::payment-logs.index',
            table: \Modules\TomatoWallet\App\Tables\PaymentLogTable::class
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
            model: \Modules\TomatoWallet\App\Models\PaymentLog::class,
        );
    }


    /**
     * @param \Modules\TomatoWallet\App\Models\PaymentLog $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoWallet\App\Models\PaymentLog $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-logs.show',
        );
    }
    /**
     * @param \Modules\TomatoWallet\App\Models\PaymentLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoWallet\App\Models\PaymentLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('PaymentLog deleted successfully'),
            redirect: 'admin.payment-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
