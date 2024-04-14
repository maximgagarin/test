
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

    <div class="row">
        <div class="col-lg-2 col-sm-6">
            <h6>Выбрать период начислено</h6>
            <form action="{{route('report.calc')}}">
                <div class=" mb-3">
                    <input type="date" class="form-control" name="date1" value="" >
                </div>
                <div class=" mb-3">
                    <input type="date" class="form-control" name="date2" value="" >
                </div>
                <h6>Выбрать период оплачено</h6>

                <div class=" mb-3">
                    <input type="date" class="form-control" name="date3" value="" >
                </div>
                <div class=" mb-3">
                    <input type="date" class="form-control" name="date4" value="" >
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-sm ">показать
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{$sum}}

@endsection
