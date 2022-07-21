@extends('layouts.base')


<!----- title ----->
@section('title','わたしの問題集リスト')

<!----- breadcrumb ----->
@section('breadcrumb')
<nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0  bg-white">
        <li class="breadcrumb-item"><a href="#" class="text-success">
            <i class="bi bi-house-door-fill"></i> Home
        </a></li>
        <li class="breadcrumb-item" aria-current="page">
            わたしの問題集リスト
        </li>
    </ol>
</nav>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section class="border-bottom bg-white">
    <div class="container-1200">
        <h2 class="text-secondary fw-bold mb-3">
            わたしの問題集リスト
        </h2>
    </div>
</section>


<section>
    <div class="container-1200">

        <div class="mb-3">
            <a href="{{route('make_question_group.create')}}" class="btn btn-success rounded-pill">新規作成</a>
        </div>

        <ul class="list-group">
            @foreach ($question_groups as $question_group)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="overflow-hidden">
                        <div>
                            <!-- 公開設定 -->
                            @if ( $question_group->is_public )
                            <span class="badge badge-warning"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                            >公開中</span>
                            @else
                            <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                            >非公開</span>
                            @endif

                            <!-- 作成日 -->
                            <span>{{ \Carbon\Carbon::parse($question_group->created_at)->format('Y-m-d') }}</span>
                        </div>

                        <!-- タイトル -->
                        <a href="" class="fs-3" style="text-decoration:none;">{{ $question_group->title }}</a>

                    </div>
                    <div class="" style="min-width:9rem;">
                        <button type="button" class="btn btn-link text-secondary" style="text-decoration:none;"
                        >編集</button>

                        <button type="button" class="btn btn-link text-danger"    style="text-decoration:none;"
                        >削除</button>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>


    </div>
</section>
@endsection
