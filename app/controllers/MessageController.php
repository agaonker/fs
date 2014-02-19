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

    }

    public function save_user_message(){
    	$saved_message = new Savedmessage;
		$saved_message->message_id = Input::get( 'msg_id' );
		$saved_message->user_id = Auth::user()->id;

		try {
    		$saved_message->save();
    		$response = array(
            'status' => True,
            'msg' => 'Message Saved successfully');
		}catch(\Exception $e){
    		//Do something when query fails.(#TODO : catch duplicate key exception )
    		$response = array(
            'status' => False,
            'msg' => 'Message Already Saved'); 
		}

        return $this->_make_response( json_encode( $response ) );
    }

    public function get_saved_user_mesages(){

    	$result = DB::table('saved_messages')
    				->where('user_id', '=', Auth::user()->id)
    				->select('message_id')
    				->get();
    	$msg_ids = array();
    	foreach ($result as $item){
    		array_push($msg_ids, $item->message_id);
    	}

    	// $messages = DB::select( DB::raw("SELECT users.firstname, users.lastname, users.role,
    	// 				users.gravatar, messages.id, messages.data, 
    	// 				messages.created_at, messages.upvote,
    	// 				messages.downvote, messages.highlight FROM users, messages 
    	// 				WHERE users.id = messages.user_id and 
    	// 				messages.id IN ".msg_ids) );
    	if(!$msg_ids){
    		return $this->_make_response( json_encode( array('messages'=>[])) ); 
    	}

    	$messages = DB::table('messages')
    				->join('users', 'users.id', '=', 'messages.user_id')
    				->wherein('messages.id', $msg_ids)
    				->select('users.firstname', 'users.lastname', 'users.role',
    					'users.gravatar', 'messages.id', 'messages.data', 
    					'messages.created_at', 'messages.upvote',
    					'messages.downvote', 'messages.highlight')->get();


    	return $this->_make_response( json_encode( array('messages'=>$messages)) );

    }

}
?>