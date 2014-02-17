<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
	 
	<!-- Latest compiled and minified JavaScript -->
    
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	{{ HTML::style('css/main.css')}}
    {{ HTML::script('js/moment.min.js')}}
    {{ HTML::script('js/underscore-min.js')}}
    {{ HTML::script('js/dashboard.js')}}

    <title>Resistance Network</title>
  </head>
 
  <body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">  
                    <li class="move-left the-resistance">The Resistance</li>  
                    @if(!Auth::check())
                        <li class="move-left">{{ HTML::link('users/register', 'Signup for Resistance') }}</li>   
                        <li class="move-left">{{ HTML::link('users/login', 'Login') }}</li>   
                    @else
                        <div class="move-left salutation">
                          <img src={{ Auth::user()->gravatar}} width="30px">
                          <span>{{ Auth::user()->firstname." ".Auth::user()->lastname .","}}</span></div>
                        
                        </li>
                    @endif 
                </ul>  
            </div>
            <hr style="height:2px;border:none;color:#333;background-color:#333;"/>
        </div>
    </div>
    <div class="container" style="margin-top: 40px">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
        {{ $content }}
    </div>
  </body>
</html>