@extends('layouts.base')


<!----- title ----->
@section('title','問題集の編集')

<!----- breadcrumb ----->
@section('breadcrumb')
<nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0  bg-white">
        <li class="breadcrumb-item"><a href="{{route('questions_list')}}" class="text-success">
            <i class="bi bi-house-door-fill"></i> Home
        </a></li>
        <li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
            作成問題集リスト
        </a></li>
        <li class="breadcrumb-item" aria-current="page">
           問題集の編集
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
           問題集の編集
        </h2>
    </div>
</section>


<section>
    <div class="container-1200">

        {{-- <h2 class="text-secondary fw-bold">
            基本情報
        </h2> --}}
        <div class=" border-0 mb-5">
            <div class="card-body">
                <h3 class="border-bottom border-4 pb-2 mb-3">
                    <!-- 公開設定 -->
                    @if ( $question_group->published_at )
                    <span class="badge badge-info"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                    >公開中</span>
                    @else
                    <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                    >非公開</span>
                    @endif

                    {{$question_group->title}}
                </h3>
                <div class="row">
                    <div class="col-md-4 order-md-2">
                        <div class="card overflow-hidden w-100 mb-3">
                            <img src="{{asset('storage/'.$question_group->image_puth)}}" alt="サムネ画像">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <!-- 日付 -->
                            公開日：{{ $question_group->published_at ?
                            \Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日') :
                             '非公開' }}　<br>
                            作成日：{{ \Carbon\Carbon::parse( $question_group->created_at )->format('Y年m月d日') }}<br>
                            更新日：{{ \Carbon\Carbon::parse( $question_group->updated_at )->format('Y年m月d日') }}

                            <!-- タグ -->
                            <div class="d-flex gap-1">
                                @foreach ( explode('　',$question_group->tags) as $tag )
                                <div class="border" style="padding:0 .5rem; font-size:.8rem;">{{ $tag }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 ">
                            説明文
                            <div class="card-body border-top border-bottom border-2" style="min-height:8rem;">
                                {!! nl2br( e( $question_group->resume ) )  !!}
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="mb-3">
                    <a href="{{route('make_question_group.edit',$question_group)}}" class="btn btn-warning rounded-pill"
                    >基本情報の編集</a>
                </div>
            </div>
        </div>


        @foreach ($question_group->questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="text-secondary fw-bold">
                    問題 {{sprintf('%02d', $question->order )}}
                </h2>

                <div class="row">
                    @if ($question->image)
                    <!-- 問題画像 -->
                    <div class="col-md-4 order-md-2">
                        <div class="card overflow-hidden w-100 mb-3">
                            <img src="{{asset('storage/'.$question->image)}}" alt="サムネ画像">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- 問題文 -->
                        <div class="mt-3 mb-3">
                            {!! nl2br( e( $question->text ) )  !!} <br>
                        </div>

                        <!-- 正解 -->
                        <div class="mb-3">
                            <div class="mb-2" style="font-size:.6rem">
                                解答方法：
                                {{ $question->answer_type == 0 ? '文章で答えを入力する' :
                                (  $question->answer_type == 1 ? 'ひとつの答えを選ぶ' : '複数の答えを選ぶ'  ) }}
                            </div>
                            @foreach ($question->question_options as $option)
                                <div class="row mb-2">
                                    @if ($option->is_answer)
                                        <div class="col-auto">正　解</div>
                                        <div class="col card"> {{ $option->text }}</div>
                                    @else
                                        <div class="col-auto">不正解</div>
                                        <div class="col card bg-light text-secondary">{{ $option->text }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <a href="{{route('make_question.edit',$question)}}" class="btn btn-warning rounded-pill" style="text-decoration:none;"
                    >編集</a>
                    <a href="{{route('make_question.edit',$question)}}" class="btn btn-danger rounded-pill" style="text-decoration:none;"
                    >削除</a>
                </div>
            </div>
        </div>
        @endforeach



        <div class="mt-5 mb-5 text-end">
            <a href="{{route('make_question.create', $question_group )}}" class="btn btn-success btn-lg rounded-pill shadow">+ 問題の追加</a>
        </div>

    </div>
</section>
@endsection
