<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginApiController extends Controller
{
    use SendsPasswordResetEmails;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        $credentials = request()->only('email', 'password');

        if(Auth::guard('customers')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::guard('customers')->user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;
            $success['loan_types'] = [
                "pl" => "Personal Loan",
                "bl" => "Business Loan",
                "hl" => "Home Loan",
                "cl" => "Car Loan",
                "dl" => "Doctor Loan",
                "lap" => "Loan Against Property"
            ];
            return response()->json(['status' => 1, 'message' => 'Login successfully!', 'data' => $success], 200);
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
        $user = Customer::where('email', $request->email)->first();
        if($user) {
            $data = $this->sendResetLinkEmail($request);
            return response()->json(['status' => 1, 'message' => 'Password reset email sent!', 'data' => $data], 200);
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
        $user = Auth::guard()->user();
        return response()->json(['status' => 1, 'message' => 'success', 'data' => $user], 200);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::guard()->user();
        $existEmail = null;
        if($user->email != $request->email) {
            $existEmail = Customer::where('email', $request->email)->first();
        }
        if(is_null($existEmail)) {
            $data = $request->all();
            Customer::where('id', $user->id)->update($data);
            return response()->json(['status' => 1, 'message' => 'success', 'data' => Auth::guard()->user()->refresh()], 200);
        } else {
            return response()->json(['status' => 0, 'message'=> 'Email already taken!'], 400);
        }
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $user = Auth::guard()->user();
        if($request->has('new_password') && $request->new_password != "" && $request->has('confirm_password') && $request->confirm_password != "" && $request->has('old_password') && $request->old_password != "") {
            $old_password = $request->old_password;
            if(Hash::check($old_password, $user->password)) {
                if($request->confirm_password == $request->new_password) {
                    $data['password'] = Hash::make($request->new_password);
                    Customer::where('id', $user->id)->update($data);
                    $status = 1;
                    $message ="Password changed successfully!";
                    $code = 200;
                } else {
                    $status = 0;
                    $message ="Confirm password doesn't match!";
                    $code = 400;
                }
            } else {
                $status = 0;
                $message ="Invalid Old Password!";
                $code = 400;
            }
        } else {
            $status = 0;
            $message ="Enter Old/New/Confirm Password!";
            $code = 400;
        }
        return response()->json(['status' => $status, 'message'=> $message], $code);
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
