@extends('layout')
@section('content')
    <?php $sum1=0 ?>
    <?php $sum2=0 ?>
    <?php $sum3=0 ?>
    <?php $sum4=0 ?>
    <?php $sum5=0 ?>
    <?php $sum6=0 ?>
    <?php $sum7=0 ?>
    <?php $sum8=0 ?>

    <div class="container">
        <h3 class="m-4 text-center">Приход денег и все оплаты</h3>
        <div class="row mt-5 mb-5 ">
{{--            <div class="col-lg-3 col-sm-6">--}}
{{--                <h6>Выбрать дату</h6>--}}
{{--                <form action="{{route('incoming')}}">--}}
{{--                <div class=" mb-3">--}}
{{--                    <input type="date" class="form-control" name="date" value="{{ now() }}" >--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <button type="submit" class="btn btn-primary ">показать--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                </form>--}}
{{--            </div>--}}
            <div class="col-lg-3 col-sm-6">
                <h6>Выбрать период</h6>
                <form action="{{route('incoming')}}">
                    <div class=" mb-3">
                        <input type="date" class="form-control" name="date1" value="" >
                    </div>
                    <div class=" mb-3">
                        <input type="date" class="form-control" name="date2" value="" >
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm ">показать
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div>
        <table class="table mt-3 table-bordered ">
            <thead>
            <tr>
                <th>дата занесения в программу</th>
                <th>дата оплаты в банке</th>
                <th>всего приход</th>
                <th>перешло в аванс</th>
                <th>всего оплачено</th>
                <th>свет</th>
                <th>чвзнос</th>
                <th>мусор</th>
                <th>дороги</th>
                <th>в наблюдение</th>
                <th>учасоток</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $count)
                <tr class="tr-link" onclick="window.location='{{ route('dashboard', $count->areas_id) }}';">
                    <td>{{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($count->date)->format('d-m-Y') }}</td>
                    <td> {{$count->sum_incoming}}</td>  <?php $sum1 += $count->sum_incoming; ?>
                    <td> {{$count->sum_left}}</td>       <?php $sum2 += $count->sum_left; ?>
                    <td> {{$count->sum_paid}}</td>      <?php $sum3 += $count->sum_paid; ?>
                    <td> {{$count->svet}}</td>         <?php $sum4 += $count->svet; ?>
                    <td> {{$count->chvznos}}</td>      <?php $sum5 += $count->chvznos; ?>
                    <td> {{$count->trash}}</td>         <?php $sum6 += $count->trash; ?>
                    <td> {{$count->road}}</td>         <?php $sum7 += $count->road; ?>
                    <td> {{$count->camera}}</td>       <?php $sum8 += $count->camera; ?>
                    <td> {{$count->number}}</td>
                </tr>
            @endforeach
            <tr class="text-danger ">
                <td>Итог</td>
                <td></td>
                <td>{{$sum1}}р.</td>
                <td>{{$sum2}}р.</td>
                <td>{{$sum3}}р.</td>
                <td>{{$sum4}}р.</td>
                <td>{{$sum5}}р.</td>
                <td>{{$sum6}}р.</td>
                <td>{{$sum7}}р.</td>
                <td>{{$sum8}}р.</td>
                <td></td>

            </tr>
            </tbody>
        </table>
        </div>
    </div>


@endsection

