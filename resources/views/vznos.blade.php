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



    <div class="row mb-3"><h3>Начислить всем участинкам взносы</h3></div>

    <div class="row ">
        <div class="col-2">
            <form action="{{route('vznos.calculation')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <select class="form-select" name="type" id="type">
                        <option selected>Выберите взнос</option>
                        <option>чвзнос</option>
                        <option>мусор</option>
                        <option>дороги</option>
                        <option>видеонаблюдение</option>
                    </select>
                </div>


                <div class="mb-3">
                    <input type="text" class="form-control" name="value" placeholder="введите значение">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Начислить</button>
            </form>
        </div>
    </div>

    <div class="row mb-3 mt-5">

        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>


                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr>
                        <td> {{$count->value}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{$count->created_at}}</td>

                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_road as $count)
                    <tr>
                        <td> {{$count->value}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{$count->created_at}}</td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row ">


        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_trash as $count)
                    <tr>
                        <td> {{$count->value}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{$count->created_at}}</td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_camera as $count)
                    <tr>
                        <td> {{$count->value}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{$count->created_at}}</td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
