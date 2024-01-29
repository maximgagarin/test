
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

<div class="ror"> <h3>Показания счетчика</h3></div>

<div class="row">

    <div class="col-3">
{{--        <form  action="{{ route('store2') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Показания</label>--}}
{{--                <input type="number" class="form-control" name="value">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Тариф</label>--}}
{{--                <select name="select" class="form-select" aria-label="Default select example">--}}
{{--                    <option selected>Выберите тариф</option>--}}
{{--                    @foreach($tariffs as $tariff)--}}
{{--                        <option value="{{ $tariff->value }}">{{ $tariff->value }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <input type="date" class="form-control" name="date">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <input type="hidden" class="form-control" name="areas_id" value="{{$id}}">--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Отправить</button>--}}
{{--        </form>--}}
    </div>
    <div class="col-3 p-3">
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
                <th scope="col">id</th>
            </tr>
            </thead>
            <tbody>
            @foreach($counts as $count)
                <tr id="editForm3{{$count->id}}">
                    <td> {{$count->value}}</td>
                    <td> {{$count->date}}</td>
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
                        <td></td>


                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
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
