
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

<h4 class="mt-3 mb-3 text-center">Отчет</h4>

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
                    <button type="submit" class="btn btn-primary btn-sm">Показать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6">
    <table class="table table-bordered mt-4">
        <tr>
            <td>
                <span>На {{ \Carbon\Carbon::parse(now())->format('d-m-Y') }}</span>
                <h5>Долг: {{$sumDebt}} р.</h5>
            </td>

        </tr>
        <tr>
            <td>
                @isset ($date1)
                <span>c {{ \Carbon\Carbon::parse($date1)->format('d-m-Y') }} по {{ \Carbon\Carbon::parse($date2)->format('d-m-Y') }} пришло денег:</span>
                <h5>{{$sumPaid}} р.</h5>
                @else
                <div> Приход: </div>
                @endif
            </td>
        </tr>
    </table>
</div>
</div>







@endsection
