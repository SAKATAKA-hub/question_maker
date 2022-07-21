<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')


    <title>@yield('title')</title>


    <!-- ファビコン画像の読み込み -->
    <link rel="shortcut icon" href="{{asset('storage/site/image/favicon.png')}}">
    <!-- bootstrap アイコン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- avant-ui CSS -->
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    @yield('style')

</head>
<body>
    <header class="bg-white">
        <div class="container-1200">
            <h1 class="fs-5">
                {{-- <span class="fs-1 fw-bold text-success">問</span> --}}
                いちから作る問題集
            </h1>
        </div>
    </header>
    <main>
        <!-- breadcrumb -->
        <section  class="bg-white">
            <div class="container-1200">
                @yield('breadcrumb')
            </div>
        </section>


        <!-- contents -->
        <div id="app">
            @yield('contents')
        </div>


        <!-- フェードインアラート -->
        @php $session_alerts = [ 'alert-primary','alert-success','alert-info','alert-warning','alert-danger' ]; @endphp
        @foreach ($session_alerts as $alert_name)

            @if ( session( $alert_name ) )
                <div class="fadein-alert-box">
                    <div class="container-1200">
                        <p class="alert {{ $alert_name }} alert-dismissible fade show" role="alert">
                            {{ session( $alert_name ) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </p>
                    </div>
                </div>
            @endif

        @endforeach



    </main>
    <footer class="bg-dark p-3 text-center text-white">

        <p class="m-0 ">&copy; Next Arrow Inc. All Rights Reserved.</p>

    </footer>


    <!-- bootstrap JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- avant-ui JavaScript -->
    <script src="{{ asset('avant-ui/js/avantui.js') }}" defer></script>
    @yield('script')

</body>
</html>
