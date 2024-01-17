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
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Таблица для данных из table1 -->
    <table>
        <!-- ... -->
    </table>

    <h1>Data from Table 2</h1>
    <!-- ... -->
@endsection
