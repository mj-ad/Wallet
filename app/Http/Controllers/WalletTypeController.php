<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletTypeRequest;
use App\Http\Requests\UpdateWalletTypeRequest;
use App\Http\Resources\Admin\BaseResource;
use App\Models\WalletType;
use Symfony\Component\HttpFoundation\Response;

class WalletTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BaseResource(WalletType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletTypeRequest $request)
    {
        $walletType = WalletType::create($request->all());
        return (new BaseResource($walletType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $walletType = WalletType::find($id);
        if (!$walletType) {
            return response()->json([
                'message' => 'Wallet type not found',
                'status' => 404,
            ], 404);
        }

        return response()->json($walletType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletTypeRequest $request, $id)
    {
        $data = $request->all();
        $walletType = WalletType::find($id);
        if (!$walletType) {
            return response()->json([
                'message' => 'Wallet type not found',
                'status' => 404,
            ], 404);
        }
        if (!$walletType->update($data)) {
            throw new \Exception('Failed to update the wallet type.');
        }
        return (new BaseResource($walletType->fresh()))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $walletType = WalletType::find($id);
        if (!$walletType) {
            return response()->json([
                'message' => 'Wallet type not found',
                'status' => 404,
            ], 404);
        }
        $walletType->delete();
        return response("Deleted wallet type id: ". $id, Response::HTTP_NO_CONTENT);
    }
}
