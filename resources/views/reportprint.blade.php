
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
    <h5 class="mt-4">СНТ "Заря-2"</h5>
    <h5 class="mb-4">Рассчеты по участкам  </h5>
    <h6 class="mt-4">период с  {{ \Carbon\Carbon::parse($date1)->format('d-m-Y') }} по  {{ \Carbon\Carbon::parse($date2)->format('d-m-Y') }}</h6>
</div>



<div class="col-8">
    <table class="table table-bordered border-dark">
        <tr>
            <th>Вид</th>
            <th>Начислено</th>
            <th>Оплачено</th>
        </tr>
        <tr>
            <td>электроэнергия</td>
            <td>{{number_format($DebtSvet,2,'.','')}}</td>
            <td>{{number_format($PaidSvet,2,'.','')}}</td>
        </tr>
        <tr>
            <td>членский взнос</td>
            <td>{{number_format($DebtChvznos,2,'.','')}}</td>
            <td>{{number_format($PaidChvznos,2,'.','')}}</td>
        </tr>
        <tr>
            <td>мусор</td>
            <td>{{number_format($DebtTrash,2,'.','')}}</td>
            <td>{{number_format($PaidTrash,2,'.','')}}</td>
        </tr>
        <tr>
            <td>дороги</td>
            <td>{{number_format($DebtRoad,2,'.','')}}</td>
            <td>{{number_format($PaidRoad,2,'.','')}}</td>
        </tr>
        <tr>
            <td>благоустройство</td>
            <td>{{number_format($DebtBlag,2,'.','')}}</td>
            <td>{{number_format($PaidBlag,2,'.','')}}</td>
        </tr>
        <tr>
            <td><strong>Итого</strong></td>
            <td><strong>{{$SummDebt}}</strong></td>
            <td><strong>{{$SummPaid}}</strong></td>
        </tr>
    </table>


</div>












<style>

    @page {
        /*size: 210mm 297mm; */
        size: 210mm 297mm;
        /* Chrome sets own margins, we change these printer settings */
        margin: 10mm 10mm 10mm 10mm;
    }






</style>
