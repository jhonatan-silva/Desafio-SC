<!DOCTYPE html>
<html>
<head>
    <title>Desafio SC</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style type="text/css">
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 99990;
            background: 50% 50% no-repeat rgba(10, 10, 10, .5)
        }
    </style>
</head>
<body>

<h3 class="pb-4 mb-4 font-italic border-bottom">
    <span style="padding: 1%">DESAFIO SC</span>
</h3>

<main role="main" class="container" style="max-width: 95%;">
    <div class="row">
        <div class="col-md-12 blog-main">
            @yield('content')
        </div>
    </div>
</main>

@yield('scripts')
<script type="application/javascript">
    function startLoading() {
        if (!$('.loader').length) {
            $('body').append('<div class="loader">' +
                '<div class="d-flex justify-content-center">  ' +
                '<div class="spinner-border" role="status" style="margin-top: 30%;">' +
                '</div>' +
                '</div>' +
                '</div>');
        }
    }

    function stopLoading() {
        if ($('.loader').length) {
            $('.loader').fadeToggle(function () {
                $(this).remove();
            });
        }
    }
</script>
</body>
</html>