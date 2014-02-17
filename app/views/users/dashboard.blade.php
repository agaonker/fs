<div class="container">
	<div class="row">
  			<div class="col-md-3" id="leftCol">
              
              	<ul class="nav nav-stacked menu" id="sidebar">
                  <li class="menu-border" ><a data-toggle="modal" href="#myModal">Broadcast Message</a></li>
                  <li class="menu-border"><a href="#sec1">Saved Messages</a></li>
                  <li class="menu-border">{{ HTML::link('users/logout', 'Logout') }}</li>
              	</ul>
              
      		</div>  
      		<div  class="col-md-9">
              	<span id="sec0" style="font-size: 20px;font-weight: bolder">	Message Feed 
              	</span>
              	<a href="#" onclick="get_latest();">Refresh</a>
              	<div id='msg-feed'>
              	</div>	
      		</div>
      		<div class="modal" id="myModal">
				<div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			          <h4 class="modal-title">Broadcast your message to the Resistance Network</h4>
			        </div>
			        <div class="modal-body">
			          <div id="message-status"></div>
			          <textarea id="message" rows="4" cols="90" maxlength="200"></textarea>
			        </div>
			        <div class="modal-footer">
			          <a href="#" data-dismiss="modal" class="btn">Cancel</a>
			          <a href="#" class="btn btn-primary" onclick="send_message()">Send</a>
			        </div>
			      </div>
			    </div>
			</div>
  	</div>
</div>

