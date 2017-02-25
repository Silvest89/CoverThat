@extends('dashboard.layouts.header')

@section('content')
    <div class="loginForm">
            <div class="row align-center">
                <div class="column small-12 medium-4">
                    {!!  Form::open(['route' => 'dashboard.login']) !!}

                @if(Session::has('flash_error'))
                        <div class="success callout" data-closable="hinge-out-from-bottom">
                        <!--<h5>This a friendly message.</h5>-->
                        <p> {!! session('flash_error') !!}</p>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <fieldset class="fieldset">
                        <legend>Login</legend>
                        <input type="email" name="email" placeholder="E-mail">
                        {!! $errors->first('email', '<div class="formError"><p>:message</p></div>') !!}

                        <input type="password" name="password" placeholder="Password">
                        {!! $errors->first('password', '<div class="formError"><p>:message</p></div>') !!}

                        <p class="help-text" id="passwordHelpText">Your password must have at least 10 characters, a number</p>
                        <input type="submit" class="button expanded purple" value="Login">
                    </fieldset>
                    {!! Form::close() !!}

                </div>
            </div>
        <div class="row align-center">
            <div class="column small-12 medium-2">
                {!!  Form::open(['route' => 'facebook.form.login']) !!}
                <button class="loginBtn loginBtn--facebook">
                    Login with Facebook
                </button>
                {!! Form::close() !!}

            </div>
            <div class="column small-12 medium-2">
                {!!  Form::open(['route' => 'google.form.login'], '') !!}
                <button class="loginBtn loginBtn--google">
                    Login with Google
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
