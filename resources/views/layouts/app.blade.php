<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('title' ,'Online Shop') </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"  href="{{URL ::asset('assets/img/iconWebsite.png') }}">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css')}}" type="text/css" />

    <!-- Slick -->
    <link rel="stylesheet" href="{{ URL ::asset('assets/css/slick.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL ::asset('assets/css/slick-theme.css')}}" type="text/css" />

    <!-- nouislider -->
    <link rel="stylesheet" href="{{ URL ::asset('assets/css/nouislider.min.css')}}" type="text/css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ URL ::asset('assets/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="{{ URL ::asset('assets/css/style.css')}}" type="text/css" />

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha384-i61gTtaoovXtAbKjo903+O55Jkn2+RtzHtvNez+yI49HAASvznhe9sZyjaSHTau9" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    @include ('includes.header')
    <main>@yield ('content')</main>
    @include ('includes.footer')

</body>