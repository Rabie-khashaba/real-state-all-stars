<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VoterAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VoterAuthController extends Controller
{
    public function __construct(
        private readonly VoterAuthService $voterAuthService
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $result = $this->voterAuthService->register($request);

            return response()->json([
                'success' => true,
                'message' => 'Voter registration started successfully. Verify OTP to complete registration.',
                'data' => $result,
            ], 201);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function verifyVoterOtp(Request $request): JsonResponse
    {
        try {
            $result = $this->voterAuthService->verifyVoterOtp($request->only([
                'phone',
                'otp',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'OTP verified and voter registered successfully.',
                'data' => $result,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function resendOtp(Request $request): JsonResponse
    {
        try {
            $result = $this->voterAuthService->resendOtp($request->only([
                'phone',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully.',
                'data' => $result,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to resend OTP.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $result = $this->voterAuthService->login($request->only([
                'phone',
                'password',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'data' => $result,
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
