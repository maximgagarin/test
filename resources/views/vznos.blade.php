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



    <div class="row mb-3"><h5>Начислить всем  взносы</h5></div>

    <div class="row ">
        <div class="col-lg-2 col-sm-6">
            <form action="{{route('vznos.calculation')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <select class="form-select" name="type" id="type">
                        <option selected>Выберите взнос</option>
                        <option>чвзнос</option>
                        <option>мусор</option>
                        <option>дороги</option>
                        <option>благоустройство</option>
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

        <div class="col-lg-7 col-sm-6">
            <table class="table table-bordered border-dark">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts as $count)
                    <tr id="editForm4{{$count->id}}">
                        <td>{{number_format($count->value,2,'.','')}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                        <td>
                                <button class="btn btn-primary btn-sm" onclick="showEditFormCounter({{$count->id}})">Редактировать</button>
                        </td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="editForm5{{$count->id}}" style="display: none; background-color: #f8f9fa;">
                        <form class= "myForm" action="{{route('vznos.edit')}}"  method="post" >
                            @csrf
                            <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                            <td>
                            <input type="text" name="NewValue" value="{{number_format($count->value,2,'.','')}}">
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
        </div>


        <div class="col-lg-7 col-sm-6 mt-2">
            <table class="table table-bordered border-dark">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_road as $count)
                    <tr id="editForm4{{$count->id}}">
                        <td>{{number_format($count->value,2,'.','')}}</td>
                        <td> {{$count->type}}</td>
                        <td>{{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showEditFormCounter({{$count->id}})">Редактировать</button>
                        </td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="editForm5{{$count->id}}" style="display: none; background-color: #f8f9fa;">
                        <form class= "myForm" action="{{route('vznos.edit')}}"  method="post" >
                            @csrf
                            <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                            <td>
                                <input type="text" name="NewValue" value="{{number_format($count->value,2,'.','')}}">
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
        </div>
    </div>
    <div class="row ">

        <div class="col-lg-7 col-sm-6 mt-2">
            <table class="table table-bordered border-dark">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_trash as $count)
                    <tr id="editForm4{{$count->id}}">
                        <td>{{number_format($count->value,2,'.','')}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showEditFormCounter({{$count->id}})">Редактировать</button>
                        </td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="editForm5{{$count->id}}" style="display: none; background-color: #f8f9fa;">
                        <form class= "myForm" action="{{route('vznos.edit')}}"  method="post" >
                            @csrf
                            <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                            <td>
                                <input type="text" name="NewValue" value="{{number_format($count->value,2,'.','')}}">
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
        </div>


        <div class="col-lg-7 col-sm-6 mt-2">
            <table class="table table-bordered border-dark">
                <thead>
                <tr>
                    <th>тариф</th>
                    <th>тип</th>
                    <th>дата начисления</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($counts_camera as $count)
                    <tr id="editForm4{{$count->id}}">
                        <td>{{number_format($count->value,2,'.','')}}</td>
                        <td> {{$count->type}}</td>
                        <td> {{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="showEditFormCounter({{$count->id}})">Редактировать</button>
                        </td>
                        <td>
                            <form action="{{ route('vznos.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="editForm5{{$count->id}}" style="display: none; background-color: #f8f9fa;">
                        <form class= "myForm" action="{{route('vznos.edit')}}"  method="post" >
                            @csrf
                            <input type="hidden" name="NumberAccrualID" value="{{$count->id}}">
                            <td>
                                <input type="text" name="NewValue" value="{{number_format($count->value,2,'.','')}}">
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
        </div>
    </div>
    </div>

    <script>
        function showEditFormCounter(paymentId) {

            // Show the clicked edit form
            $(`#editForm5${paymentId}`).css('display', 'table-row');
            $(`#editForm4${paymentId}`).css('display', 'none');
        }

        function Reload() {
            location.reload(true); // true означает, что браузер выполнит полное обновление страницы, включая кэш
        }
    </script>

@endsection
