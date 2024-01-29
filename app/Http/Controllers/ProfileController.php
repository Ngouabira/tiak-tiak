<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => ProfileResource::collection(Profile::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request): JsonResponse
    {
         $validated = $request->validated();
         if (!$validated) {
             return response()->json([
                 'errors' => $validated->errors(),
                 'message' => 'Une erreur est survenue lors de la validation des données'
             ], 500);
         }
        $profile = Profile::create($validated);
        return response()->json([
            'data' => new ProfileResource($profile),
            'message' => 'Profile créé avec succès'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile): JsonResponse
    {
        return response()->json([
            'data' => new ProfileResource($profile)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'errors' => $validated->errors(),
                'message' => 'Une erreur est survenue lors de la validation des données'
            ], 500);
        }
        $profile->update($validated);
        return response()->json([
            'data' => new ProfileResource($profile),
            'message' => 'Profile modifié avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile): JsonResponse
    {
        $profile->delete();
        return response()->json([
            'message' => 'Profile supprimé avec succès'
        ]);
    }
}
