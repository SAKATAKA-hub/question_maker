@extends('layouts.base')


<!----- title ----->
@section('title')
    @if ( empty($question_group) )
    問題集の新規作成
    @else
    問題集基本情報の修正
    @endif
@endsection


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
            @if ( empty($question_group) )
            問題集の新規作成
            @else
            問題集基本情報の修正
            @endif
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
            @if ( empty($question_group) )
            問題集の新規作成
            @else
            問題集基本情報の修正
            @endif
        </h2>
    </div>
</section>


<section>
    <div class="container-1200 pt-5">

        @if ( empty($question_group) ){{-- 新規作成 --}}
        <form action="{{ route('make_question_group.store' ) }}" method="POST" enctype="multipart/form-data">
            @csrf

        @else{{-- 更新 --}}
        <form action="{{ route('make_question_group.update', $question_group ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

        @endif


            <div class="card mb-5 card-body shadow">

                <!-- タイトル -->
                <div class="form-group mb-4">
                    <label for="title_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >タイトル</label>
                    <input type="text" name="title" class="form-control" id="title_input" placeholder="問題集のタイトル"
                    value="{{ isset($question_group) ? $question_group->title : '' }} "
                    style="height:2rem;" maxlength="150" required>
                </div>


                @if ( isset($question_group) )
                <!-- 公開設定 -->
                <div class="form-group mb-4">
                    <label class="form-check-label fs-5 mb-2 fw-bold">公開設定</label>
                    <div class="ms-3 d-flex gap-3">

                        <div class="form-check">
                            <input name="is_public" value="true" type="radio" class="form-check-input" id="exampleCheck1"
                            {{ isset($question_group) && !$question_group->published_at ? '' : 'checked'}}
                            >
                            <label class="form-check-label fw-bold" for="exampleCheck1">公開</label>
                        </div>
                        <div class="form-check">
                            <input name="is_public" value="" type="radio" class="form-check-input" id="exampleCheck2"
                            {{ isset($question_group) && !$question_group->published_at ? 'checked' : ''}}
                            >
                            <label class="form-check-label fw-bold" for="exampleCheck2">非公開</label>
                        </div>
                    </div>
                    <div class="ms-3 callout callout-success">
                        公開設定を『公開』に設定すると、他のユーザに問題を公開することができます。
                    </div>
                </div>
                @endif


                <!-- 説明文 -->
                <div class="form-group mb-4">
                    <label for="resume_input1" class="form-check-label fs-5 mb-2 fw-bold"
                    >説明文</label>
                    <textarea name="resume" class="form-control" id="resume_input1" rows="3" maxlength="150"
                    placeholder="問題集の簡単な説明を書きましょう！"
                    >{{ isset($question_group) ? $question_group->resume : '' }}</textarea>
                    <div class="form-text">※150文字以内</div>
                </div>


                <!-- タグ -->
                <div class="form-group mb-4">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >タグ</label>
                    <input type="text" name="tags" class="form-control" id="exampleFormControlInput1" placeholder="タグ"
                    value="{{ isset($question_group) ? $question_group->tags : '' }} "
                    style="height:2rem;" maxlength="150">
                    <div class="form-text">※タグが複数あるときは、全角または半角スペースで区切ってください。</div>
                </div>


                <!-- サムネ画像 -->
                <div class="form-group mb-4">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >サムネ画像</label>

                    @php $img_path = isset($question_group) ? $question_group->image_puth : 'site/image/no_image.png' ; @endphp
                    <read-image-file-component img_path="{{asset('storage/'.$img_path)}}"></read-image-file-component>

                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
                </div>


                <!-- 送信ボタン -->
                <div class="mt-5 mb-5">
                    <div class="d-grid gap-2 col-md-4 mx-auto">
                        <button class="btn btn-success btn-lg rounded-pill" type="submit">
                            @if ( empty($question_group) )
                            問題集の新規作成
                            @else
                            問題集基本情報の更新
                            @endif
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
@endsection
