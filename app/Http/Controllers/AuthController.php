<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle modal registration and login
     */
    public function modalRegister(Request $request)
    {
        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20|unique:users,phone',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            // Check if user already exists with this phone
            $existingUser = User::where('phone', $request->phone)->first();
            
            if ($existingUser) {
                // User exists, just login
                Auth::login($existingUser);
                
                return response()->json([
                    'success' => true,
                    'message' => __('front.welcome_back'),
                    'user' => [
                        'name' => $existingUser->name,
                        'phone' => $existingUser->phone
                    ]
                ]);
            }

            // Create new user
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->phone . '@temp.com', // Temporary email if required
            ]);

            // Login the user
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => __('front.registration_successful'),
                'user' => [
                    'name' => $user->name,
                    'phone' => $user->phone
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('front.error_occurred'),
            ], 500);
        }
    }

    /**
     * Handle regular login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Attempt login with phone
        if (Auth::attempt(['phone' => $request->phone])) {
            return response()->json([
                'success' => true,
                'message' => __('front.login_successful'),
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('front.invalid_credentials'),
        ], 401);
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', __('front.logged_out_successfully'));
    }
}