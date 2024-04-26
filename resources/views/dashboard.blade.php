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

    @if(session('success'))
        <div class="alert alert-success" style="hide(10)">
            {{ session('success') }}
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger" style="hide(10)">
            {{ session('danger') }}
        </div>
    @endif

    @if($id->area_status === 0)
        <div class="alert alert-warning">
            Отключен от рассчетов
        </div>
    @endif








    <!-- Modal tariffs -->
    @include('modals.modal-tariffs')
    @include('modals.modal-area-edit')
    @include('modals.modal-prepay')
    @include('modals.modal-payments-svet')
    @include('modals.modal-payments-chvznos')
    @include('modals.modal-payments-road')
    @include('modals.modal-payments-trash')
    @include('modals.modal-payments-video')
    @include('modals.modal-counter')
    @include('modals.modal-allpayments')
    @include('modals.modal-money-come')
    @include('modals.modal-addsvet')











    <div class="container">

<!-- участок -->
        <div class="row mb-4 mt-4">
            <div class="col-lg-3 col-sm-6 md-3">
                <table class="table table-bordered ">
                    <tr>
                        <td colspan="2" class="bg-light"><h6>Участок</h6>
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                    data-bs-target="#AreaEditModal">
                                Редактировать
                            </button>
                            <button type="button" class="btn btn-outline-primary  btn-sm mb-2" data-bs-toggle="modal"
                                    data-bs-target="#PrepayModal">
                                Аванс: <strong>{{$prepayActual}}р</strong>
                            </button>
{{--                            <form action="{{route('areas.new', $id->id)}}">--}}
{{--                                <input type="hidden" name="number" value="{{$id->number}}">--}}
{{--                                <input type="hidden" name="square" value="{{$id->square}}">--}}
{{--                                <input type="hidden" id="area-debt" name="debt" value="">--}}
{{--                                <button class="btn bnt-sm" type="submit">Создать нового владельца</button>--}}
{{--                            </form>--}}
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер</td>
                        <td>{{$id->number}}</td>
                    </tr>
                    <tr>
                        <td>Владелец</td>
                        <td>{{$id->name}}</td>
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


            <!-- все долги -->
            <div class=" col-lg-3 col-sm-6 " >

                <x-tablealldebts :id="$id"/>
                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#AllPaymentsModal">
                    Квитанция
                </button>
            </div>


            <!-- оплата -->
            <div class="col-lg-5  col-sm-12 " id="PaySection">
                <div class="card card-primary border border-secondary border-1">
                    <div class="card-header cart-header-custom">
                        <h7 class="card-title">Оплатить</h7>
                    </div>

                    <form class="myForm" action="{{route('incoming')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Сумма прихода</label>
                                            <input type="text" class="form-control" id="sum_incoming"
                                                   name="sum_incoming" placeholder="сумма прихода">
{{--                                            <button type="button" id="auto" class="btn btn-primary btn-sm" >Авто</button>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Осталось</label>
                                            <input type="text" class="form-control" id="sum_left" value=""
                                                   name="sum_left" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Оплачено</label>
                                            <input type="text" class="form-control" id="sum_paid" name="sum_paid"
                                                   value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    {{--                <div class="mb-3">--}}
                                    {{--                    <input type="text" class="form-control" name="number" placeholder="номер платёжки банка">--}}
                                    {{--                </div>--}}
                                    <div class="mb-3">
                                        <label for="">Э/энергия</label>
                                        <input type="text" class="form-control" id="svet" name="svet" value="0"
                                               placeholder="энергия">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Чвзнос</label>
                                        <input type="text" class="form-control" id="chvznos" name="chvznos" value="0"
                                               placeholder="чвзнос">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">благоустройство</label>
                                        <input type="text" class="form-control" id="camera" name="blag" value="0"
                                               placeholder="благоустройство">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="">Мусор</label>
                                        <input type="text" class="form-control" id="trash" name="trash" value="0"
                                               placeholder="мусор">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Дороги</label>
                                        <input type="text" class="form-control" id="road" name="road" value="0"
                                               placeholder="дороги">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-danger"><strong>Дата оплаты в банке</strong></label>
                                        <input type="date" class="form-control" name="date"
                                               value="">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="form_alldebt" name="alldebt" value="">
                                    </div>


                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="svetdebtform" name="svetdebt" value="">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="chvznosdebtform" name="chvznosdebt" value="">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="roaddebtform" name="roaddebt" value="">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="trashdebtform" name="trashdebt" value="">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="blagdebtform" name="blagdebt" value="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row ">

            <!-- счетчик -->
            <div class="col-lg-3  col-sm-6 mb-4">
                <div class="card card-primary border border-secondary border-1">
                    <div class="card-header cart-header-custom ">
                        <div class="row">
                            <div class="col-6"> <p>счетчик</p></div>
                            <div >
                                <button type="button" class="btn btn-outline-primary  btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#AddSvetModal">
                                   Добавить старый долг на энерг.
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (empty($lastValue))
                            <p class="text-danger mb-2">нет показаний</p>
                            <form class="myForm" action="{{ route('store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="value"
                                           placeholder="первое показание">
                                </div>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date"
                                           value="">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                            </form>
                        @else
                            <p>Последнее показание: <strong>{{$lastValue}}</strong></p>
                            <p>дата посл.показ: {{ \Carbon\Carbon::parse($lastValuedate)->format('d-m-Y') }}</p>
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#CounterModal">
                                История показаний
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#TariffsModal">
                                Тарифы на э/энергию
                            </button>
                            <form class="myForm" action="{{ route('store3') }}" method="POST">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <input type="number" class="form-control" name="value" placeholder="введите показание">
                                </div>
                                <div class="mb-3">
                                    <select name="select" class="form-select" aria-label="Default select example">
                                        <option selected>Выберите тариф</option>
                                        @foreach($tariffs as $tariff)
                                            <option value="{{ $tariff->value }}">{{number_format( $tariff->value,2,'.','')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Рассчитать</button>

                            </form>
                        @endif
                    </div>
                </div>
            </div>


            <!-- начисление взноса -->
            <div class="col-lg-3 col-sm-6 mb-2" id="AddVznos">
                <div class="card card-primary border border-secondary border-1">
                    <div class="card-header cart-header-custom">
                        <h7 class="card-title">Начислить взнос</h7>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="selectType"
                                    id="selectType">
                                <option selected>Выберите взнос</option>
                                <option value="2">Членский взнос</option>
                                <option value="3">Мусор</option>
                                <option value="4">Дороги</option>
                                <option value="5">Благоустройство</option>
                            </select>
                        </div>
                        <div id="div2" style="display: none;">
                            <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Площадь</label>
                                    <input type="text" class="form-control" name="amount" id="amount"
                                           value="{{$id->square}}">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="tariff" id="tariff"
                                           placeholder="цена за сотку">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="type" value="чвзнос"
                                           placeholder="сумма">
                                </div>
                                <label>Дата</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="{{ now() }}">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3">Начислить
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="div3" style="display: none;">
                            <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                                @csrf


                                <div class="col-auto">
                                    <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                                </div>
                                <div class="col-auto">
                                    <input type="hidden" class="form-control" name="type" value="мусор"
                                           placeholder="сумма">
                                </div>
                                <div class="mb-3">
                                    <label>Дата</label>
                                    <input type="date" class="form-control" name="date" value="{{ now() }}">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3">Начислить
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="div4" style="display: none;">
                            <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                                @csrf


                                <div class="col-auto">
                                    <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                                </div>
                                <div class="col-auto">
                                    <input type="hidden" class="form-control" name="type" value="дороги"
                                           placeholder="сумма">
                                </div>
                                <div class="mb-3">
                                    <label>Дата</label>
                                    <input type="date" class="form-control" name="date" value="{{ now() }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3">Начислить
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="div5" style="display: none;">
                            <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                                @csrf


                                <div class="col-auto">
                                    <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                                </div>
                                <div class="col-auto">
                                    <input type="hidden" class="form-control" name="type" value="благоустройство"
                                           placeholder="сумма">
                                </div>
                                <div class="mb-3">
                                    <label>Дата</label>
                                    <input type="date" class="form-control" name="date" value="{{ now() }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3">Начислить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-sm-6 ">
                <div class="card card-primary border border-secondary border-1">
                    <div class="card-header cart-header-custom">
                        <h7 class="card-title">Комментарий</h7>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" action="{{route('areas.comment')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$id->id}}" name="id">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="text"
                                      rows="3">{{$comment}}</textarea>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm mb-2">Сохранить комментарий</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- поступление денег -->
        <div class="row" >
            <div class="col-12  mt-3" id="MoneyComing">
                <div class="card card-primary border border-secondary border-1">
                    <div class="card-header" style="background-color: gainsboro">
                        <p>Поступление денег</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th>дата оплаты</th>
                                <th>сумма прихода</th>
                                <th>в аванс</th>
                                <th>всего оплачено</th>
                                <th>э/энергия</th>
                                <th>чвзнос</th>
                                <th>мусор</th>
                                <th>дороги</th>
                                <th>благоуст.</th>
                                <th>дата занесения</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incoming as $count)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($count->date)->format('d-m-Y') }}</td>

                                    <td>{{ number_format($count->sum_incoming, 2, '.', '') }}</td>
                                    <td> {{number_format($count->sum_left,2,'.','')}}</td>
                                    <td> {{number_format($count->sum_paid,2,'.','')}}</td>
                                    <td> {{number_format($count->svet,2,'.','')}}</td>
                                    <td> {{number_format($count->chvznos,2,'.','')}}</td>
                                    <td> {{number_format($count->trash,2,'.','')}}</td>
                                    <td> {{number_format($count->road,2,'.','')}}</td>
                                    <td> {{number_format($count->camera,2,'.','')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <form action="{{ route('incoming.delete', $count->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" name="id"
                                                       value="{{$count->id}}">
                                            </div>

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">
                                                Отменить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-4 button-money-come">
                <div class="col-lg-3 col-sm-5">
                    <button type="button" class="btn btn-primary   mb-2" data-bs-toggle="modal"
                            data-bs-target="#MoneyComeModal">
                        приход денег
                    </button>
                </div>
            </div>


            <form action="{{route('area.delete', $id->id)}}" method="post" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">удалить участок</button>
            </form>

        </div>


{{--        <div class="row mt-5 mb-5"><h4>Начисления:</h4></div>--}}


{{--        <x-payment-table :type="'чвзнос'" :id="$id"/>--}}


{{--        <x-payment-table :type="'мусор'" :id="$id"/>--}}


{{--        <x-payment-table :type="'дороги'" :id="$id"/>--}}


{{--        <x-payment-table :type="'благоустройство'" :id="$id"/>--}}





        <!-- коммент -->



        {{--    <x-tablepay :id="$id"/>--}}
    </div>





    <script>
        $(document).ready(function () {
            $('#selectType').change(function () {
                var selectedValue = $(this).val();
                $('div[id^="div"]').hide(); // скрываем все div
                $('#div' + selectedValue).show(); // показываем нужный div
            });
            $('#sum_incoming, #svet, #chvznos, #trash, #road, #camera').on('input', function () {
                var svet = new Decimal($('#svet').val().trim() || '0');
                var chvznos = new Decimal($('#chvznos').val().trim() || '0');
                var trash = new Decimal($('#trash').val().trim() || '0');
                var road = new Decimal($('#road').val().trim() || '0');
                var camera = new Decimal($('#camera').val().trim() || '0');
                var sumincoming = new Decimal($('#sum_incoming').val().trim() || '0');
                // Perform precise decimal arithmetic
                var sumLeft = sumincoming.minus(svet).minus(chvznos).minus(trash).minus(road).minus(camera);
                var sumPaid = svet.plus(chvznos).plus(trash).plus(road).plus(camera);

                if (sumPaid.greaterThan(sumincoming)) {
                    $(this).val('');  // Reset the value of the current input field
                    alert('превышенна сумма!');
                    location.reload(true)
                }

                // Set the values for elements with IDs 'sum_left' and 'sum_paid'
                $('#sum_left').val(sumLeft.toString());
                $('#sum_paid').val(sumPaid.toString());


            });
            var alldebt = $('#alldebt').text();

            var svetdebt = $('#svetdebt').text();
            var trashdebt = $('#trashdebt').text();
            var roaddebt = $('#roaddebt').text();
            var chvznosdebt = $('#chvznosdebt').text();
            var cameradebt = $('#cameradebt').text();


            $('#svetdebtform').val(svetdebt);
            $('#chvznosdebtform').val(chvznosdebt);
            $('#roaddebtform').val(roaddebt);
            $('#trashdebtform').val(trashdebt);
            $('#blagdebtform').val(cameradebt);




            if (svetdebt == 0) {
                $('#svet').css('background-color', 'gray');
            }
            if (trashdebt == 0) {
                $('#trash').css('background-color', 'gray');
            }
            if (roaddebt == 0) {
                $('#road').css('background-color', 'gray');
            }
            if (chvznosdebt == 0) {
                $('#chvznos').css('background-color', 'gray');
            }
            if (cameradebt == 0) {
                $('#camera').css('background-color', 'gray');
            }


            $('#form_alldebt').attr('value', alldebt);
            $('#area-debt').attr('value', alldebt);


            setTimeout(function ()
            {
                $('.alert-success').remove();
            },3000)

            setTimeout(function ()
            {
                $('.alert-danger').remove();
            },3000)






            $('#auto').click(function (){


                var sumincoming = new Decimal($('#sum_incoming').val());
                var sumPaid = new Decimal($('#sum_paid').val()); // Получаем текущее значение из #sum_paid

                // Массив долгов
                var debts = {
                    '#svet': new Decimal($('#svetdebt').text()),
                    '#trash': new Decimal($('#trashdebt').text()),
                    '#road': new Decimal($('#roaddebt').text()),
                    '#chvznos': new Decimal($('#chvznosdebt').text()),
                    '#camera': new Decimal($('#cameradebt').text())
                };

                // Обновление значений
                Object.keys(debts).forEach(function (selector) {
                    var debt = debts[selector];
                    var payment = Decimal.min(sumincoming, debt);
                    $(selector).val(payment.toString());
                    sumincoming = sumincoming.minus(payment);
                });

                // Обновление оставшейся суммы
                $('#sum_left').val(sumincoming.toString());

                // Обновление суммы оплаченных
                sumPaid = sumPaid.plus(new Decimal($('#svet').val()));
                sumPaid = sumPaid.plus(new Decimal($('#trash').val()));
                sumPaid = sumPaid.plus(new Decimal($('#road').val()));
                sumPaid = sumPaid.plus(new Decimal($('#chvznos').val()));
                sumPaid = sumPaid.plus(new Decimal($('#camera').val()));

                $('#sum_paid').val(sumPaid.toString());

                console.log(sumincoming.toString());





            })



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
