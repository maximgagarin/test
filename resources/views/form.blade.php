
@extends('layout')
@section('content')
<div class="container">
    <h4 class="text-center mb-4 mt-4">Данные на квитанцию</h4>
    <form class="myForm" id="form1" action="" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-4">
                <h5>Участок</h5>
                <div class="mb-3">
                    <label>Номер участка</label>
                    <input type="" class="form-control" name="id" value="{{$number}}" >
                </div>
                <div class="mb-3">
                    <label>Владелец</label>
                    <input type="text" class="form-control" name="number" value="{{$name}}" >
                </div>
                <div class="mb-3">
                    <label></label>
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
                    <label>Площадь участка</label>
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
                    <input type="text" class="form-control" name="PersonalAcc" value="40802810700020000317" >
                </div>
                <div class="mb-3">
                    <label>BankName</label>
                    <input type="text" class="form-control" name="BankName" value="'ОАО АКБ «АВАНГАРД»" >
                </div>
                <div class="mb-3">
                    <label>BIC</label>
                    <input type="text" class="form-control" name="BIC" value="044525201" >
                </div>
                <div class="mb-3">
                    <label>CorrespAcc</label>
                    <input type="text" class="form-control" name="CorrespAcc" value="30101810000000000201" >
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3 ">
                <button type="submit" class="btn btn-primary btn-sm mb-3">Создать квитанцию
                </button>
            </div>
        </div>
    </form>
    </div>

</div>
@endsection
