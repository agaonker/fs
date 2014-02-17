$(document).ready(function() {
    get_latest();
});

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

function message_block(msg_feed, entry){
		var int_div = $('<div class="msg-container"></div>');
		var gravtar, msg_box;
		if(entry['highlight']){
			gravtar = $("<div class='msg-img highlight'><img src='"
			             + entry['gravatar'] 
			             + "' width='80px'/></span></div>");
			msg_box = $("<div class='msg-box highlight'></div>");
		}else{
			gravtar = $("<div class='msg-img normal'><img src='" + entry['gravatar'] + "' width='80px'/></span></div>");
			msg_box = $("<div class='msg-box normal'></div>")
		}
		
		int_div.append(gravtar);
		var d = moment(entry['created_at']);
		var date_str = d.format('D MMMM YYYY  h:mm:ss a');
		msg_box.append("<a href='#'' style='float:left'>" + entry['firstname']
		 	                   + " " + entry['lastname']  + "</a>"
		 	                   + "<div style='float:left;margin-left:20px'>" 
		 	                   + entry['role']
		 	                   + "</div>"
		 	                   + "<div style='float:right'>" + date_str
		 	                   + "</div>");
		msg_box.append("<div>" + entry['data'] + "</div>");
		msg_feed.append(int_div);
		msg_feed.append(msg_box);
}

function get_latest(){
	var msg_feed = $("#msg-feed")
	$.ajax({
	    	type: "POST",
	    	url: '/message/latest',
	    	success:function(results){
	    		$("#msg-feed").empty();
	    		results.forEach(function(entry) {
				    var block = message_block(msg_feed, entry);
				});
	    	},
	    	error:function(error){

	    	}});
}
