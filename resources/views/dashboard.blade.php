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

<div class="row mb-5">
    <div class="col-3 md-3">

        <table class="table table-bordered ">
            <tr>
                <td colspan="4"><h6>Участок</h6>
                </td>
            </tr>
            <tr>
                <td>Номер</td>
                <td>Адрес</td>
                <td>Телефон</td>
                <td>Площадь</td>
            </tr>
            <tr>
                <td>{{$id->number}}</td>
                <td>{{$id->address}}</td>
                <td>{{$id->telephone}}</td>
                <td>{{$id->square}}</td>
            </tr>
        </table>
    </div>
    <div class="col-5">
        <table class="table table-bordered ">
            <tr>
                <td colspan="5"><h6>Задолженность</h6>
                </td>
            </tr>
            <tr>
                <td>Свет</td>
                <td>Ч взнос</td>
                <td>Дороги</td>
                <td>Камера</td>
                <td>Мусор</td>
            </tr>
            <tr>
                <td>{{$sumLeft}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="col-3">
        <h7>Комментарий</h7>
        <form class="row g-3" action="{{route('payments.store', $id->id)}}" method="POST">
            @csrf
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary btn-sm mb-2">Сохранить</button>
            </div>
        </form>
    </div>
</div>


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Свет
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Ч.взнос
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Дороги
        </button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row p-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-2 ">
                        <form class="row g-3" action="{{route('payments.store', $id->id)}}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="text" class="form-control" name="amount" placeholder="количество квт">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="tariff" placeholder="тариф">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="sum" placeholder="сумма">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="свет"
                                       placeholder="сумма">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <form class="row g-3" action="{{route('payments.pay',$id->id)}}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="text" class="form-control" name="value" placeholder="введите сумму">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="свет">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Оплатить свет</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">
                        <h5>Счетчик</h5>
                        <p>Последнее показание:  {{$lastValue}} </p>

                        <div><a href="{{ route('counter2', $id->id) }}">Добавить</a></div>
                    </div>
                    <div class="col-2">
                        <h5> Аванс: {{$DifferencePrihodRashod}}</h5>
                        <form action="{{ route('prepay', $id->id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$DifferencePrihodRashod}}" name="value">
                            <input type="hidden" value="свет" name="type">
                            <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на свет</button>
                        </form>
                    </div>
                </div>
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>вид</th>
                            <th>ед.изм</th>
                            <th>количество</th>
                            <th>начислено</th>
                            <th>оплачено</th>
                            <th>долг</th>
                            <th>статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-danger">ОБЩЕЕ СВЕТ</th>
                            <th></th>
                            <th></th>
                            <th class="text-danger">{{$sumAllSvet}} </th>
                            <th class="text-danger">{{$sumPaidSvet}} </th>
                            <th class="text-danger">{{$sumLeft}} </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>номер</th>
                            <th>тип</th>
                            <th>колич</th>
                            <th>тариф</th>
                            <th>сумма</th>
                            <th>дата</th>
                            <th>статус</th>
                            <th>Оплачено</th>
                            <th>Осталось</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td> {{$payment->id}}</td>
                                <td> {{$payment->type}}</td>
                                <td> {{$payment->amount}}</td>
                                <td> {{$payment->tariff}}</td>
                                <td> {{$payment->sum}}</td>
                                <td> {{$payment->date}}</td>
                                <td> {{$payment->status}}</td>
                                <td> {{$payment->sumpaid}}</td>
                                <td>{{$payment->sum - $payment->sumpaid}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="showEditForm({{$payment->id}})">
                                        Редактировать
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm">удалить</button>
                                </td>
                            </tr>
                            <tr id="editForm{{$payment->id}}" style="display: none; background-color: #f8f9fa;">
                                <form class=action="">
                                    @csrf
                                    @method('PATCH')
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control" name="init" placeholder="квт">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="amount" placeholder="тариф">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="tariff" placeholder="сумма">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                        <button type="submit" class="btn btn-primary  btn-sm">Закрыть</button>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <th>
                                    </th>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                <table class="table">
                    <thead>
                    <tr>
                        <th>платёж</th>
                        <th>сумма</th>
                        <th>дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments2 as $payment)
                        <tr>
                            <td> {{$payment->payments_id}}</td>
                            <td> {{$payment->sum}}</td>
                            <td> {{$payment->date}}</td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        <script>
            function showEditForm(paymentId) {

                // Show the clicked edit form
                document.getElementById(`editForm${paymentId}`).style.display = 'table-row';
            }
        </script>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row p-3">
            <form class="row g-3" action="{{route('payments.store', $id->id)}}" method="POST">
                @csrf
                <div class="col-auto">
                    <input type="text" class="form-control" name="amount" value="{{$id->square}}">
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="tariff" placeholder="тариф">
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="sum" placeholder="сумма">
                </div>
                <div class="col-auto">
                    <input type="hidden" class="form-control" name="type" value="чвзнос" placeholder="сумма">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Добавить платёж</button>
                </div>
            </form>
            <form class="row g-3" action="{{route('payments.pay',$id->id)}}" method="POST">
                @csrf
                <div class="col-auto">
                    <input type="text" class="form-control" name="value" placeholder="введите сумму">
                </div>
                <div class="col-auto">
                    <input type="hidden" class="form-control" name="type" value="чвзнос">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Оплатить чвзнос</button>
                </div>
            </form>
            <x-payment-table :type="'чвзнос'" :id="$id"/>
        </div>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    </div>


</div>

@endsection
