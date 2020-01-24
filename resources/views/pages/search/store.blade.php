<!DOCTYPE html>
<html>

<head>
    @include('partials._header')
    <style type="text/css">
        .search-container img {
           height: 500px;
    width: auto;
    margin-top: 20px;
    border-radius: 300px;
        }
        .search-container p {
            font-size: 70px;
            text-align: center;
        }
    </style>
</head>

<body class="skin-blue layout-top-nav ">

    <div id="app">

        <div class="container">
            <div class="search-container container">
            @if($student)
            <img class=" img-responsive center-block" src="{{asset('storage/'.$student->photo)}}">
                <p>{{ strtoupper($student->firstname) }}  {{ strtoupper($student->middlename) }}  {{ strtoupper($student->lastname) }}</p>
                <p>{{ strtoupper($student->sectgrade) }}  - {{ strtoupper($student->sectname) }} ({{$purpose}} )</p>
            @else
                <img class="img-responsive center-block" src="{{asset('storage/logo.jpg')}}">
                <p class="text-danger">UNKNOWN CARD</p>
            @endif
                
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        window.setTimeout(function() {
            window.location.href = "{{ route('search.index') }}";
        }, 5000);
    </script>
</body>

</html>