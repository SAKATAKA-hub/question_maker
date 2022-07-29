<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>手作り問題集</title>

    <!-- ファビコン -->
    <link rel="icon" href="{{asset('storage/site/image/fabicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">


    <style>

        main{
            margin-top: 0;
            min-height: 100vh;
        }
        .card{
            text-decoration:none;
        }

        /* ＴＯＰ背景 */
        .top{
            position: relative;
        }
        .top_bg_container{
            position: absolute;
            top:0; right:0;
            width: 100%; height:100%;
            z-index: -1;
        }
        .top_bg{
            position: relative;
            width: 100%; height:100%;
        }
        .top_bg::after{
            content: '';
            position: absolute;
            top:0; right:0;
            width: 100%; height:100%;
            background-color: rgba(255, 255, 255, 0.843);
        }
    </style>

</head>
<body class="bg-white ">
    <header>
        <nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <strong class="text-success">mondai</strong>
                </a>

                <ul class="navbar-nav ms-auto p-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            ユーザーさん
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">成績を見る</a></li>
                            <li><a class="dropdown-item" href="#">問題を作る</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">ログアウト</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="">
        <section class="top">
            <!-- 背景 -->
            <div class="top_bg_container">
                <div class="top_bg" style="
                    background:url({{ asset('storage/site/image/22636100.jpg') }});
                    background-repeat  : repeat;
                "></div>
            </div>


            <div class="container-1200">
                <div class="px-4 py-5 my-5 text-center">
                    <h5 class="fw-bold">\自由に作れる！オリジナル問題集/</h5>
                    <h1 class="display-1 text-success fw-bold mb-4">mondai</h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">
                            このサイトはじぶんでオリジナルの<br class="d-md-none">
                            問題を作ることができます。<br>
                            作った問題を公開したり、<br class="d-md-none">
                            誰かが作った問題に挑戦したり、<br>
                            オリジナル問題制作をたのしもう！！
                        </small>
                        <div class="my-5">
                            <!-- 検索フォーム -->
                            <form action="#" method="POST">
                                <div  class="input-group overflow-hidden border shadow" style="border-radius:2rem;">
                                    <input type="text" class="form-control border-0 ps-3" placeholder="キーワード" aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text border-0" id="basic-addon1">
                                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="mt-5">
                            <a href="{{ route('make_question_group.list') }}" class="btn rounded-pill btn-outline-success btn-lg px-4"
                            >問題を作る</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <div class="container-1200 divider divider-dashed"></div><!---- Divider ----> --}}
        <section>
            <div class="container-1200">
                <div class="row mx-3">
                    <div class="col-md-6 order-md-2" >
                        <img src="{{ asset('storage/site/image/22901978.jpg') }}" class="d-block w-100" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <p class="fw-bold text-success">
                                Most popular handmade questions
                            </p>
                            <h3>もっとも人気な問題集をピックアップ！</h3>
                            <p class="my-4 text-secondary">
                                もっとも利用されている問題集をピックアップしました。<br>
                                問題を解いて、お気に入りの問題集をフォローしましょう！！
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row my-5 mx-3">

                    @foreach ($question_groups as $i => $question_group)

                        <div class="col-md-6 col-lg-4 p-3 pb-3">
                            <a href="#" class="card border-0 text-dark"
                            data-bs-toggle="modal" data-bs-target="#questionModal{{ $i+1 }}"
                            >
                                {{-- <img src="{{ asset('storage/site/image/sample3.jpeg') }}" style="border-radius:.5rem;" class="card-img-top" alt="問題サムネイル"> --}}
                                {{-- <img src="{{ asset('storage/'.$question_group->image_puth) }}" style="border-radius:.5rem; height:10rem;" class="card-img-top" alt="問題サムネイル"> --}}

                                <!-- サムネ画像 -->
                                <div class="card-image" style="
                                    background:url({{ asset('storage/'.$question_group->image_puth) }});
                                    background-repeat  : no-repeat;
                                    background-size    : cover;
                                    background-position: center center;
                                    height: 16rem; border-radius: .5rem;
                                "></div>
                                <div class="card-body">
                                    <h5 class="comment-author">{{ $question_group->title }}</h5>
                                    <span class="comment-date text-muted">7 日前</span>
                                    <p class="card-text">
                                        <span class="comment-reply">問題数：3問</span>
                                        <span class="comment-reply">制限時間：60分</span>
                                        <span class="comment-share">平均点：99.9点</span>
                                    </p>
                                    <p class="overflow-hidden" style="height: 3rem">
                                        サンプルで作った問題です。
                                    </p>
                                </div>
                            </a href="#">
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="questionModal{{ $i+1 }}" tabindex="-1" aria-labelledby="questionModal{{ $i+1 }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <div class="modal-title" id="questionModal{{ $i+1 }}Label">
                                        問題を開始します。<br>
                                        準備はよろしいですか？
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="media comment d-flex">
                                            <div class="media-body">
                                                <div class="media-body-header">
                                                    <h4 class="comment-author">{{ 'サンプル問題集'.$i+1 }}</h4>
                                                    <span class="comment-date text-muted">7 日前</span>
                                                    <span class="comment-reply">問題数：3問</span>
                                                    <span class="comment-reply">制限時間：60分</span>
                                                    <span class="comment-share">平均点：99.9点</span>
                                                </div>
                                            サンプルで作った問題です。
                                            <div class="d-flex">
                                                    <span></span>
                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                                        <a href="{{ route('question', ['id'=>$i+1, 'num'=>'1',] ) }}" class="btn btn-primary">開始</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
        <div class="container-1200 divider divider-dashed"></div><!---- Divider ---->
        <section>
            <div class="container-1200">

                <div class="row mx-3">
                    <div class="col-md-6" >
                        <img src="{{ asset('storage/site/image/22931523.jpg') }}" class="d-block w-100" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <p class="fw-bold text-success">
                                Challenge many questions!
                            </p>
                            <h3>多くの問題集にチャレンジしよう！</h3>
                            <p class="my-4 text-secondary">
                                多種多様な問題集が用意されています。<br>
                                みんなが作った問題を解いて、知識を広げよう！
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row my-5 mx-3">

                    @for ($i = 0; $i < 12; $i++)

                        <div class="col-md-6 col-lg-4 p-3 pb-3">
                            <a href="#" class="card border-0 text-dark"
                            data-bs-toggle="modal" data-bs-target="#questionModal{{ $i+1 }}"
                            >
                                <div class="card" style="
                                    background:url({{ asset('storage/site/image/sample3.jpeg') }});
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: center center;
                                    height:16rem; border-radius:.5rem;
                                "></div>

                                <div class="card-body">
                                    <h5 class="comment-author">{{ 'サンプル問題集'.$i+1 }}</h5>
                                    <span class="comment-date text-muted">7 日前</span>
                                    <p class="card-text">
                                        <span class="comment-reply">問題数：3問</span>
                                        <span class="comment-reply">制限時間：60分</span>
                                        <span class="comment-share">平均点：99.9点</span>
                                    </p>
                                    <p class="overflow-hidden" style="height: 3rem">
                                        サンプルで作った問題です。
                                    </p>
                                </div>
                            </a href="#">
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="questionModal{{ $i+1 }}" tabindex="-1" aria-labelledby="questionModal{{ $i+1 }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <div class="modal-title" id="questionModal{{ $i+1 }}Label">
                                    問題を開始します。<br>
                                    準備はよろしいですか？
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="media comment d-flex">
                                        <div class="media-body">
                                            <div class="media-body-header">
                                                <h4 class="comment-author">{{ 'サンプル問題集'.$i+1 }}</h4>
                                                <span class="comment-date text-muted">7 日前</span>
                                                <span class="comment-reply">問題数：3問</span>
                                                <span class="comment-reply">制限時間：60分</span>
                                                <span class="comment-share">平均点：99.9点</span>
                                            </div>
                                        サンプルで作った問題です。
                                        <div class="d-flex">
                                                <span></span>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                                    <a href="{{ route('question', ['id'=>$i+1, 'num'=>'1',] ) }}" class="btn btn-primary">開始</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>


    </main>
    <footer>
        <section class="bg-dark">
            <div class="section_container text-white text-center" style="font-size:.8rem;">
                <p class="d-inline-block m-0">Copyright &copy; Next Arrow Inc.</p>
                <p class="d-inline-block m-0">All Rights Reserved.</p>
            </div>
        </section>
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('avant-ui/js/avantui.js') }}" defer></script>


</body>
</html>
