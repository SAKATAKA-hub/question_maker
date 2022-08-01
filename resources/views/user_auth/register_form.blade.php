@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','会員登録')


<!----- meta ----->
@section('meta')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="api_route_step01" content="{{ '' }}">
    <meta name="api_route_step02" content="{{ '' }}">
    <meta name="api_route_step03" content="{{ '' }}">
    <meta name="api_route_step04" content="{{ '' }}">
    <meta name="route_login" content="{{ route('user_auth.login') }}">
    <meta name="route_privacy_policy" content="{{ route('footer_menu.privacy_policy') }}">
@endsection



<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')

    <div id="app">
        <register-component></register-component>
    </div>


@endsection
