
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

    <div class="row mb-3"> <h3 class="text-center mt-5 mb-5">История авансов</h3></div>

    <div class="row  justify-content-center">
{{--        <div class="col-2">--}}
{{--            <form  action="{{route('prepay.store')}}" method="POST">--}}
{{--                @csrf--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="">Добавить аванс вручную</label>--}}
{{--                    <input type="text" class="form-control" name="value" placeholder="введите значение">--}}
{{--                    <input type="hidden" class="form-control" name="areas_id" value="{{$id}} ">--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="col-lg-4 col-sm-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">сумма</th>

                    <th scope="col">дата</th>
                    <th scope="col">приход</th>

                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr>
                        <td> {{number_format($count->sum,2,'.','')}}</td>

                        <td> {{$count->date}}</td>
                        <td> {{$count->saldo}}</td>
                        <td>
                            <form action="{{ route('prepay.delete', $count->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                                <input type="hidden" class="form-control" name="areas_id" value="{{$id}} ">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
