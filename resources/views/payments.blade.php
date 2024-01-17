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
    <title>Document</title>
</head>
<body>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">

{{--    <div class="col-3">--}}
{{--        <h3>Показания счетчика</h3>--}}
{{--        <form  action="{{ route('store') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>--}}
{{--                <input type="number" class="form-control" name="value">--}}

{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <input type="date" class="form-control" name="date">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <input type="number" class="form-control" name="areas_id">--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Отправить</button>--}}
{{--        </form>--}}
{{--    </div>--}}
    <div class="col-6">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">вид</th>
                <th scope="col">ед.изм</th>
                <th scope="col">колич</th>
                <th scope="col">тариф</th>
                <th scope="col">сумма</th>
                <th scope="col">дата</th>
                <th scope="col">статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <th> {{$payment->type}}</th>
                    <th> {{$payment->unit}}</th>
                    <th> {{$payment->amount}}</th>
                    <th> {{$payment->tariff}}</th>
                    <th> {{$payment->sum}}</th>
                    <th> {{$payment->date}}</th>
                    <th> {{$payment->status}}</th>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</div>



</body>

</html>
