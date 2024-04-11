<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src='/decimal.js'></script>
    <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/styles.css') }}">
    <title>Document</title>
</head>
<header class="d-flex justify-content-center py-3  "  style="background-color: lightgray">
    <ul class="nav">
        <li class="nav-item"><a href="{{route('main')}}" class="nav-link " aria-current="page">Все участки</a></li>

        <li class="nav-item"><a href="{{route('vznos')}}" class="nav-link">Взносы</a></li>
        <li class="nav-item"><a href="{{route('debts')}}" class="nav-link">Долги</a></li>
        <li class="nav-item"><a href="{{route('incomingall')}}" class="nav-link">Все оплаты</a></li>
    </ul>

</header>
<body>


@yield('content')


</body>

</html>

