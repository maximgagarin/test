
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
    <h4 class="mb-4">Рассчеты по участкам за </h4>
</div>



<div class="col-8">
    <table class="table table-bordered">
        <tr>
            <td></td>
            <td>Начислено</td>
            <td>Оплачено</td>
        </tr>
        <tr>
            <td>электроэнергия</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>членский взнос</td>
            <td>{{$DebtChvznos}}</td>
            <td></td>
        </tr>
        <tr>
            <td>мусор</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>дороги</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>благоустройство</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Итого</td>
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






</style>
