
@extends('layout')
@section('content')
<div class="container">
    <div class="row p-3">
        <h4 class="text-center p-3">Задолженности по участкам</h4>
        <div class="col-1">
            <a href="{{route('debts')}}"><button class="btn btn-outline-primary btn-sm">все долги</button></a>
        </div>
        <div class="col-1">
          <x-formdebts :button="$button = 'свет'" >
              свет
          </x-formdebts>
        </div>
        <div class="col-1">
            <x-formdebts :button="$button = 'чвзнос'"  >
                чвзнос
            </x-formdebts>
        </div>
        <div class="col-1">
            <x-formdebts :button="$button = 'мусор'" >
                мусор
            </x-formdebts>
        </div>
        <div class="col-1">
            <x-formdebts :button="$button = 'дороги'" >
                дороги
            </x-formdebts>
        </div>
        <div class="col-1">
            <x-formdebts :button="$button = 'камеры'" >
                видеокамеры
            </x-formdebts>
        </div>



    </div>
    <div class="row">

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>Участок</th>
                <th></th>
                <th></th>
                <th class="text-danger">долг</th>
                <th>карточка</th>

            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td> {{$result->number}}</td>
                    <td> {{$result->total_payments_sum}}</td>
                    <td> {{$result->total_payment_movs_sum}}</td>
                    <td> {{  $result->total_payments_sum - $result->total_payment_movs_sum}}р.</td>
                    <td><a href="{{ route('dashboard', $result->id) }}">Перейти</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
