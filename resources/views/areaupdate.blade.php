
@extends('layout')
@section('content')
<div class="container">
    <h5>Редактирование данных участка</h5>
    <div class="col-4">
    <form class="myForm" id="form1" action="{{route('area.update')}}" method="POST">
        @csrf
        <div class="mb-3">

            <input type="hidden" class="form-control" name="id" value="{{$result->id}}" placeholder="количество квт">
        </div>
        <div class="mb-3">
            <label>Номер участка</label>
            <input type="text" class="form-control" name="number" value="{{$result->number}}" placeholder="количество квт">
        </div>
        <div class="mb-3">
            <label>Собственник</label>
            <input type="text" class="form-control" name="name" value="{{$result->name}}" placeholder="количество квт">
        </div>
        <div class="mb-3">
            <label>Адрес собственника</label>
            <input type="text" class="form-control" name="address" value="{{$result->address}}" placeholder="количество квт">
        </div>
        <div class="mb-3">
            <label>Телефон</label>
            <input type="text" class="form-control" name="telephone" value="{{$result->telephone}}" placeholder="количество квт">
        </div>

        <div class="mb-3">
            <label>Площадь участка</label>
            <input type="text" class="form-control" name="square" value="{{$result->square}}" placeholder="количество квт">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Сохранить
            </button>
        </div>
    </form>
    </div>

</div>
@endsection
