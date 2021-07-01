<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Mail\SignupEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;



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

    //use RegistersUsers;

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

    public function register(Request $request) {
        

        $user = new User;
        $email = $request->email;
        $password = $request->password;
        $rtpass = $request->rtpass;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('   @[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        $data = $request->all();

        if(empty($email)&&empty($password)) {
            return redirect()->back()->with('message', 'Please input your UST Email and Password');
        }elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
            return redirect()->back()->with('message', 'Password should be at least 8 characters in length and should
             include at least one upper case letter, one number, and one special character.');
        }elseif(explode('@',$email)[1] != 'ust.edu.ph' && $rtpass != $password) {
            return redirect()->back()->with('message', 'Please input your UST Email and Password does not match');

        }elseif(explode('@',$email)[1] != 'ust.edu.ph') {
            return redirect()->back()->with('message', 'Only your UST account shall be used for this website');

        }elseif($rtpass != $password) {
            return redirect()->back()->with('message', 'Password does not match');
            
        }elseif (User::where('email', $data['email'])->count()){
            return redirect()->back()->with('message', 'Account Already exists');
        }else {

        $user->email = $request->email;
        $user->password = $request->password;
        $user->vkey = sha1(time());
        if($user->save()) {
            echo 'nagsave';
        }else {
            echo 'di nagsave';
        }
      
        
        if($request->email != null) {
            MailController::sendSignupEmail($user->email, $user->vkey);
            return redirect()->back()->with('emessage', 'Verification Link has been sent to your email');
        }else {
            return redirect()->back()->with('message', 'Error has occured please try again');
        }
        return view('user/register');
     }
    }

    public function verifyUser(Request $request) {
        $vkey = \Illuminate\Support\Facades\Request::get('vkey');
        $update = DB::table('users')
        ->where('vkey', $vkey)
        ->update(['isVer' => 1]);

        if($update) {
            return redirect('verify')->with('emessage', 'Account Has been verifed');
        }
        return view('user/verify');
    }

    public function login (Request $request) {
        
        $email = $request->email;
        $password = $request->password;
        
        
        $user = DB::table('users')->where('email', $email)->first();
        
        if(!empty($email)||!empty($password))
            if($user) {
                if(Hash::check($password, $user->password)){
                    if($user->isVer == 1){
                        $role = $user->ROLE;
                        switch($role) {
                            case 'student':
                                return redirect('student');
                                break;
                            case 'professor':
                                return redirect('prof');
                                break;
                            case 'department chair':
                                return redirect('department chair');
                                    break;
                            case 'director':
                                return redirect('director');
                                break;
                            case 'secretary':
                                return redirect('secretary');
                                break;
                            case 'registrar':
                                    return redirect('registrar');
                                    break;
                            default: 
                                return '/views/user/admin/mainprof'  . $role . '' .'email='. $user->emaill;
                        }
                    }else {
                        return redirect()->back()->with('message', 'Account is not yet verified');
                    }
                }else {
                    return redirect()->back()->with('message', 'Incorrect Password');
                }
            }else {
                return redirect()->back()->with('message', 'Account Does not exist. Register your account now');
        }else {
            return redirect()->back()->with('message', 'Please input your UST Email and Password');
        }
        return view('user/login');
    } 

    public function forgotPassword(Request $request) {
        echo 'rawr';

        $email = $request->email;
        $password = $request->password;
        $rtpass = $request->rtpass;
        $user = DB::table('users')->where('email', $email)->first();

        if(!empty($email)||!empty($password)||!empty($rtpass)){
            if($user) {
                if($password == $rtpass){
                    $update = DB::table('users')
                    ->where('email', $email)
                    ->update(['password' => bcrypt($password)]);

                    if($update){
                        return redirect()->back()->with('emessage', 'Your password has been successfully changed');

                    }else {
                        return redirect()->back()->with('message', 'New Password is currently your password');
                    }
                }else {
                    return redirect()->back()->with('message', 'Password Does not match. Try again');
                }
            }else {
                return redirect()->back()->with('message', 'Account Does not exist. Register your account now');
            }
        }else {
            return redirect()->back()->with('message', 'Please input your UST Email and Password');
        }
    return view('user/forgotpassword');
    }


}
