@extends('layout')
@section('content')
    @if(session('success'))
        <div class="alert alert-success" style="hide(10)">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">Все участки</h3>
            <a href="{{route('area.create')}}">Добавить участок</a>
            <div class="row ">
                <div class="col-lg-4 col-sm-6">
                    <form action="{{route('main')}}" class="d-flex mt-3">
                        <input class="form-control me-2" type="search" name="SearchByName" placeholder="Поиск по владельцу">
                        <button class="btn btn-success" type="submit">Поиск</button>
                    </form>
                </div>
                <div class="col-lg-4 col-sm-6">

                    <form action="{{route('main')}}" class="d-flex mt-3">

                        <input class="form-control me-2" type="search" name="SearchByNumber" placeholder="Поиск по участку">
                        <button class="btn btn-success" type="submit">Поиск</button>
                    </form>
                    <p style="font-size:12px">Без пробелов, например: 2массив2линия34</p>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
           <div class="col-3">{{ $areas->withQueryString()->links() }}</div>
        </div>
            <table class="table">
                <thead>
                <tr>
                    <th>номер</th>
                    <th>владелец</th>
                    <th>Площадь</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $al)
                    <tr class="tr-link" onclick="window.location='{{ route('dashboard', $al->id) }}';">
                        <td> {{$al->number}}</td>
                        <td> {{$al->name}}</td>
                        <td> {{$al->square}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <div class="row  justify-content-center">
            <div class="col-3"> {{ $areas->withQueryString()->links() }} </div>
        </div>
        </div>
    </div>

@endsection

