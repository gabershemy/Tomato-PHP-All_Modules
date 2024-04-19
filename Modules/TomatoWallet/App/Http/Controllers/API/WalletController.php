<?php

namespace Modules\TomatoWallet\App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\TomatoWallet\App\Http\Resources\TransactionsResource;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class WalletController extends Controller
{

    /**
     * @var string
     */
    public string $model;

    public function __construct()
    {
        $this->model = config('tomato-crm.model');

    }

    public function deposit(Request $request){
        $request->validate([
           "amount" => "required|numeric|min:1",
           "payment_method" => "required|string|in:cash,paymob"
        ]);

        $wallet = auth()->user()->deposit($request->amount, ['payment_method' => $request->payment_method]);


        return response()->json([
            "status" => true,
            "message" => "Deposit successfully",
        ], 200);
    }

    public function transactions(Request $request){
        $request->validate([
           "type" => "nullable|string|in:deposit,withdraw,transfer"
        ]);

        $wallet  = Wallet::query();
        $wallet->where('holder_id', auth()->user()->id);
        $wallet->where('holder_type', $this->model);
        $wallet = $wallet->first();

        if($wallet){
            $transactions = Transaction::query();
            $transactions->where('wallet_id', $wallet->id);
            $transactions = $transactions->paginate(10);

            $collection = config('tomato-wallet.transaction_resource', TransactionsResource::class)::collection($transactions);
            return response()->json([
                "status" => true,
                "message" => "Transactions loaded successfully",
                "data" => $collection
            ], 200);
        }

        return response()->json([
            "status" => false,
            "message" => "Sorry User Don't Have Any Transactions",
        ], 401);
    }
}
