@extends('layout')
@section('content')
    @if(session('success'))
        <div class="alert alert-success" style="hide(10)">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row mt-3">
            <h3>Все участки</h3>
            <a href="{{route('area.create')}}">Добавить участок</a>
            <div class="col-lg-3 col-sm-6">
                <form action="{{route('main')}}" class="d-flex mt-3">
                    <input class="form-control me-2" type="search" name="value" placeholder="Поиск по владельцу">
                    <button class="btn btn-success" type="submit">Поиск</button>
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
                    <th>номер</th>
                    <th>адрес собст.</th>
                    <th>телефон</th>
                    <th>имя</th>
                    <th>площадь</th>

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

