
@extends('layout')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container">
    <h5 class="mt-3">Создание участка</h5>
    <div class="col-lg-4 col-sm-6" >
    <form class="mt-3 " id="form1" action="{{route('area.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Номер участка</label>
            <input type="text" class="form-control" name="number" >
            <p style="font-size:12px">Без пробелов, например: 2массив2линия34</p>
        </div>
        <div class="mb-3">
            <label>Собственник</label>
            <input type="text" class="form-control" name="name" >
        </div>
        <div class="mb-3">
            <label>Адрес собственника</label>
            <input type="text" class="form-control" name="address" >
        </div>
        <div class="mb-3">
            <label>Телефон</label>
            <input type="text" class="form-control" name="telephone">
        </div>

        <div class="mb-3">
            <label>Площадь участка</label>
            <input type="text" class="form-control" name="square" >
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Сохранить
            </button>
        </div>
    </form>
    </div>

</div>
@endsection
