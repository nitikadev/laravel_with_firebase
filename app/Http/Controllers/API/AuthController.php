<?php

namespace App\Http\Controllers\API;

use App\Http\ApiController;
use App\Models\User;
use App\Services\Api\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        try {

            $validationErrors = $this->validateRequestEmail($request);
            if (count($validationErrors)) {
                Log::error("Validation Errors: " . implode(", ", $validationErrors->all()));
                return ApiResponse::validation(__('common.validation_errors'), ["errors" => $this->formatValidationErrors($validationErrors->toArray())]);
            }

            $email = strtolower($request->email);
            $password = $request->password;

            $auth = app(Auth::class);
            $user = $auth->signInWithEmailAndPassword($email, $password);

            if (!$user) {
                return ApiResponse::forbidden(__('auth.failed'));
            }
            $customToken = $auth->createCustomToken($user->firebaseUserId());
            return ApiResponse::ok(
                __('common.logged_in_successfully'),
                [
                    'access_token' => $user->idToken(),
                    'email' => $email,                
                ]
            );
        } catch (Exception $e) {
            if($e->getMessage() == 'INVALID_LOGIN_CREDENTIALS'){
                return ApiResponse::forbidden(__('auth.invalid_otp'));
            }
            Log::error("login failed: " . $e->getMessage());
            return ApiResponse::error(__('auth.something_went_wrong'));
        }
    }

    public function register(Request $request)
    {
        try {

            $validationErrors = $this->validateReuestRegister($request);
            if (count($validationErrors)) {
                Log::error("Validation Errors: " . implode(", ", $validationErrors->all()));
                return ApiResponse::validation(__('common.validation_errors'), ["errors" => $this->formatValidationErrors($validationErrors->toArray())]);
            }

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = strtolower($request->email);
            $password = $request->password;

            $auth = app(Auth::class);

            $checkUserExists = User::where('email', $email)->first();

            if (empty($checkUserExists)) {
                $userData['name'] = $firstname.' '.$lastname;
                $userData['email'] = $email;
                $userData['password'] = Hash::make($password);
                Log::info("New User saved.");
                User::create($userData);
            }

            $user = $auth->createUser([
                'email' => $email,
                'password' => $password,
            ]);

            if (!$user) {
                return ApiResponse::forbidden(__('auth.failed'));
            }
            return ApiResponse::ok(
                __('common.registered_successfully'),
                [
                    'name' => $firstname.' '.$lastname,
                    'email' => $email,
                ]
            );
        } catch (Exception $e) {
            Log::error("register failed: " . $e->getMessage());
            return ApiResponse::error(__($e->getMessage()));
        }
    }

    private function validateRequestEmail(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'email' =>  [
                    'required',
                    'string',
                    'email',
                ],
                'password' => 'required',
            ],
            [
                'email.required' => 'The email field is required',
                'email.string' => 'The email must be a string',
                'email.email' => 'The email must be a valid email address',
                'password.required' => 'The password field is required',
            ]
        )->errors();
    }

    private function validateReuestRegister(Request $request)
    {
        return Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' =>  [
                'required',
                'string',
                'email',
            ],
            'password' => 'required'


        ], [
            'firstname.required' => 'The firstname field is required',
            'firstname.string' => 'The firstname must be a string',
            'lastname.required' => 'The lastname field is required',
            'lastname.string' => 'The lastname must be a string',
            'email.required' => 'The email field is required',
            'email.string' => 'The email must be a string',
            'email.email' => 'The email must be a valid email address',
            'password.required' => 'The OTP field is required',

        ])->errors();
    }
}