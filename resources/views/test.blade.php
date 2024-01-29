
@extends('layout')
@section('content')



    <
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тариф</th>
                    <th>тариф</th>
                    <th>тариф</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($areas as $area)--}}
{{--                    <tr>--}}
{{--                        <td> {{$area->id}}</td>--}}
{{--                        <td> {{$area->number}}</td>--}}
{{--                        <td> {{$area->getTotalPaymentsSum}}</td>--}}
{{--                        <td> {{$area->getTotalPaymentMovsSum}}</td>--}}
{{--                        <td> <button class="btn btn-danger btn-sm">Удалить</button></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>


@endsection
