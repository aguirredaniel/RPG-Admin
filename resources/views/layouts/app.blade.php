<html lang="en">
<head>
    <title>Laravel Quickstart - Basic</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
          crossorigin="anonymous">
    <style>
        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">RPG</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/">Dashboard</a></li>
                <li><a href="/hero">Heroes</a></li>
                <li class="disabled"><a href="#">Monsters</a></li>
            </ul>
        </div>
    </nav>
    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
