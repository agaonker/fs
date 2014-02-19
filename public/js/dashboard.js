$(document).ready(function() {
	_.templateSettings.variable = "messages";
    get_latest();
});
var msg_template = _.template($( "script.message_template" ).html());

function send_message(){

	var message = $('#message').val();
	if (message){
		$('#message-status').empty();

		$.ajax({
	    	type: "POST",
	    	url: '/message/send',
	    	data: { message: message },
	    	success:function(result){
	    		if(result.status == "success"){
	    			$('#message').val('');
	    			$('#message-status').append( "<span style='color:green'>"+ result.msg +"</span>" );
	    		}else{
	    			$('#message-status').append( "<span style='color:red'>Message Failed</span>" );
	    		}
	    		
	    	},
	    	error:function(error){
	    		$('#message-status').append( "<span style='color:red'>Failed to send Message</span>" );
	    	}
		})
	}else{
		$('#message-status').empty();
		$('#message-status').append( "<span style='color:red'>Message empty</span>" );
	}	

}


function get_latest(){
	$("#msg-save").empty();

	$.ajax({
	    	type: "GET",
	    	url: '/message/latest',
	    	success:function(results){
	    		$("#msg-feed").empty();
	    		$("#msg-feed").append(msg_template(results));
	    	},
	    	error:function(error){

	    	}});
}


function get_saved(){
	$("#msg-save").empty();
	$.ajax({
    	type: "GET",
    	url: '/message/getsaved',
    	success:function(results){
    		$("#msg-feed").empty();
    		$("#msg-feed").append(msg_template(results));
    	},
    	error:function(error){

    	}});
}

function save_message(event){
		var msg_id = event.target.parentElement.getAttribute('data-message-id'); 
		$("#msg-save").empty();
		$.ajax({
	    	type: "POST",
	    	url: '/message/save',
	    	data: { msg_id: msg_id },
	    	success:function(result){
	    		$("#msg-save").empty();
	    		if(result['status']){
	    			$("#msg-save").append("<span style='color:green'>" + result['msg'] + "</span>");
	    		}else{
	    			$("#msg-save").append("<span style='color:red'>"+ result['msg'] + "</span>");
	    		}
	    		//$("#msg-save").append(msg_template(results));
	    	},
	    	error:function(error){

	    	}});
}

function show_saved(){

	$("#sec0").text("Saved Messages");
	$("#refresh").hide();
	get_saved();
}

function show_message_feed(){
	$("#sec0").text("Message Feed");
	$("#refresh").show();
	get_latest();
}
