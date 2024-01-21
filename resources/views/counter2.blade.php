
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

<div class="ror"> <h3>Показания счетчика</h3></div>

<div class="row">

    <div class="col-3">
        <form  action="{{ route('store2') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Показания</label>
                <input type="number" class="form-control" name="value">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Тариф</label>
                <select name="select" class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    @foreach($tariffs as $tariff)
                        <option value="{{ $tariff->value }}">{{ $tariff->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="date">
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="areas_id" value="{{$id}}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
    <div class="col-3 p-3">
        @if (empty($lastValue))
            нет показаний
        @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">показание</th>
                <th scope="col">дата</th>
                <th scope="col">id</th>
                <th scope="col">id</th>
            </tr>
            </thead>
            <tbody>
            @foreach($counts as $count)
                <tr>
                    <td> {{$count->value}}</td>
                    <td> {{$count->date}}</td>
                    <td> <button class="btn btn-primary btn-sm">Редактировать</button></td>
                    <td> <button class="btn btn-danger btn-sm">Удалить</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>


@endsection
