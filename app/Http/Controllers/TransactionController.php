<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\Admin\BaseResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BaseResource(Transaction::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sendMoney(StoreTransactionRequest $request)
    {
        $fromWallet = Wallet::findOrFail($request['from_wallet_id']);
        $toWallet = Wallet::findOrFail($request['to_wallet_id']);

        if ($fromWallet->balance < $request['amount']) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        DB::transaction(function () use ($fromWallet, $toWallet, $request) {
            $fromWallet->balance -= $request['amount'];
            $fromWallet->save();

            $toWallet->balance += $request['amount'];
            $toWallet->save();

            Transaction::create([
                'from_wallet_id' => $fromWallet->id,
                'to_wallet_id' => $toWallet->id,
                'amount' => $request['amount'],
                'transaction_type' => 'transfer',
            ]);
        });

        return response()->json(['message' => 'Transfer successful']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->deleteOrFail();
        return response("Deleted trnsaction id: ". $id, Response::HTTP_NO_CONTENT);
    }
}
