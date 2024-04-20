
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

<h4 class="mt-3 mb-3 text-center">Все оплаты общий отчет </h4>

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

    @if(isset($date1))
        <h6 class="mt-4">период с  {{ \Carbon\Carbon::parse($date1)->format('d-m-Y') }} по  {{ \Carbon\Carbon::parse($date2)->format('d-m-Y') }}</h6>
    @endif

    <div class="col-lg-8 col-sm-6">
        <table class="table table-bordered border-dark">
            <tr>
                <th>Вид</th>
                <th>Начислено</th>
                <th>Оплачено</th>
            </tr>
            <tr>
                <td>электроэнергия</td>
                <td>{{number_format($DebtSvet,2,'.','')}}</td>
                <td>{{number_format($PaidSvet,2,'.','')}}</td>
            </tr>
            <tr>
                <td>членский взнос</td>
                <td>{{number_format($DebtChvznos,2,'.','')}}</td>
                <td>{{number_format($PaidChvznos,2,'.','')}}</td>
            </tr>
            <tr>
                <td>мусор</td>
                <td>{{number_format($DebtTrash,2,'.','')}}</td>
                <td>{{number_format($PaidTrash,2,'.','')}}</td>
            </tr>
            <tr>
                <td>дороги</td>
                <td>{{number_format($DebtRoad,2,'.','')}}</td>
                <td>{{number_format($PaidRoad,2,'.','')}}</td>
            </tr>
            <tr>
                <td>благоустройство</td>
                <td>{{number_format($DebtBlag,2,'.','')}}</td>
                <td>{{number_format($PaidBlag,2,'.','')}}</td>
            </tr>
            <tr>
                <td><strong>Итого</strong></td>
                <td><strong>{{number_format($SummDebt, 2, ',', ' ')}}</strong></td>
                <td><strong>{{number_format($SummPaid, 2, ',', ' ')}}</strong></td>
            </tr>
        </table>
    </div>

{{--    <div class="mb-3">--}}
{{--        <button type="button" class="btn btn-primary btn-sm">Сохранить в файл</button>--}}
{{--    </div>--}}
    <div class="col-lg-4 period">
        <form action="{{ route('report.print') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="DebtSvet" value="{{$DebtSvet}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="PaidSvet" value="{{$PaidSvet}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="DebtChvznos" value="{{$DebtChvznos}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="PaidChvznos" value="{{$PaidChvznos}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="DebtTrash" value="{{$DebtTrash}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="PaidTrash" value="{{$PaidTrash}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="DebtRoad" value="{{$DebtRoad}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="PaidRoad" value="{{$PaidRoad}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="DebtBlag" value="{{$DebtBlag}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="PaidBlag" value="{{$PaidBlag}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="SummDebt" value="{{$SummDebt}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="SummPaid" value="{{$SummPaid}}">
            </div>

            @if(isset($date1))
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="date1" value="{{$date1}}">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="date2" value="{{$date2}}">
                </div>
            @endif


            @if(isset($date1))
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-sm">Печатная форма</button>
                </div>
            @endif

        </form>
    </div>
</div>








@endsection
