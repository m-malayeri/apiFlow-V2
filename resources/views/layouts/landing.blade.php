<!DOCTYPE html>

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.nav')

    <section class="main-section">
        <div class="container">
            <div class="row my-main">
                <div class="col-md-3 sidebar">
                    @include('includes.mainSidebar')
                    @yield('extraSidebar')
                </div>
                <div class="col-md-9">
                    @if (Session::has('message'))
                    <div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger well-sm" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 footer">
                     
                </div>
            </div>
        </div>
    </footer>
</body>

</html>