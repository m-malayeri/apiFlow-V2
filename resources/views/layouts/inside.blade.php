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
                    @include('includes.insideSidebar')
                    @yield('extraSidebar')
                </div>
                <div class="col-md-9">
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