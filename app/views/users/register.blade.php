{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
    {{ Form::text('firstname', null, array('class'=>'input-block-level input-size', 'placeholder'=>'First Name')) }}
    {{ Form::text('lastname', null, array('class'=>'input-block-level input-size', 'placeholder'=>'Last Name')) }}
    {{ Form::text('role', null, array('class'=>'input-block-level input-size', 'placeholder'=>'Role(Default=Soldier)')) }}
    {{ Form::text('email', null, array('class'=>'input-block-level input-size', 'placeholder'=>'Email Address')) }}
    {{ Form::password('password', array('class'=>'input-block-level input-size', 'placeholder'=>'Password')) }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level input-size', 'placeholder'=>'Confirm Password')) }}
 
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}