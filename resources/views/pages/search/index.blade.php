<!DOCTYPE html>
<html>

<head>
    @include('partials._header')
    <style type="text/css">
        .search-container img {
            height: 400px;
            width: auto;
            padding: 20px;
        }
        
        .digital-clock {
            margin-top: 50px;
            color: #418731;
            text-align: center;
            font: 100px/110px 'DIGITAL', Helvetica;
        }
    </style>
</head>

<body class="skin-blue layout-top-nav ">

    <div id="app">

        <div class="container">

            <div class="search-container container">
                <img class="img-responsive center-block" src="{{asset('storage/logo.jpg')}}">
                <form method="POST" action="{{ route('search.store') }}">
                    @csrf
                    <div class="input-group input-group-lg">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success">Scan ID Here
                            </button>
                        </div>
                        <input type="text" name="crd_id" id="crd_id" class="form-control" autofocus="on">
                    </div>
                </form>
                <div class="digital-clock center-block">00:00:00</div>
            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            clockUpdate();
            setInterval(clockUpdate, 1000);
            document.getElementById("crd_id").focus();

        })

        function clockUpdate() {
            var date = new Date();

            function addZero(x) {
                if (x < 10) {
                    return x = '0' + x;
                } else {
                    return x;
                }
            }

            function twelveHour(x) {
                if (x > 12) {
                    return x = x - 12;
                } else if (x == 0) {
                    return x = 12;
                } else {
                    return x;
                }
            }

            var h = addZero(twelveHour(date.getHours()));
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());

            $('.digital-clock').text(h + ':' + m + ':' + s)
        }
    </script>
</body>

</html>