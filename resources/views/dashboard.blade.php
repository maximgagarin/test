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
    </div>

    <div class="col-2">
        <x-prepay :d="$D" :id="$id">
            свет
        </x-prepay>
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
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="trash-tab" data-bs-toggle="tab" data-bs-target="#trash" type="button"
                    role="tab" aria-controls="trash" aria-selected="false">Мусор
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="camera-tab" data-bs-toggle="tab" data-bs-target="#camera" type="button"
                    role="tab" aria-controls="camera" aria-selected="false">Камеры
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row p-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2 ">
                            <form class="myForm" id="form1" action="{{route('payments.store', $id->id)}}" method="POST">
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
                                    <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <x-formpaypayment :id="$id" :type="$type='свет'" :button="$button='оплатить свет'"/>
                        </div>
                        <div class="col-2">
                            <x-counter :id="$id" :lastValue="$lastValue"  :lastValuedate="$lastValuedate" :tariffs="$tariffs"/>
                        </div>
                    </div>
                        <div>
                            <x-tablesumpayment :type="'свет'" :id="$id"/>
                        </div>
                        <x-payment-table :type="'свет'" :id="$id"/>
                        <x-tablepay :id="$id"/>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row p-3">
                <div class="row">
                    <div class="col-2">
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
                    <div class="col-2 p-4">
                        <x-formpaypayment :id="$id" :type="$type='чвзнос'" :button="$button='оплатить чвзнос'"/>
                    </div>
                </div>
                <div class="row">
                    <x-tablesumpayment :type="'чвзнос'" :id="$id"/>
                </div>
                <div class="row">
                    <x-payment-table :type="'чвзнос'" :id="$id"/>
                </div>
                <div class="row">
                    <x-tablepay :id="$id"/>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row p-3">
                <div class="row">
                    <div class="col-2">
                        <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="amount" value="1">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="tariff" value="0" placeholder="цена за сотку">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="sum" placeholder="сумма">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="дороги"
                                       placeholder="сумма">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить платёж
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <x-formpaypayment :id="$id" :type="$type='дороги'" :button="$button='оплатить дорожный взнос'"/>
                    </div>
                </div>
                <div class="row">
                    <x-tablesumpayment :type="'дороги'" :id="$id"/>
                </div>
                <div class="row">
                    <x-payment-table :type="'дороги'" :id="$id"/>
                </div>
                <div class="row">
                    <x-tablepay :id="$id"/>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row p-3">
                <div class="row">
                    <div class="col-2">
                        <form class="myForm" id="form3" action="{{route('payments.store', $id->id)}}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="amount" value="1">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="tariff" value="0" placeholder="цена за сотку">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="sum" placeholder="сумма">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="мусор"
                                       placeholder="сумма">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить мусор
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <x-formpaypayment :id="$id" :type="$type='мусор'" :button="$button='оплатить мусор взнос'"/>
                    </div>
                </div>
                <div class="row">
                    <x-tablesumpayment :type="'мусор'" :id="$id"/>
                </div>
                <div class="row">
                    <x-payment-table :type="'мусор'" :id="$id"/>
                </div>
                <div class="row">
                    <x-tablepay :id="$id"/>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="camera" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row p-3">
                <div class="row">
                    <div class="col-2">
                        <form class="myForm" id="form3" action="{{route('payments.store', $id->id)}}" method="POST">
                            @csrf
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="amount" value="1">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="tariff" value="0" placeholder="цена за сотку">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="sum" placeholder="сумма">
                            </div>
                            <div class="col-auto">
                                <input type="hidden" class="form-control" name="type" value="видеокамеры"
                                       placeholder="сумма">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Добавить взнос в.камеры
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <x-formpaypayment :id="$id" :type="$type='видеокамеры'" :button="$button='оплатить камеры взнос'"/>
                    </div>
                </div>
                <div class="row">
                    <x-tablesumpayment :type="'видеокамеры'" :id="$id"/>
                </div>
                <div class="row">
                    <x-payment-table :type="'видеокамеры'" :id="$id"/>
                </div>
                <div class="row">
                    <x-tablepay :id="$id"/>
                </div>
            </div>
        </div>
    </div>



<script>
    $(document).ready(function () {
        // При загрузке страницы проверяем, есть ли сохраненная информация о текущей вкладке в localStorage
        var activeTabId = localStorage.getItem('activeTab');
        if (activeTabId) {
            $('#' + activeTabId).tab('show');
        } else {
            // Если сохраненной информации нет, активируем вкладку по умолчанию
            $('.nav-link:first').tab('show');
        }

        // При отправке формы сохраняем информацию о текущей вкладке в localStorage
        $('.myForm').submit(function (event) {
            var activeTab = $('.nav-link.active');
            localStorage.setItem('activeTab', activeTab.attr('id'));
        });

        $('#tariff').on('input', function () {
            // Получаем значения amount и tariff
            var amount = parseFloat($('#amount').val()) || 0;
            var tariff = parseFloat($(this).val()) || 0;

            // Вычисляем сумму и устанавливаем в поле sum
            var sum = amount * tariff;
            $('#sum').val(sum.toFixed(2)); // Устанавливаем значение с округлением до двух знаков после запятой
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
