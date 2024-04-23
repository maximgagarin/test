

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


    <title>Отчет</title>
</head>
<div>
    <h7>СНТ "Заря-2"</h7>

    @if(isset($type))
        <p>Задолженности по {{ $type }}</p>
    @else
        <p>Общие задолженности</p>
    @endif
</div>

<table class=" table table-bordered">
    <thead>
    <tr>
        <th>Участок</th>
        <th>Владелец</th>

        <th class="">начислено</th>
        <th class="">оплачено</th>
        <th class="text-danger">долг</th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $result)
        <tr>
            <td> {{$result->number}}</td>
            <td> {{$result->name}}</td>

            <td>{{number_format( $result->total_payments_sum,2,'.','')}}р.</td>
            <td> {{number_format($result->total_payment_movs_sum,2,'.','')}}р.</td>
            <td> {{  $result->total_payments_sum - $result->total_payment_movs_sum}}р.</td>
        </tr>
    @endforeach
    </tbody>
</table>

<style>

    @page {
        /*size: 210mm 297mm; */
        size: 210mm 297mm;
        /* Chrome sets own margins, we change these printer settings */
        margin: 10mm 10mm 10mm 10mm;
    }

    .table{
        font-size: 13px

    }

    .table td{
        margin: 0;
        padding: 0;
    }

    .table tr{
        margin: 0;
        padding: 0;
    }

    .table th{
        margin: 0;
        padding: 0;
    }





</style>

















