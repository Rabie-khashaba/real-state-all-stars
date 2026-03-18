<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContestantRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContestantAuthController extends Controller
{
    public function __construct(
        private readonly ContestantRegistrationService $registrationService
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->startRegistration($request);

            return response()->json([
                'success' => true,
                'message' => 'Registration started successfully. Verify OTP to complete registration.',
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

    public function verifyRegister(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->verifyOtpAndCreate($request->only([
                'phone',
                'otp',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'OTP verified and contestant registered successfully.',
                'data' => [
                    'token' => $result['token'],
                    'user' => $result['user'],
                    'contestant' => $result['contestant'],
                ],
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
            $result = $this->registrationService->resendOtp($request->only([
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
            $result = $this->registrationService->login($request->only([
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

    public function forgotPassword(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->forgotPassword($request->only([
                'phone',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully.',
                'data' => $result,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to send OTP.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->verifyForgotPasswordOtp($request->only([
                'phone',
                'otp',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.',
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

    public function resetPassword(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->resetPassword($request->only([
                'phone',
                'new_password',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully.',
                'data' => $result,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to reset password.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully.',
            'data' => $this->registrationService->getProfile($request->user()),
        ]);
    }

    public function profileById(int $id): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Profile retrieved successfully.',
                'data' => $this->registrationService->getProfileById($id),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to retrieve profile.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function updateProfile(Request $request, int $id): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'data' => $this->registrationService->updateProfile($id, $request, $request->user()),
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to update profile.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
            'data' => $this->registrationService->logout($request->user()),
        ]);
    }
}
