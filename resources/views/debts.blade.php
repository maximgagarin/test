
@extends('layout')
@section('content')
<div class="container">
    <div class="row p-2">
        <div class="col-2">
          <x-formdebts :button="$button = 'свет'">
              свет
          </x-formdebts>
        </div>
        <div class="col-2">
            <x-formdebts :button="$button = 'чвзнос'">
                чвзнос
            </x-formdebts>
        </div>
        <div class="col-2">
            <x-formdebts :button="$button = 'мусор'">
                мусор
            </x-formdebts>
        </div>
        <div class="col-2">
            <x-formdebts :button="$button = 'дороги'">
                дороги
            </x-formdebts>
        </div>
        <div class="col-2">
            <x-formdebts :button="$button = 'камеры'">
                видеокамеры
            </x-formdebts>
        </div>



    </div>
    <div class="row">
        <table class="table ">

            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">долг</th>
                <th scope="col">карточка</th>

            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td> {{$result->number}}</td>
                    <td> {{$result->total_payments_sum}}</td>
                    <td> {{$result->total_payment_movs_sum}}</td>
                    <td> {{  $result->total_payments_sum - $result->total_payment_movs_sum}}</td>
                    <td><a href="{{ route('dashboard', $result->id) }}">Перейти</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
