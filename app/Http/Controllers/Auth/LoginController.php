<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use \App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
     public function redirectToProvider()
     {
         //it can be facebook twitter/github
         return Socialite::driver('google')->redirect();
     }
 
     /**
      * Obtain the user information from GitHub.
      *
      * @return Response
      */
     public function handleProviderCallback()
     {
        try{
            if(!Auth::user()){
                $social_user = Socialite::driver('google')->user();
                
                   $user = \App\User::where('email', $social_user->getEmail())->first();
                   if(!$user){
                       return array("code" => 401, "response" => "Unauthorized User");
                   }
                   else{
                        if($user['user_img'] == NULL){
                            \App\User::where('email', $user['email'])->update(['user_img' => $social_user->avatar_original]);
                        }
                        if (Auth::attempt(['email' => $user['email'], 'password' => 'secret'])) {
                           // Authentication passed...
                            return redirect()->intended('home');
                        }
                   }


                   //dd($social_user->avatar_original);
                   /** 
                    *  Perform Ajax Request Using Guzzle  if youre front-end app 
                    * is separated from your backend. If its not
                   **/
                   /* $http = new GuzzleHttp\Client;
       
                   $response = $http->post('http://127.0.0.1:8000/oauth/token',[
                       'form_params' => [
                           'cliend_id' => '2',
                           'client_secret' => '2pxcNfhQcc2c4KNpRMKr3yVg5VOZhzyk0CQX3zGS',
                           'grant_type' => 'password',
                           'username' => $user['email'],
                           'password' => 'secret'
                       ]
                   ]); */
            }
        }
        catch(\Exception $e){
           return $e;
           //return redirect('/');
        }
        
     }

     public function handleLoclistCallback(){
         //Perform some logic here
     }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
