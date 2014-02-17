<?php
 
class UsersController extends BaseController {
    protected $layout = "layouts.main";

	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	    $this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}
    public function getRegister() {
    	$this->layout->content = View::make('users.register');
	}

	public function getLogin() {
    	$this->layout->content = View::make('users.login');
	}

	public function getDashboard() {
    	$this->layout->content = View::make('users.dashboard');
	}

	public function getLogout() {
	    Auth::logout();
	    return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}

	public function postSignin() {
	    if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
    		return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
		} else {
		    return Redirect::to('users/login')
		        ->with('message', 'Your username/password combination was incorrect')
		        ->withInput();
}     
	}


	public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);
	 
	    if ($validator->passes()) {
	        $user = new User;
	        if(Input::get('role')){
	        	$role = Input::get('role');
	        }else{
	        	$role = "Soldier";
	        }

		    $user->firstname = Input::get('firstname');
		    $user->lastname = Input::get('lastname');
		    $user->role = $role;
		    $user->email = Input::get('email');
		    $user->gravatar = Gravatar::src(Input::get('email'), 200);
		    $user->password = Hash::make(Input::get('password'));
		    $user->save();
		 
		    return Redirect::to('users/login')->with('message', 'Thanks for registering!');

	    } else {
	        return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();   
	    }

	}


}
?>