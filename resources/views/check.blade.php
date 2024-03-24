
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Квитанция</title>
</head>
<title>Квитанция</title>

<div>
    <table class="table-check">
        <tr>
            <td rowspan="8" class="td-td"><img src="/qr.png" alt=""></td>
            <td>Получатель:</td>
        </tr>
        <tr>
            <td><strong>Банк:</strong>{{$BankName}}</td>
        </tr>
        <tr>
            <td><strong>БИК:</strong>  {{$BIC}}</td>
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
            <td><strong>Сумма:</strong> {{$totalsum}}р.</td>
        </tr>
        <tr>
            <td>Подпись:_________Дата: "__" _______20__ г.</td>
        </tr>
    </table>
    <table class="table-check">
        <tr>
            <td rowspan="8" class="td-td"></td>
            <td>Получатель:</td>
        </tr>
        <tr>
            <td><strong>Банк:</strong>{{$BankName}}</td>
        </tr>
        <tr>
            <td><strong>БИК:</strong>  {{$BIC}}</td>
        </tr>
        <tr>
            <td><strong>Счет:</strong></td>
        </tr>
        <tr>
            <td><strong>Корр счет:</strong></td>
        </tr>
        <tr>
            <td><strong>Плательщик:</strong> {{$namesnt}}</td>
        </tr>
        <tr>
            <td><strong>Сумма:</strong> {{$totalsum}}р.</td>
        </tr>
        <tr>
            <td>Подпись:_________Дата: "__" _______20__ г.</td>
        </tr>
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

</style>