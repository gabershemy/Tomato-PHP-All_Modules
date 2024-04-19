<?php

namespace Modules\TomatoWallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class WalletController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Wallet::class;
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
            view: 'tomato-wallet::wallets.index',
            table: \Modules\TomatoWallet\App\Tables\WalletTable::class
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
            model: Wallet::class,
        );
    }

    /**
     * @param Wallet $model
     * @return View|JsonResponse
     */
    public function show(Wallet $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::wallets.show',
        );
    }

    /**
     * @param Wallet $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Wallet $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Wallet deleted successfully'),
            redirect: 'admin.wallets.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    public function balanceView($model){
        $model = config('tomato-crm.model')::find($model);

        return view('tomato-wallet::wallets.add_balance', [
            'model' => $model
        ]);
    }

    public function balance(Request $request, $model){
        $request->validate([
            "new_balance" => "required|integer|min:1",
            "reason" => "nullable|string"
        ]);

        $model = config('tomato-crm.model')::find($model);

        $model->deposit($request->get('new_balance'), ['description' => $request->get('reason')]);

        Toast::success(__('Balance Updated Success'))->autoDismiss(2);
        return redirect()->back();
    }
}
