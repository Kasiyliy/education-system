<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        @yield('title','Мои курсы')
    </title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/assets/front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="/assets/front/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/front/css/creative.min.css" rel="stylesheet">
    @yield('styles')

</head>

<body id="page-top">
<!-- Navigation -->

@yield('nav')


@yield('content')


<script src="/assets/front/vendor/jquery/jquery.min.js"></script>
<script src="/assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/front/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/assets/front/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="/assets/front/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/assets/front/js/creative.min.js"></script>
@yield('scripts')
</body>

</html>
