<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\BaseResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BaseResource(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        return (new BaseResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }
        if (!$user->update($data)) {
            throw new \Exception('Failed to update the user.');
        }
        return (new BaseResource($user->fresh()))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }
        $user->delete();
        return response("Deleted user id: ". $id, Response::HTTP_NO_CONTENT);
    }
}
