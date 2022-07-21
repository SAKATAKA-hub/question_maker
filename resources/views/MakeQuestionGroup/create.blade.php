@extends('layouts.base')


<!----- title ----->
@section('title','問題集の新規作成')

<!----- breadcrumb ----->
@section('breadcrumb')
<nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0  bg-white">
        <li class="breadcrumb-item"><a href="#" class="text-success">
            <i class="bi bi-house-door-fill"></i> Home
        </a></li>
        <li class="breadcrumb-item" aria-current="page">
            問題集の新規作成
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
            問題集の新規作成
        </h2>
    </div>
</section>


<section>
    <div class="container-1200 pt-5">

        <!-- [ 基本情報 ] -->
        <h3 class="text-secondary fw-bold mb-3">
            基本情報を入力する
        </h3>

        <form action="{{ route('make_question_group.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-5 card-body">

                <!-- タイトル -->
                <div class="form-group mb-4">
                    <label for="title_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >タイトル</label>
                    <input type="text" name="title" class="form-control" id="title_input" placeholder="問題集のタイトル"
                    style="height:2rem;" maxlength="150" required>
                </div>


                <!-- 説明文 -->
                <div class="form-group mb-4">
                    <label for="resume_input1" class="form-check-label fs-5 mb-2 fw-bold"
                    >説明文</label>
                    <textarea name="resume" class="form-control" id="resume_input1" rows="3" maxlength="150"
                    placeholder="問題集の簡単な説明を書きましょう！"
                    ></textarea>
                    <div class="form-text">※150文字以内</div>
                </div>


                <!-- サムネ画像 -->
                <div class="form-group mb-4">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >サムネ画像</label>

                    <read-image-file-component img_path="{{asset('storage/app/image/no_image.png')}}"></read-image-file-component>

                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
                </div>


                <!-- タグ -->
                <div class="form-group mb-4">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >タグ</label>
                    <input type="text" name="tags" class="form-control" id="exampleFormControlInput1" placeholder="タグ"
                    style="height:2rem;" maxlength="150">
                    <div class="form-text">※タグが複数あるときは、全角または半角スペースで区切ってください。</div>
                </div>

                <!-- 公開設定 -->
                <div class="mb-4">
                    <label class="form-check-label fs-5 mb-2 fw-bold">公開設定</label>
                    <div class="ms-3 d-flex gap-3">

                        <div class="form-check">
                            <input name="is_public" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                            <label class="form-check-label fw-bold" for="exampleCheck1">公開</label>
                        </div>
                        <div class="form-check">
                            <input name="is_public" value="" type="radio" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label fw-bold" for="exampleCheck2">非公開</label>
                        </div>

                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="mt-5 mb-5">
                    <div class="d-grid gap-2 col-md-4 mx-auto">
                        <button class="btn btn-success btn-lg rounded-pill" type="submit">基本情報登録</button>
                    </div>
                </div>

            </div>
        </form>


        <!-- [ 問題を登録する ] -->
        {{-- <h3 class="text-secondary fw-bold mb-3">
            問題を登録する
        </h3>
        <ul class="p-0">
            <!-- ひとつの答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between  mb-3">
                        <h3 class="text-secondary fw-bold mb-0">01問目</h3>
                        <a href="" class="btn btn-danger btn-sm">削除</a>
                    </div>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >回答選択肢</label>
                        <div class="row gap-1 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input name="ans" value="" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;" required>
                            </div>
                            <div class="col-auto">
                                <a href="" class="text-danger" style="text-decoration:none;">削除</a>
                            </div>
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                        <div class="row gap-1 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input name="ans" value="" type="radio" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;" required>
                            </div>
                            <div class="col-auto">
                                <a href="" class="text-danger" style="text-decoration:none;">削除</a>
                            </div>
                        </div>
                        @endfor
                        <div class="ms-2 mt-3">
                            <button type="button" class="btn btn-light border">+ 選択肢の追加</button>
                        </div>

                    </div>

                </div>
            </li>

            <!-- 複数の答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">
                    <h3 class="text-secondary fw-bold mb-3"
                    >01問目</h3>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >回答選択肢</label>
                        @for ($i = 0; $i < 4; $i++)
                        <div class="row gap-3 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;">
                            </div>
                        </div>
                        @endfor
                        <div class="ms-2 mt-3">
                            <button type="button" class="btn btn-light border">+ 選択肢の追加</button>
                        </div>

                    </div>

                </div>
            </li>

            <!-- 複数の答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">
                    <h3 class="text-secondary fw-bold mb-3"
                    >01問目</h3>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >正解</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;">
                    </div>

                </div>
            </li>

        </ul>

        <div class="mt-3">
            <button type="button" class="btn btn-secondary border">+ 問題の追加</button>
        </div> --}}


            <!-- 送信ボタン -->
            {{-- <div class="m-3 mb-5">
                <div class="d-grid gap-2 col-md-4 mx-auto">
                    <button class="btn btn-success btn-lg rounded-pill" type="button">確　認</button>
                </div>
            </div>
        --}}

    </div>
</section>
@endsection
