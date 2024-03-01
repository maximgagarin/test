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

    <div class="row mb-4">
        <div class="col-3 md-3">
            <table class="table table-bordered ">
                <tr>
                    <td colspan="2"><h6>Участок</h6>
                        <a href="{{route('areas.update', $id->id)}}">Редактировать участок</a>
                    </td>
                </tr>
                <tr>
                    <td>Номер</td>
                    <td>{{$id->number}}</td>
                </tr>
                <tr>
                    <td>Адрес</td>
                      <td>{{$id->address}}</td>
                </tr>
                <tr>
                    <td>Телефон</td>
                      <td>{{$id->telephone}}</td>
                </tr>
                <tr>
                    <td>Площадь</td>
                      <td>{{$id->square}}</td>
                </tr>
            </table>
        </div>
        <div class="col-2">
          <x-tablealldebts :id="$id"/>
        </div>
        <div class="col-3">
            <h7>Комментарий</h7>
            <form class="row g-3" action="{{route('areas.comment')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$id->id}}" name="id">
                <textarea class="form-control" id="exampleFormControlTextarea1" name="text"  rows="3">{{$comment}}</textarea>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-primary btn-sm mb-2">Сохранить</button>
                </div>
            </form>
        </div>
        <div class="col-2">
            <x-prepay :d="$D" :id="$id">
                свет
            </x-prepay>
        </div>

    </div>


    <div class="row">
        <div class="col-3">
            <h5>Добавить начисление</h5>

                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="selectType" id="selectType">
                        <option selected>Выберите тип начисления</option>
                        <option value="1">Свет</option>
                        <option value="2">Чвзнос</option>
                        <option value="3">Мусор</option>
                        <option value="4">Дороги</option>
                        <option value="5">Видеонаблюдение</option>
                    </select>
                </div>

                <div id="div1" style="display: none;">
                    <h6>Счетчик</h6>
                    <div><a href="{{ route('counter2', $id->id) }}">История показаний</a></div>
                    @if (empty($lastValue))
                        нет показаний
                        <form class="myForm" action="{{ route('store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="number" class="form-control" name="value" placeholder="показание">
                            </div>
                            <div class="mb-3">
                                <input type="date" class="form-control" name="date" value="{{ now()->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
                        </form>
                    @else
                        <h6>Последнее показание: {{$lastValue}}</h6>
                        <h6> {{$lastValuedate}}</h6>
                        <form class="myForm"  action="{{ route('store3') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="number" class="form-control" name="value" placeholder="показание">
                            </div>
                            <div class="mb-3">
                                <select name="select" class="form-select" aria-label="Default select example">
                                    <option selected>Выберите тариф</option>
                                    @foreach($tariffs as $tariff)
                                        <option value="{{ $tariff->value }}">{{ $tariff->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="date" class="form-control" name="date" value="{{ now() }}" >
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
                        </form>

                    @endif

                </div>
                <div id="div2" style="display: none;">
                    <div class="col-3">
                        <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label >Площадь</label>
                                <input type="text" class="form-control" name="amount" id="amount" value="{{$id->square}}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="tariff" id="tariff" placeholder="цена за сотку">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="чвзнос"
                                       placeholder="сумма">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="div3" style="display: none;">
                    Контент для Мусора
                    <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label >Площадь</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{$id->square}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tariff" id="tariff" placeholder="цена за сотку">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                        </div>
                        <div class="col-auto">
                            <input type="hidden" class="form-control" name="type" value="мусор"
                                   placeholder="сумма">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                            </button>
                        </div>
                    </form>
                </div>
                <div id="div4" style="display: none;">
                    Контент для Дорог
                    <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label >Площадь</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{$id->square}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tariff" id="tariff" placeholder="цена за сотку">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                        </div>
                        <div class="col-auto">
                            <input type="hidden" class="form-control" name="type" value="дороги"
                                   placeholder="сумма">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                            </button>
                        </div>
                    </form>
                </div>
                <div id="div5" style="display: none;">
                    Контент для Видеонаблюдения
                    <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label >Площадь</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{$id->square}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tariff" id="tariff" placeholder="цена за сотку">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                        </div>
                        <div class="col-auto">
                            <input type="hidden" class="form-control" name="type" value="видеонаблюдение"
                                   placeholder="сумма">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                            </button>
                        </div>
                    </form>
                </div>


        </div>
        <div class="col-4">
            <h5>Добавить оплату</h5>
            <form class="myForm"  action="{{route('incoming')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="number" class="form-control" id="sum_incoming" name="sum_incoming" placeholder="сумма прихода">
                </div>
                <p>Осталось:</p>
                <p id="left"></p>
                <div class="mb-3">
                    <input type="number" class="form-control" id="sum_left" value="" name="sum_left" placeholder="осталось">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="number" placeholder="номер платёжки банка">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="svet" name="svet" placeholder="свет">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="chvznos" name="chvznos" placeholder="чвзнос">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="trash" name="trash" placeholder="мусор">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="road" name="road" placeholder="дороги">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="camera" name="camera" placeholder="видеонаблюдение">
                </div>
                <div class="mb-3">
                    <input type="date" class="form-control" name="date" value="{{ now() }}" >
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="sum_paid" name="sum_paid" value="">
                </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
            </form>
        </div>
        <div class="col-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">тариф</th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr>
                        <td> {{$count->value}}</td>
                        <td> <button class="btn btn-danger btn-sm">Удалить</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-payment-table :type="'свет'" :id="$id"/>
    <x-payment-table :type="'чвзнос'" :id="$id"/>
    <x-payment-table :type="'мусор'" :id="$id"/>
    <x-payment-table :type="'дороги'" :id="$id"/>
    <x-payment-table :type="'видеонаблюдение'" :id="$id"/>
    <x-tablepay :id="$id"/>

<script>
    $(document).ready(function () {

        $('#selectType').change(function(){

            var selectedValue = $(this).val();
            $('div[id^="div"]').hide(); // скрываем все div
            $('#div' + selectedValue).show(); // показываем нужный div
        });

        $('#svet, #chvznos, #trash, #road, #camera').on('keyup', function() {
            // Get values from input elements
            var svet = parseFloat($('#svet').val()) || 0;
            var chvznos = parseFloat($('#chvznos').val()) || 0;
            var trash = parseFloat($('#trash').val()) || 0;
            var road = parseFloat($('#road').val()) || 0;
            var camera = parseFloat($('#camera').val()) || 0;

            var sumincoming = parseFloat($('#sum_incoming').val()) || 0;

            // Calculate the remaining value and update the text of the element with ID 'left'
            $('#left').text(sumincoming - svet - chvznos - trash - road - camera);

            // Update the value attribute of the element with ID 'sum_left'
            $('#sum_left').attr('value', sumincoming - svet - chvznos - trash - road - camera);

            // Update the value attribute of the element with ID 'sum_paid'
            $('#sum_paid').attr('value', svet + chvznos + trash + road + camera);
        });





    });

    function showEditForm(paymentId) {

        // Show the clicked edit form
        $(`#editForm${paymentId}`).css('display', 'table-row');
        $(`#editForm2${paymentId}`).css('display', 'none');
    }

    function Reload() {
        location.reload(true); // true означает, что браузер выполнит полное обновление страницы, включая кэш
    }




</script>

@endsection
