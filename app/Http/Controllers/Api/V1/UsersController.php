<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
       return response()->json([
            'data' => UserResource::collection(User::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'errors' => $validated->errors(),
                'message' => 'Une erreur est survenue lors de la validation des données'
            ], 500);
        }
        $user = User::create($validated);
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Utilisateur créé avec succès'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'errors' => $validated->errors(),
                'message' => 'Une erreur est survenue lors de la validation des données'
            ], 500);
        }
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user->update($validated);
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Utilisateur modifié avec succès'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'message' => 'Utilisateur supprimé avec succès'
        ], 200);
    }
}
