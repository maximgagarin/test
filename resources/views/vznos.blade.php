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



    <div class="modal fade" id="VzosEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактировать участок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>

    </div>



    <div class="row mb-3"><h3>Начислить всем участинкам взносы</h3></div>

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

        <div class="col-lg-6 col-sm-6">
            <table class="table table-bordered">
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
                        <td> {{$count->created_at}}</td>
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
                            <input type="text" name="NewValue" value="{{$count->value}}">
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


        <div class="col-lg-6 col-sm-6">
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
                        <td>{{number_format($count->value,2,'.','')}}</td>
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


        <div class="col-lg-6 col-sm-6">
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
                        <td>{{number_format($count->value,2,'.','')}}</td>
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


        <div class="col-lg-6 col-sm-6">
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
                        <td>{{number_format($count->value,2,'.','')}}</td>
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
