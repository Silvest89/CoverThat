@extends('dashboard.layouts.header')

@section('content')
    <div class="loginForm">
        {!!  Form::open(['route' => 'dashboard.login']) !!}
            <div class="row align-center">
                <div class="column small-12 medium-4">
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
                        <input type="email" name="email" placeholder="E-mail" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <p class="help-text" id="passwordHelpText">Your password must have at least 10 characters, a number</p>
                        <input type="submit" class="button expanded purple" value="Login">
                    </fieldset>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
