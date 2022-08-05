@extends('layouts.base')


<!----- title ----->
@section('title', '「'.$question_group->title.'」の受験結果' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    「{{ $question_group->title }}」の受験結果
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token"                  content="{{ csrf_token() }}">
<meta name="question_group_id"           content="{{ $question_group->id }}">
<meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
<meta name="route_scoring"           content="{{ route('scoring') }}">

@endsection


<!----- style ----->
@section('style')
<style>
    .card{
        text-decoration:none;
    }
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <section>
        <div class="container-1200 my-5">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto fs-5">
                            あなたの受検結果
                        </div>
                        <div class="col  text-end">
                            <div class="">
                                <span class="fs-1">{{$question_group->score}}</span>点
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        解答時間　00:00:01
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 ">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-light">#</th>
                                <th scope="col" class="bg-light">問題文</th>
                                <th scope="col">あなたの解答</th>
                                <th scope="col" class="text-center" style="min-width:5rem;">添削結果</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $num => $question)
                            <tr>
                                <th scope="row" class="bg-light">{{ $num + 1 }}</th>
                                <td class="bg-light">
                                    <span class="d-inline-block text-truncate d-md-none"
                                    style="max-width: 100px;">{{ $question->text }}</span>
                                    <span class="d-none d-md-inline">{{ $question->text }}</span>
                                </td>
                                <td class="" >{{ $question['input_answer']['text'] }}</td>
                                @if ($question['input_answer']['is_correct'])
                                    <th class="text-center text-info">
                                        <i class="bi bi-record fs-5"></i>
                                        <span class="d-none d-sm-inline">正　解</span>
                                    </th>
                                @else
                                    <th class="text-center text-danger">
                                        <i class="bi bi-x-lg fs-5"></i>
                                        <span class="d-none d-sm-inline">不正解</span>
                                    </th>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection


