@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','ログアウトしました')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
.btn-outline-primary:hover {
    background-color: hsl(192deg, 100%, 45%);
    border-color: hsl(192deg, 100%, 45%);
    color: #fff;
}
</style>
@endsection


<!----- script ----->
@section('script')

@endsection


<!----- contents ----->
@section('contents')

    <div class="card card-body text-secondary mb-5">

        <h5 class="fw-bold mb-5">ログアウトしました。</h5>


        <div class="row mb-3">
            <div class="col-sm-8 offset-sm-2">
                <a href="{{ route('worker_auth.login_form') }}" class="btn btn-arrow btn-curve btn-primary text-white w-100">
                    {{ __('再度ログインする') }}
                </a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-8 offset-sm-2">
                <a href="{{ route('top') }}" class="btn btn-link w-100">
                    {{ __('サービスに戻る') }}
                </a>
            </div>
        </div>

    </div>


@endsection
