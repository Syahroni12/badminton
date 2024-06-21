@include('templating.header')

<body class="sb-nav-fixed">
   @include('templating.navbar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('templating.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $title }}</h1>
                    <ol class="breadcrumb mb-4">

                        <li class="breadcrumb-item active"></li>
                    </ol>
                    @include('sweetalert::alert')

                    @yield('content')
                </div>
            </main>
            @include('templating.footer_halaman')
        </div>
    </div>

    @include('templating.footer_js')
