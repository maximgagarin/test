
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <h3>Все участки</h3>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">номер</th>
                    <th scope="col">адрес</th>
                    <th scope="col">телефон</th>
                    <th scope="col">имя</th>
                    <th scope="col">площадь</th>
                    <th scope="col">аванс</th>
                    <th scope="col">комент</th>
                    <th scope="col">кнопка</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all as $al)
                    <tr>
                        <th> {{$al->number}}</th>
                        <th> {{$al->address}}</th>
                        <th> {{$al->telephone}}</th>
                        <th> {{$al->name}}</th>
                        <th> {{$al->square}}</th>
                        <th> {{$al->balance}}</th>
                        <th> {{$al->comment}}</th>
                        <th> <a href="{{ route('dashboard', $al->id) }}">Перейти</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">

    </div>
    <button class="button btn btn-danger" id="ajax">Ajax</button>
    <table id="counters-table" class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Value</th>
            <th>Date</th>
            <th>Date</th>
            <!-- Добавьте другие колонки по необходимости -->
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>



<script>
    $('#ajax').click(function (){

        $.ajax({
            url: "Counter",

            success: function (data) {
                // Очищаем таблицу перед обновлением
                $('#counters-table tbody').empty();

                // Добавляем данные в таблицу
                $.each(data, function (index, counter) {
                    $('#counters-table tbody').append(
                        '<tr>' +
                        '<td>' + counter.id + '</td>' +
                        '<td>' + counter.value + '</td>' +
                        '<td>' + counter.date + '</td>' +
                        '<td>' + '<button class="editStudentBtn btn btn-success btn-sm" value="'+counter.id+'" id="'+counter.id+'">123</button>' + '<td>'+
                        '</tr>'
                    );
                });
            }
        });
    });

    $('#counters-table').on('click', '.editStudentBtn', function() {
        // Получение id кнопки
        var student_id = $(this).val();

        // Показ id кнопки (вы можете использовать другой способ для отображения id)
        alert('ID кнопки: ' +student_id);
    });
</script>
@endsection

