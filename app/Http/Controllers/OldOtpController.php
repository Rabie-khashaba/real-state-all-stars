<?php

namespace App\Http\Controllers;

use App\Services\BeonSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    protected $smsService;

    public function __construct(BeonSmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    
    /**
     * Send OTP to the provided phone number
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $phone = $validator->validated()['phone'];
        
        try {
            $smsResponse = $this->smsService->sendOtp(
                $phone,
                'New Contestant',
                'en' // Using English for better compatibility
            );

            Log::info('OTP sent response:', [
                'phone' => $phone,
                'response' => $smsResponse
            ]);

            if (!$smsResponse['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $smsResponse['message'] ?? 'Failed to send OTP'
                ], 500);
            }

            // Store OTP and phone in session
            session(['otp' => $smsResponse['otp'], 'phone' => $phone]);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully',
                'phone' => $phone,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in sendOtp: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify the OTP provided by the user
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20',
            'otp' => 'required|string|size:4|regex:/^[0-9]{4}$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 400);
        }

        $validated = $validator->validated();
        $phone = $validated['phone'];
        $otp = $validated['otp'];

        // Retrieve OTP from session
        $storedOtp = session('otp');
        $storedPhone = session('phone');

        Log::info('OTP verification attempt:', [
            'provided_phone' => $phone,
            'stored_phone' => $storedPhone,
            'provided_otp' => $otp,
            'stored_otp' => $storedOtp,
        ]);

        if (empty($storedOtp) || empty($storedPhone)) {
            return response()->json([
                'success' => false,
                'error' => 'OTP expired or not sent. Please request a new OTP.'
            ], 400);
        }

        if ($phone !== $storedPhone) {
            return response()->json([
                'success' => false,
                'error' => 'Phone number mismatch'
            ], 400);
        }

        if ($otp === $storedOtp) {
            // OTP verified, clear session but keep phone for form submission
            session()->forget('otp');
            
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'Invalid OTP. Please try again.'
        ], 400);
    }

    /**
     * Resend OTP to the provided phone number
     */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $phone = $validator->validated()['phone'];
        
        try {
            // Clear any existing OTP
            session()->forget(['otp', 'phone']);
            
        $smsResponse = $this->smsService->sendOtp(
            $phone,
            'New Contestant',
                'en'
        );

        if (!$smsResponse['success']) {
            return response()->json([
                    'success' => false,
                    'message' => $smsResponse['message'] ?? 'Failed to resend OTP'
            ], 500);
        }

            Log::info('OTP resent:', [
            'phone' => $phone,
                'success' => $smsResponse['success']
        ]);

            // Store new OTP and phone in session
            session(['otp' => $smsResponse['otp'], 'phone' => $phone]);

        return response()->json([
                'success' => true,
            'message' => 'OTP sent successfully',
            'phone' => $phone,
        ]);
        } catch (\Exception $e) {
            Log::error('Error in resendOtp: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP: ' . $e->getMessage()
            ], 500);
        }
    }
}
