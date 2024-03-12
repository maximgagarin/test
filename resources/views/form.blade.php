
@extends('layout')
@section('content')
<div class="container">
    <h4 class="text-center mb-4 mt-4">Данные на квитанцию</h4>
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
                <div class="mb-3">
                    <label></label>
                    <input type="text" class="form-control" name="address" value="" >
                </div>
                <div class="mb-3">
                    <label></label>
                    <input type="text" class="form-control" name="telephone" value="" >
                </div>

                <div class="mb-3">
                    <label></label>
                    <input type="text" class="form-control" name="square" value="" >
                </div>
            </div>
            <div class="col-4">
                <h5>Реквизиты банка</h5>
                <div class="mb-3">
                    <label>Name</label>
                    <input type="" class="form-control" name="Name" value="" >
                </div>
                <div class="mb-3">
                    <label>Счет получателя</label>
                    <input type="text" class="form-control" name="PersonalAcc" value="40817810254986004300" placeholder="" >
                </div>
                <div class="mb-3">
                    <label>BankName</label>
                    <input type="text" class="form-control" name="BankName" value="Филиал № 3652 Банка ВТБ (публичное акционерное общество) в г. Воронеже" >
                </div>
                <div class="mb-3">
                    <label>BIC</label>
                    <input type="text" class="form-control" name="BIC" value="0442007855" >
                </div>
                <div class="mb-3">
                    <label>К/С</label>
                    <input type="text" class="form-control" name="CorrespAcc" value="30101810545250000855" placeholder="">
                </div>
                <div class="mb-3">
                    <label>Назначение платежа</label>
                    <input type="text" class="form-control" name="Purpose" value="ДолгСНТ" placeholder="">
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
