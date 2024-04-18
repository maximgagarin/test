
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

<h4 class="mt-3 mb-3 text-center">Рассчеты по участкам {{$PaidChvznos}}</h4>

<div class="container">
    <h6>Выбрать период</h6>
    <div class="row">
        <div class="col-lg-4 period">
            <form action="{{ route('report.calc') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="date" class="form-control" name="date1" value="">
                </div>
                <div class="mb-3">
                    <input type="date" class="form-control" name="date2" value="">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-sm">Сформировать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-8">
        <table class="table table-bordered">
            <tr>
                <td>Вид</td>
                <td>Начислено</td>
                <td>Оплачено</td>
            </tr>
            <tr>
                <td>электроэнергия</td>
                <td>{{$DebtSvet}}</td>
                <td>{{$PaidSvet}}</td>
            </tr>
            <tr>
                <td>членский взнос</td>
                <td>{{$DebtChvznos}}</td>
                <td>{{$PaidChvznos}}</td>
            </tr>
            <tr>
                <td>мусор</td>
                <td>{{$DebtTrash}}</td>
                <td>{{$PaidTrash}}</td>
            </tr>
            <tr>
                <td>дороги</td>
                <td>{{$DebtRoad}}</td>
                <td>{{$PaidRoad}}</td>
            </tr>
            <tr>
                <td>благоустройство</td>
                <td>{{$DebtBlag}}</td>
                <td>{{$PaidBlag}}</td>
            </tr>
            <tr>
                <td>Итого</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-sm">Сохранить в файл</button>
    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-sm">Печатная форма</button>
    </div>
</div>








@endsection
