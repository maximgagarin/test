
<!doctype html>
<html>
<title>Квитанция</title>

<head>
    <meta charset="utf-8">
    <title>Квитанция</title>
</head>
<title>Квитанция</title>

<div>
    <table class="table-check">
        <tr>
            <td rowspan="9" class="td-td"><img src="/qr.png?t=<?php echo time(); ?>" alt=""></td>
            <td><strong>Получатель:</strong> {{$Name}}</td>
        </tr>
        <tr>
            <td><strong>Банк:</strong>{{$BankName}}</td>
        </tr>
        <tr>
            <td><strong>БИК:</strong>  {{$BIC}}</td>
        </tr>
        <tr>
            <td><strong>ИНН:</strong>  {{$PayeeINN}}</td>
        </tr>
        <tr>
            <td><strong>Счет:</strong>{{$personalAcc}}</td>
        </tr>
        <tr>
            <td><strong>Корр счет:</strong>{{$CorrespAcc}}</td>
        </tr>
        <tr>
            <td><strong>Плательщик:</strong> {{$namesnt}}</td>
        </tr>
        <tr>
            <td><strong>Сумма:</strong> {{$totalsum}}р.   </td>
        </tr>
        <tr class="table_tr">
            <td >Подпись:_________Дата: "__" _______20__ г.</td>
        </tr>

    </table>
    <table class="table-check">
        <tr>
            <td rowspan="9" class="td-td"></td>
            <td><strong>Получатель:</strong>{{$Name}}</td>
        </tr>
        <tr>
            <td><strong>Банк:</strong>{{$BankName}}</td>
        </tr>
        <tr>
            <td><strong>БИК:</strong>  {{$BIC}}</td>
        </tr>
        <tr>
            <td><strong>ИНН:</strong>  {{$PayeeINN}}</td>
        </tr>
        <tr>
            <td><strong>Счет:</strong>{{$personalAcc}}</td>
        </tr>
        <tr>
            <td><strong>Корр счет:</strong>{{$CorrespAcc}}</td>
        </tr>
        <tr>
            <td><strong>Плательщик:</strong> {{$namesnt}}  </td>
        </tr>
        <tr>
            <td><strong>Сумма:</strong> {{$totalsum}}р. </td>
        </tr>
        <tr>
            <td>Подпись:_________Дата: "__" _______20__ г.</td>
        </tr>
    </table>
</div>
<br>
<div>
    <p> Расшифровка по взносам</p>
    <h7>Участок: {{$numbersnt}}</h7>
    <h7>Владелец: {{$namesnt}}</h7>
    <table class="table-check-2" >
        <thead>
        <tr>
            <th>тип</th>
            <th>сумма</th>
            <th>год</th>
        </tr>
        </thead>
        <tbody>
        @foreach($selectedPayments as $count)
            <tr>
                <td>{{ $count->type }}</td>
                <td>{{number_format($count->sum,2,'.','')}}р.</td>
                <td>{{ \Carbon\Carbon::parse($count->date)->format('Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</html>

<style>

    @page {
        /*size: 210mm 297mm; */
        size: 210mm 297mm;
        /* Chrome sets own margins, we change these printer settings */
        margin: 10mm 10mm 10mm 10mm;
    }


    .table-check{
        border: 1px solid black;
        border-spacing: 0;
        width: 700px;

    }

    td{
        padding: 6px;
        border-right: 1px solid black;

    }

    img{
        width: 200px;
        height: 200px;
    }

    .td-td{
        width: 250px;
    }

    .table_tr{
        font-size: 16px;
        line-height: 30px;
    }

    .table-check-2 {
        border: 1px solid black;
        border-spacing: 0;
        width: 700px;
    }

    .table-check-2 td{
        border: 1px solid gray;

    }



</style>
