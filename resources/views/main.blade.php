
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <h3>Все участки</h3>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">номер</th>
                    <th scope="col">адрес</th>
                    <th scope="col">телефон</th>
                    <th scope="col">имя</th>
                    <th scope="col">площадь</th>
                    <th scope="col">аванс</th>
                    <th scope="col">комент</th>
                    <th scope="col">кнопка</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all as $al)
                    <tr>
                        <td> {{$al->number}}</td>
                        <td> {{$al->address}}</td>
                        <td> {{$al->telephone}}</td>
                        <td> {{$al->name}}</td>
                        <td> {{$al->square}}</td>
                        <td> {{$al->balance}}</td>
                        <td> {{$al->comment}}</td>
                        <td> <a href="{{ route('dashboard', $al->id) }}">Перейти</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">

    </div>

</div>




@endsection

