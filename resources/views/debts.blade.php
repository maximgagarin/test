
@extends('layout')
@section('content')
<div class="container">
    <h4 class="text-center p-3">Задолженности по участкам</h4>
    <div class="row p-3 ">

        <table class="table">
            <tr>
                <td>
                    <form action="{{route('debts')}}" class="d-flex mt-3 mr-2">
                        <input class="form-control input-hidden"  type="search"  placeholder="энергия" style="">
                        <button class="btn btn-success btn-sm " type="submit" >все</button>
                    </form>
                </td>
                <td>
        <div class="">
            <form action="{{route('debts2')}}" class="d-flex mt-3 mr-2">
                <input class="form-control input-hidden"  type="search" name="type" value="энергия" placeholder="энергия" style="">
                <button class="btn btn-success btn-sm " type="submit" >энергия</button>
            </form>
        </div>
                </td>
                <td>
        <div class="">
            <form action="{{route('debts2')}}" class="d-flex mt-3 mr-2">
                <input class="form-control input-hidden " type="search" name="type" value="чвзнос" placeholder="энергия">
                <button class="btn btn-success btn-sm" type="submit">чвзнос</button>
            </form>
        </div>
                </td>
                <td>
        <div class="">
            <form action="{{route('debts2')}}" class="d-flex mt-3">
                <input class="form-control input-hidden " type="search" name="type" value="мусор" placeholder="энергия">
                <button class="btn btn-success btn-sm" type="submit">мусор</button>
            </form>
        </div>
                </td>
                <td>
        <div class="">
            <form action="{{route('debts2')}}" class="d-flex mt-3">
                <input class="form-control input-hidden " type="search" name="type" value="дороги" placeholder="энергия">
                <button class="btn btn-success btn-sm" type="submit">дороги</button>
            </form>
        </div>
                </td>
                <td>
        <div class="">
            <form action="{{route('debts2')}}" class="d-flex mt-3">
                <input class="form-control input-hidden " type="search" name="type" value="благоустройство" placeholder="энергия">
                <button class="btn btn-success btn-sm" type="submit">благоуст.</button>
            </form>
        </div>
                </td>
            </tr>
        </table>
    </div>


    <div class="row">

        <h5 class="mb-5">Всего долг  {{$type}}: {{$formattedTotal}}р.</h5>
        <div class="row mt-3 ">
            <div class="col-6">{{ $paginator->withQueryString()->links() }}</div>
        </div>


        <table class=" table table-bordered">
            <thead>
            <tr>
                <th>Участок</th>

                <th class="">начислено</th>
                <th class="">оплачено</th>
                <th class="text-danger">долг</th>
            </tr>
            </thead>
            <tbody>
            @foreach($paginator as $result)
                <tr class="tr-link" onclick="window.location='{{ route('dashboard', $result->id) }}';">
                    <td> {{$result->number}}</td>

                    <td>{{number_format( $result->total_payments_sum,2,'.','')}}р.</td>
                    <td> {{number_format($result->total_payment_movs_sum,2,'.','')}}р.</td>
                    <td> {{  $result->total_payments_sum - $result->total_payment_movs_sum}}р.</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-3 ">
        <div class="col-6">{{ $paginator->withQueryString()->links() }}</div>
    </div>
</div>

    <style>

        .input-hidden{
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            border: 0 !important;
        }



    </style>

@endsection
