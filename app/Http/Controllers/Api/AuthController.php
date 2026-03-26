<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->only([
                'phone',
                'password',
            ]), [
                'phone' => 'required|string|max:20',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::where('phone', $request->phone)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'phone' => ['Invalid phone number or password.'],
                ]);
            }

            if (!in_array($user->type, ['voter', 'contestant'], true)) {
                throw ValidationException::withMessages([
                    'phone' => ['This account type is not allowed to log in from this endpoint.'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'data' => [
                    'token' => $user->createToken($user->type . '-login-token')->plainTextToken,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'type' => $user->type,
                ],
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }
}
