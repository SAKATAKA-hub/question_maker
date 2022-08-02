@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','パスワード変更')


<!----- meta ----->
@section('meta')

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="api_route_step01" content="{{ '' }}">
    <meta name="api_route_step02" content="{{ '' }}">
    <meta name="route_login" content="{{ route('user_auth.login') }}">
    <meta name="route_login_form" content="{{ route('user_auth.login_form') }}">

@endsection


<!----- style ----->
@section('style')
<style>
    .anima-fadein-bottom{
        animation: anima-fadein-bottom 1s forwards;
    }
    @keyframes anima-fadein-bottom {
        from {
            opacity: 0;
            transform: translateY(1rem);
        }
        to {
            opacity: 1;
            transform: translateY(0rem);
        }
    }

</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')

    <div id="app">


        <reset-pass-component></reset-pass-component>


    </div>

@endsection
