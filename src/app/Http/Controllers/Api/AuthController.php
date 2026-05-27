<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ResendOtpRequest;
use App\Http\Requests\Api\Auth\VerifyEmailRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $otp = $this->generateOpt($request, $validated["email"]);
            User::create([
                "username" => $validated["username"],
                "email" => $validated["email"],
                "password" => bcrypt($validated["password"]),
            ]);
            Mail::to($validated["email"])->send(new RegisterMail($otp));
            return response()->json([
                "message" => "You have registered successfully. Please check your email for the OTP to verify your account."
            ]);
        });
    }



    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }


        $user = Auth::user();

        return response()->json([
            "access_token" => $user->createToken("auth_token")->plainTextToken,
            "token_type" => "Bearer",
            "username" => $user->username,
        ]);
    }

    public function verify_otp(VerifyEmailRequest $request)
    {
        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        $otp = (new Otp)->validate($request->email, $request->otp);

        if (!$otp->status) {
            return response()->json([
                "message" => "OTP is invalid or expired"
            ], 400);
        }

        $user->update([
            "email_verified_at" => now()
        ]);

        return response()->json([
            "message" => "OTP verified successfully"
        ]);
    }

    public function resend_otp(ResendOtpRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $user = User::where("email", $validated["email"])->first();

            if (!$user) {
                return response()->json([
                    "message" => "User not found"
                ], 404);
            }

            $otp = $this->generateOpt($request, $validated["email"]);


            Mail::to($validated["email"])->send(new RegisterMail($otp));

            return response()->json([
                "message" => "OTP resent successfully. Please check your email for the new OTP."
            ]);
        });
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->validated()['email'];
        $otp = $this->generateOpt($request, $email);
        Mail::to($email)->send(new RegisterMail($otp));

        return response()->json([
            'message' => 'OTP sent to your email address.'
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $otp = (new Otp)->validate($validated['email'], $validated['otp']);

        if (!$otp->status) {
            return response()->json([
                'message' => 'OTP is invalid or expired'
            ], 400);
        }

        User::where('email', $validated['email'])->update([
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'message' => 'Password reset successfully.'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Logged out successfully"
        ]);
    }

    public function generateOpt(Request $request, $email)
    {
        return (new Otp)->generate($email, 'numeric', 6, 15);
    }
}
