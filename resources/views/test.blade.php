<!-- resources/views/your-view.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Data from Table 1</h1>
    <a href="{{ route('createRecord') }}" class="btn btn-primary">Add New Record</a>
    <table>
        <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data1 as $row)
            <tr>
                <td>{{ $row->column1 }}</td>
                <td>{{ $row->column2 }}</td>
                <td>
                    <a href="{{ route('editRecord', ['id' => $row->id]) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('deleteRecord', ['id' => $row->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h1>Data from Table 2</h1>
    <!-- ... Аналогично для данных из table2 -->
@endsection


<!-- resources/views/your-view.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Data from Table 1</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRecordModal">Add New Record</button>

    <!-- Модальное окно для добавления новой записи -->
    <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Add New Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Форма для добавления новой записи -->
                    <form action="{{ route('storeRecord') }}" method="POST">
                        @csrf
                        <label for="column1">Column 1:</label>
                        <input type="text" name="column1" required>

                        <label for="column2">Column 2:</label>
                        <input type="text" name="column2" required>

                        <!-- Добавьте другие поля по необходимости -->

                        <button type="submit" class="btn btn-primary">Save Record</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div>

</div>
    <!-- Таблица для данных из table1 -->
    <table>
        <!-- ... -->
    </table>

    <h1>Data from Table 2</h1>
    <!-- ... -->
@endsection
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

<table class="table">
    <thead>
    <tr>
        <th >номер</th>
        <th >тип</th>
        <th >колич</th>
        <th >тариф</th>
        <th >сумма</th>
        <th >дата</th>
        <th >статус</th>
        <th >Оплачено</th>
        <th >Осталось</th>
        <th ></th>
        <th ></th>
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
                <button class="btn btn-primary btn-sm" onclick="showEditForm({{$payment->id}})">Редактировать</button>
            </td>
            <td >
                <button class="btn btn-danger btn-sm">удалить</button>
            </td>
        </tr>
        <tr id="editForm{{$payment->id}}"  style="display: none; background-color: #f8f9fa;">
            <form class= action=""  >
                @csrf
                @method('PATCH')
                <td></td>
                <td>
                    <input type="text" class="form-control" name="init"  placeholder="квт">
                </td>
                <td  >
                    <input  type="text" class="form-control" name="amount"  placeholder="тариф">
                </td>
                <td>
                    <input  type="text" class="form-control" name="tariff"  placeholder="сумма">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                    <button type="submit" class="btn btn-primary  btn-sm">Закрыть</button>
                </td>
                <td>                                </td>
                <td>                                </td>
                <th>
                </th>
            </form>
        </tr>
    @endforeach
    </tbody>
</table>
