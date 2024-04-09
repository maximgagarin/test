@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Все участки</h3>
            <a href="{{route('area.create')}}">Добавить участок</a>
            <div class="col-lg-3 col-sm-6">
                <form action="{{route('main')}}" class="d-flex mt-3">
                    <input class="form-control me-2" type="search" name="value" placeholder="Поиск по владельцу">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
           <div class="col-3"> {{$areas->links()}} </div>
        </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">номер</th>
                    <th scope="col">адрес</th>
                    <th scope="col">телефон</th>
                    <th scope="col">имя</th>
                    <th scope="col">площадь</th>

                </tr>
                </thead>
                <tbody>
                @foreach($areas as $al)
                    <tr class="tr-link" onclick="window.location='{{ route('dashboard', $al->id) }}';">
                        <td> {{$al->number}}</td>
                        <td> {{$al->address}}</td>
                        <td> {{$al->telephone}}</td>
                        <td> {{$al->name}}</td>
                        <td> {{$al->square}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        <div class="row  justify-content-center">
            <div class="col-3"> {{$areas->links()}} </div>
        </div>
        </div>
    </div>

@endsection

