
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
                    <input type="text" class="form-control" name="name" value="{{$name}}" >
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
                    <input type="" class="form-control" name="Name" value="ИП Богданов Александр Сергеевич" >
                </div>
                <div class="mb-3">
                    <label>PersonalAcc</label>
                    <input type="text" class="form-control" name="PersonalAcc" value="40802810700020000317" placeholder="номер расчетного счета получателя платежа" >
                </div>
                <div class="mb-3">
                    <label>BankName</label>
                    <input type="text" class="form-control" name="BankName" value="ОАО АКБ «АВАНГАРД»" >
                </div>
                <div class="mb-3">
                    <label>BIC</label>
                    <input type="text" class="form-control" name="BIC" value="044525201" >
                </div>
                <div class="mb-3">
                    <label>CorrespAcc</label>
                    <input type="text" class="form-control" name="CorrespAcc" value="30101810000000000201" placeholder="корреспондирующий счет банка получателя платежа">
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
