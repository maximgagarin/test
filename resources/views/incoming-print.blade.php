
<?php $sum1=0 ?>
<?php $sum2=0 ?>
<?php $sum3=0 ?>
<?php $sum4=0 ?>
<?php $sum5=0 ?>
<?php $sum6=0 ?>
<?php $sum7=0 ?>
<?php $sum8=0 ?>

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

    <p>оплаты: период с  {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} по  {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
</div>



<div class="col-12">
    <table class="table mt-3 table-bordered  " >

        <tr>
            <th>дата оплаты</th>
            <th>всего приход</th>
            <th>перешло в аванс</th>
            <th>всего оплачено</th>
            <th>энергия</th>
            <th>чвзнос</th>
            <th>мусор</th>
            <th>дороги</th>
            <th>благ.</th>
            <th>учасоток</th>
            <th>владелец</th>
        </tr>


        @foreach($results as $count)
            <tr>
                <td>{{ \Carbon\Carbon::parse($count->date)->format('d-m-Y') }}</td>
                <td> {{number_format($count->sum_incoming,2,'.','')}}</td>  <?php $sum1 += $count->sum_incoming; ?>
                <td>{{number_format($count->sum_left,2,'.','')}}</td>       <?php $sum2 += $count->sum_left; ?>
                <td>{{number_format($count->sum_paid,2,'.','')}}</td>      <?php $sum3 += $count->sum_paid; ?>
                <td>{{number_format($count->svet,2,'.','')}} </td>         <?php $sum4 += $count->svet; ?>
                <td>{{number_format($count->chvznos,2,'.','')}} </td>      <?php $sum5 += $count->chvznos; ?>
                <td> {{number_format($count->trash,2,'.','')}}</td>         <?php $sum6 += $count->trash; ?>
                <td>{{number_format($count->road,2,'.','')}}</td>         <?php $sum7 += $count->road; ?>
                <td>{{number_format($count->camera,2,'.','')}} </td>       <?php $sum8 += $count->camera; ?>
                <td>{{$count->number}} </td>
                <td>{{$count->name}} </td>
            </tr>
        @endforeach
        <tr class="text-danger ">
            <td>Итог</td>
            <td>{{$sum1}}р.</td>
            <td></td>
            <td>{{$sum3}}р.</td>
            <td>{{$sum4}}р.</td>
            <td>{{$sum5}}р.</td>
            <td>{{$sum6}}р.</td>
            <td>{{$sum7}}р.</td>
            <td>{{$sum8}}р.</td>
            <td></td>
            <td></td>
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
