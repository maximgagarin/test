@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Все участки</h3>
            <a href="{{route('area.create')}}">Добавить участок</a>
            <div class="col-3">
                <form action="{{route('main')}}" class="d-flex mt-3">
                    <input class="form-control me-2" type="search" name="value" placeholder="Найти участок">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
            <div class="col-3">

            </div>
        </div>

        <div class="row p-3">
           <div> {{$areas->links()}} </div>
            <table class="table mt-3">
                {{$value}}
                <thead>
                <tr>
                    <th scope="col">номер</th>
                    <th scope="col">адрес</th>
                    <th scope="col">телефон</th>
                    <th scope="col">имя</th>
                    <th scope="col">площадь</th>

                    <th scope="col">перейти</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $al)
                    <tr>
                        <td> {{$al->number}}</td>
                        <td> {{$al->address}}</td>
                        <td> {{$al->telephone}}</td>
                        <td> {{$al->name}}</td>
                        <td> {{$al->square}}</td>

                        <td><a href="{{ route('dashboard', $al->id) }}">Перейти</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$areas->links()}}
        </div>

    </div>

@endsection

