
@extends('layout')
@section('content')
<div class="container">
    <div class="row p-3">
        <h4 class="text-center p-3">Задолженности по участкам</h4>
        <div class="col-lg-1 col-sm-6 mb-2">
            <a href="{{route('debts')}}"><button class="btn btn-outline-primary btn-sm">все долги</button></a>
        </div>
        <div class="col-lg-1 col-sm-6">
          <x-formdebts :button="$button = 'свет'" >
              свет
          </x-formdebts>
        </div>
        <div class="col-lg-1 col-sm-6">
            <x-formdebts :button="$button = 'чвзнос'"  >
                чвзнос
            </x-formdebts>
        </div>
        <div class="col-lg-1 col-sm-6">
            <x-formdebts :button="$button = 'мусор'" >
                мусор
            </x-formdebts>
        </div>
        <div class="col-lg-1 col-sm-6">
            <x-formdebts :button="$button = 'дороги'" >
                дороги
            </x-formdebts>
        </div>
        <div class="col-lg-1 col-sm-6">
            <x-formdebts :button="$button = 'камеры'" >
                видеонаблюдение
            </x-formdebts>
        </div>


    </div>
    <div class="row">


        <h5>Всего долг  {{$type}}: {{$formattedTotal}}р.</h5>


        <table class="mt-4 table table-bordered">
            <thead>
            <tr>
                <th>Участок</th>


                <th class="text-danger">долг</th>
                <th ></th>

            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
{{--                    <td> {{$result->number}}</td>--}}
{{--                    <td> {{$result->total_payments_sum}}</td>--}}
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
