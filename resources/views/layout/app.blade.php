<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clinic Appointment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=
          "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          rel="stylesheet">
    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
    </script>
    <script src=
            "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>My Clinic</h1>

</div>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('home')}}">Home</a></li>
        </ol>
    </nav>
    @yield('content')

</div>

</body>
</html>
