<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        abort(404);
    }

    public function register(Request $request)
    {
        try {
            // Validate input fields
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'phone_number' => 'required|unique:users|max:20',
                'address' => 'required|string|max:250',
                'contact_person' => $request->membership_type == 'C' ? 'required|string|max:100' : 'string|max:100',
                'cp_phone_number' => $request->membership_type == 'C' ? 'required|string|max:20' : 'string|max:20',
                'occupation' => $request->membership_type == 'P' ? 'required|string|max:100' : 'string|max:100',
                'is_agree' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'recaptcha' => 'required',
                'membership_type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Validate reCAPTCHA
            $recaptchaSecret = env('RECAPTCHA_SECRET');
            $recaptchaResponse = $request->input('recaptcha');

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
            ]);

            $body = json_decode((string) $response->body());

            if (!$body->success) {
                return response()->json(['error' => 'Verifikasi captcha gagal'], 401);
            }

            // Handle Survey Data within a Database Transaction
            $trans = DB::transaction(function () use ($request) {
                $input['name'] = $request->name;
                $input['phone_number'] = $request->phone_number;
                $input['address'] = $request->address;
                $input['contact_person'] = $request->contact_person;
                $input['cp_phone_number'] = $request->cp_phone_number;
                $input['occupation'] = $request->occupation;
                $input['is_agree'] = $request->is_agree == true ? 1 : 0;
                $input['email'] = $request->email;
                $input['password'] = Hash::make($request->password);
                $input['membership_type'] = $request->membership_type;
                $input['role'] = 3;

                User::create($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Database error or some other error
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }
}
