<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginApiController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        $credentials = request()->only('email', 'password');

        if(Auth::guard('customers')->loginUsingId(1)){
            $user = Auth::guard('customers');
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Email or password incorrect'], 401);
        }

    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required_without:fb_token',
            'fb_token' => 'required_without:password',
            //'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {

            return response()->json(['status' => 0, 'message'=>$validator->errors()->first()], 200);
        }
        $input = $request->all();
        $input['password'] = isset($input['password'])?bcrypt($input['password']):bcrypt('123456');
        $user = User::create($input);
        if($request->has('fb_token') && $request->fb_token != '') {
            $user->verified = true;
            $user->save();
            $token = $user->createToken('Videsaur')->accessToken;
            $message = 'success';
        } else {
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);
            Mail::to($user->email)->send(new VerifyMail($user));
            $token = '';
            $message = 'We sent you an activation code. Check your email and click on the link to verify.';
        }
        $data['thumb'] = 'https://videsaur.com/thumb/';
        $data['gif'] = 'https://videsaur.com/gif/';
        $data['videos'] = 'https://videsaur.com/videos/';
        $data['languages'] = Language::all();
        return response()->json(['status' => 1, 'message' => $message, 'token' => $token, 'urls' => $data], $this->successStatus);

    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            $this->sendResetLinkEmail($request);
            return response()->json(['status' => 1, 'message' => 'Password reset email sent!'], $this->successStatus);
        } else {
            return response()->json(['status' => 0, 'message'=> 'Invalid Email!'], 200);
        }
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        $user_language = $user->language;
        $user['language'] = $user_language;
        return response()->json(['status' => 1, 'message' => 'success', 'data' => $user], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $data = $request->only(['email','name']);
        $existEmail = User::checkEmail($user->id, $request->email);
        if(!$existEmail) {
            if($request->has('password')){
                $data['password'] = bcrypt($request->password);
            }
            $profile = User::profileUpdate($user->id, $data);
            return response()->json(['status' => 1, 'message' => 'success'], $this->successStatus);
        } else {
            return response()->json(['status' => 0, 'message'=> 'Email exists!'], 200);
        }
    }
    public function baseUrls()
    {
        $data['thumb'] = 'https://videsaur.com/thumb/';
        $data['gif'] = 'https://videsaur.com/gif/';
        $data['videos'] = 'https://videsaur.com/videos/';
        $data['languages'] = Language::all();
        return response()->json(['status' => 1, 'message' => 'success', 'urls' => $data], $this->successStatus);
    }
}
