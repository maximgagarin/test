
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

    <div class="row mb-3 mt-4 text-center "> <h3>Тарифы на энергия</h3></div>

    <div class="row   justify-content-center">
        <div class="col-lg-2 col-sm-12">
            <form  action="{{route('tariff.store')}}" method="POST">
                @csrf
                <div class="mb-3">

                    <input type="text" class="form-control" name="value" placeholder="введите значение">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
            </form>
        </div>
        <div class="col-lg-3 col-sm-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">тариф</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr>
                        <td> {{number_format($count->value,2,'.','')}}</td>
                        <td> <button class="btn btn-danger btn-sm">Удалить</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
