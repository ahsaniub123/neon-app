<html>
<head>
    <title>Neon Light</title>
    <link rel="stylesheet" href="{{ asset('polished.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        hr {
            margin: 2rem 0;
        }
    </style>
</head>

<body>

<nav class="navbar bg-primary-darkest navbar-expand p-0">
    <a class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2 mr-0" href="{{ route('board_pricing') }}">
        NeonLight</a>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('board_pricing') }}">Board Pricing</a>
{{--            <a class="nav-link text-white" href="{{ route('board.pricing.all') }}">Pricing</a>--}}
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('board.color.all') }}">Colors12</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('board.font.all') }}">Fonts</a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-white" href="{{ route('board.options') }}">Options</a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('boards') }}">Boards</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('slid.pictures') }}">Slider Pictures</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('character_diemensions') }}">Character Dimensions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('font_group') }}">Font Group</a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-white" href="{{ route('board_pricing') }}">Board Pricing</a>--}}
{{--        </li>--}}
    </ul>
</nav>

<div class="container-fluid h-100 p-0">
    <div style="min-height: 100%" class="flex-row d-flex">
        <div class="col-lg-12 col-md-12 pl-5 pt-3 pr-5">
            @include('layouts.flash_message')
            @yield('content')
        </div>
    </div>
</div>


{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}") ;
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}") ;
    @endif

</script>
@yield('js')
</body>

</html>
{{--I will develop and customize shopify store, app ,themes--}}

