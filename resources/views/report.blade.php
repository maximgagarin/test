
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
<div class="container">
    <div class="row text-center mt-5"> <h3>Показания счетчика</h3></div>
    <div class="row  justify-content-center">
        <div class="col-6 p-3">
            @if (empty($lastValue))
                нет показаний
            @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">показание</th>
                    <th scope="col">дата</th>
                    <th scope="col">id</th>
                    <th scope="col">id</th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr id="editForm3{{$count->id}}">
                        <td> {{$count->value}}</td>
                        <td> {{ \Carbon\Carbon::parse($count->date)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showEditFormCounter({{$count->id}})">Редактировать</button>
                        </td>
                        <td>
                        <form action="{{ route('counter.delete', $count->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                        </form>
                        </td>
                    </tr>
                    <tr id="editForm4{{$count->id}}" style="display: none; background-color: #f8f9fa;">
                        <form class= "myForm" action="{{route('counter.update')}}"  method="post" >
                            @csrf
                            <td>
                                <input type="text" class="form-control" name="value" placeholder="сумма" value="{{$count->value}}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" name="id" placeholder="сумма" value="{{$count->id}}">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                <button type="button" class="btn btn-primary btn-sm" onclick="Reload()">Закрыть</button>
                            </td>
                            <td></td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>
</div>
<script>
    function showEditFormCounter(paymentId) {

        // Show the clicked edit form
        $(`#editForm4${paymentId}`).css('display', 'table-row');
        $(`#editForm3${paymentId}`).css('display', 'none');
    }

    function Reload() {
        location.reload(true); // true означает, что браузер выполнит полное обновление страницы, включая кэш
    }
</script>
@endsection
