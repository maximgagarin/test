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
        <div class="col-4">
            <h5>Добавить начисление</h5>
            <form class="myForm" action="" method="POST">
                @csrf
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
                        <form class="myForm" action="{{ route('store2') }}" method="POST">
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
                </div>
                <div id="div4" style="display: none;">
                    Контент для Дорог
                </div>
                <div id="div5" style="display: none;">
                    Контент для Видеонаблюдения
                </div>
            </form>

        </div>
        <div class="col-4">
            <h5>Добавить оплату</h5>
            <form class="myForm"  action="" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="number" class="form-control" name="value_prihod" placeholder="сумма прихода">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="number_bank_blank" placeholder="номер платёжки банка">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="svet" placeholder="свет">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="chvzos" placeholder="чвзнос">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="trash" placeholder="мусор">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="road" placeholder="дороги">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="camera" placeholder="видеонаблюдение">
                </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" name="date" value="{{ now() }}" >
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
            </form>
        </div>

    </div>











    <x-payment-table :type="'свет'" :id="$id"/>
    <x-payment-table :type="'чвзнос'" :id="$id"/>

    <x-tablepay :id="$id"/>






<script>
    $(document).ready(function () {

        $('#selectType').change(function(){
            var selectedValue = $(this).val();
            $('div[id^="div"]').hide(); // скрываем все div
            $('#div' + selectedValue).show(); // показываем нужный div
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
