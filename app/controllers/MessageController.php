<?php
 
class MessageController extends BaseController {
    protected $layout = "layouts.main";

  protected function _make_response( $response_str, $type = 'application/json' ) {
        $response = Response::make( $response_str );
        $response->header( 'Content-Type', $type );
        return $response;
    }
 

	public function __construct() {
	    #$this->beforeFilter('csrf', array('on'=>'post'));
	    $this->beforeFilter('auth', array('only'=>array('save')));
	}

	public function save(){
		$message = new Message;
		$message->data = Input::get( 'message' );
		$message->user_id = Auth::user()->id;

		if ( Auth::user()->email == Config::get('constant.master')){
			$message->highlight = True;
		}else{
			$message->highlight = False;
		}
		$message->save();
		$response = array(
            'status' => 'success',
            'msg' => 'Message sent successfully',
        );
 
        return $this->_make_response( json_encode( $response ) );
	}
    

    public function latest_msg(){
    	$messages = DB::table('messages')
    				->join('users', 'users.id', '=', 'messages.user_id')
    				->orderBy('messages.created_at', 'desc')
    				->take(Config::get('constant.latest_messages'))
    				->select('users.firstname', 'users.lastname', 'users.role',
    					'users.gravatar', 'messages.id', 'messages.data', 
    					'messages.created_at', 'messages.upvote',
    					'messages.downvote', 'messages.highlight')->get();

    	return $this->_make_response( json_encode( array('messages'=>$messages)) );
  //   	foreach ($messages as $message)
		// {
		// 	$response = array(
	 //            'status' => 'success',
	 //            'msg' => 'Message sent successfully',
	 //        );
		// }
    }


 // public function create() {
 //        //check if its our form
 //        if ( Session::token() !== Input::get( '_token' ) ) {
 //            return $this->_make_response( json_encode( array( 'msg' => 'Unauthorized attempt to create setting' ) ) );
 //        }
 
 //        $setting_name = Input::get( 'setting_name' );
 //        $setting_value = Input::get( 'setting_value' );
 
 //        //.....
 //        //validate data
 //        //and then store it in DB
 //        //.....
 
 //        $response = array(
 //            'status' => 'success',
 //            'msg' => 'Setting created successfully',
 //        );
 
 //        return $this->_make_response( json_encode( $response ) );
 //    }

}
?>