<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>{{ $title }}</title>
</head>
<body>
@include('map')
<div class="container">
    <h1>To participate in the conference, please fill out the form</h1>
    @yield('content')
</div>
<br>
<script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/3.2.7/dist/min/jquery.inputmask.bundle.min.js"
        type="text/javascript"></script>
<script src="https://cdn.rawgit.com/andr-04/inputmask-multi/1.2.0/js/jquery.inputmask-multi.min.js"
        type="text/javascript"></script>
<script src="js/form.js"></script>
</body>
</html>