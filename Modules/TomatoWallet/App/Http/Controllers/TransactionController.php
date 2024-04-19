<?php

namespace Modules\TomatoWallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TransactionController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Transaction::class;
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
            view: 'tomato-wallet::transactions.index',
            table: \Modules\TomatoWallet\App\Tables\TransactionTable::class,
            query: Transaction::query()->where('payable_type', config('tomato-crm.model'))
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
            model: Transaction::class,
        );
    }

    /**
     * @param Transaction $model
     * @return View|JsonResponse
     */
    public function show(Transaction $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::transactions.show',
        );
    }

    /**
     * @param Transaction $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Transaction $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Transaction deleted successfully'),
            redirect: 'admin.transactions.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
