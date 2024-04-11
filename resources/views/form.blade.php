
@extends('layout')
@section('content')
<div class="container">
    <h4 class="text-center mb-4 mt-4">Проверить Данные на квитанцию</h4>
    <form class="myForm" id="form1" action="{{route('check')}}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-4">
                <h5>Участок</h5>
                <div class="mb-3">
                    <label>Номер участка</label>
                    <input type="" class="form-control" name="number" value="{{$number}}" >
                </div>
                <div class="mb-3">
                    <label>Владелец</label>
                    <input type="text" class="form-control" name="namesnt" value="{{$name}}" >
                </div>
                <div class="mb-3">
                    <label>Сумма</label>
                    <input type="text" class="form-control" name="totalsum" value="{{$totalsum}}" >
                </div>

            </div>
            <div class="col-4">
                <h5>Реквизиты банка</h5>
                <div class="mb-3">
                    <label>Получатель</label>
                    <input type="" class="form-control" name="Name" value="СНТ Заря-2" >
                </div>
                <div class="mb-3">
                    <label>Счет получателя</label>
                    <input type="text" class="form-control" name="PersonalAcc" value="40703810835164901873" placeholder="" >
                </div>
                <div class="mb-3">
                    <label>Банк</label>
                    <input type="text" class="form-control" name="BankName" value="Липецкое отделение №8593 ПАО Сбербанк г.Липецк" >
                </div>
                <div class="mb-3">
                    <label>БИК</label>
                    <input type="text" class="form-control" name="BIC" value="044206604" >
                </div>
                <div class="mb-3">
                    <label>К/С</label>
                    <input type="text" class="form-control" name="CorrespAcc" value="30101810800000000604" placeholder="">
                </div>
                <div class="mb-3">
                    <label>ИНН</label>
                    <input type="text" class="form-control" name="PayeeINN" value="4813003083" placeholder="">
                </div>
                <div class="mb-3">
                    <label>Назначение платежа</label>
                    <input type="text" class="form-control" name="Purpose" value="Плата за услуги" placeholder="">
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3 ">
                <button type="submit" class="btn btn-primary mb-3">Создать квитанцию
                </button>
            </div>
        </div>
    </form>
    </div>

</div>
@endsection
