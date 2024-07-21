<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/logo.png')}}">
    <title>PENPOS MOB FT 2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user/custom.css')}}">
    <link rel="stylesheet" href="{{asset('user/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/owlcarousel/assets/owl.theme.default.min.css')}}">
    <style>
        @import url('https://fonts.cdnfonts.com/css/sancreek');
        @import url('https://fonts.cdnfonts.com/css/bricolage-grotesque');
        /*@import url('https://fonts.cdnfonts.com/css/montserrat');*/

        * {
            font-family: 'Montserrat', sans-serif;
        }

        .title-mob {
            font-family: 'Sancreek', sans-serif;
            color: #390203;
        }

        .text-mob {
            /*color: #40128B;*/
            color: #390203;
            font-family: "Bricolage Grotesque", sans-serif;
        }
    </style>
    @yield('script_midtrans')
    @yield('css')
</head>
<body>
@yield('user_content')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ asset('user/owlcarousel/owl.carousel.min.js')}}"></script>
@yield('user_script')
</body>
</html>
