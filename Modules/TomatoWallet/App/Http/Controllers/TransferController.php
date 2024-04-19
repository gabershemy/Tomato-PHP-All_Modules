<?php

namespace Modules\TomatoWallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TransferController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Transfer::class;
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
            view: 'tomato-wallet::transfers.index',
            table: \Modules\TomatoWallet\App\Tables\TransferTable::class
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
            model: Transfer::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::transfers.create',
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
            model: Transfer::class,
            validation: [
            'deposit_id' => 'required|exists:transactions,id',
            'withdraw_id' => 'required|exists:transactions,id',
            'from_type' => 'required|max:255|string',
            'from_id' => 'required',
            'to_type' => 'required|max:255|string',
            'to_id' => 'required',
            'status' => 'required|string',
            'status_last' => 'nullable|string',
            'discount' => 'required',
            'fee' => 'required',
            'uuid' => 'required|max:36|string'
            ],
            message: __('Transfer created successfully'),
            redirect: 'admin.transfers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param Transfer $model
     * @return View|JsonResponse
     */
    public function show(Transfer $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::transfers.show',
        );
    }

    /**
     * @param Transfer $model
     * @return View
     */
    public function edit(Transfer $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::transfers.edit',
        );
    }

    /**
     * @param Request $request
     * @param Transfer $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, Transfer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'deposit_id' => 'sometimes|exists:transactions,id',
            'withdraw_id' => 'sometimes|exists:transactions,id',
            'from_type' => 'sometimes|max:255|string',
            'from_id' => 'sometimes',
            'to_type' => 'sometimes|max:255|string',
            'to_id' => 'sometimes',
            'status' => 'sometimes|string',
            'status_last' => 'nullable|string',
            'discount' => 'sometimes',
            'fee' => 'sometimes',
            'uuid' => 'sometimes|max:36|string'
            ],
            message: __('Transfer updated successfully'),
            redirect: 'admin.transfers.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param Transfer $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Transfer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Transfer deleted successfully'),
            redirect: 'admin.transfers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
