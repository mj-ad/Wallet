<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Http\Resources\Admin\BaseResource;
use App\Models\Wallet;
use App\Models\WalletType;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BaseResource(Wallet::with(['user', 'walletType'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request)
    {
        // Check if the user already has a wallet for the selected wallet type
        $existingWallet = Wallet::where('user_id', $request['user_id'])
            ->where('wallet_type_id', $request['wallet_type_id'])
            ->exists();

        if ($existingWallet) {
            return response()->json([
                'message' => 'You already have a wallet of this type.',
                'status' => 400,
            ], 400);
        }
        $walletType = WalletType::findOrFail($request['wallet_type_id']);

        // Check if the balance meets the minimum requirement
        if ($request['balance'] < $walletType->minimum_balance) {
            return response()->json([
                'message' => "The balance must be at least {$walletType->minimum_balance} for the wallet type {$walletType->name}.",
                'status' => 400,
            ], 400);
        }
    
        $wallet = Wallet::createOrFirst($request->all());
        return (new BaseResource($wallet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wallet = Wallet::with(['user', 'walletType'])->find($id);

        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found',
                'status' => 404,
            ], 404);
        }

        return response()->json($wallet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request, $id)
    {
        $data = $request->all();
        $wallet = Wallet::find($id);
        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found',
                'status' => 404,
            ], 404);
        }
        if (!$wallet->update($data)) {
            throw new \Exception('Failed to update the wallet type.');
        }
        return (new BaseResource($wallet->fresh()))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wallet = Wallet::find($id);
        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found',
                'status' => 404,
            ], 404);
        }
        $wallet->delete();
        return response("Deleted wallet id: ". $id, Response::HTTP_NO_CONTENT);
    }
}
