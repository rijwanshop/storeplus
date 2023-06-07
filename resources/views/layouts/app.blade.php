<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Store</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        @stack('inline-css')
    </head>
    <body class="bg-body-tertiary">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">Laravel Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse py-2" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex gap-4">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('category.table') ? 'active' : '' }}" aria-current="page" href="{{ route('category.table') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('product.table') ? 'active' : '' }}" aria-current="page" href="{{ route('product.table') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('file.table') ? 'active' : '' }}" aria-current="page" href="{{ route('file.table') }}">Images</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        @stack('inline-js')
    </body>
</html>
