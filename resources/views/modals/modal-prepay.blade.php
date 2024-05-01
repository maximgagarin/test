<div class="modal fade " id="PrepayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable   custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Аванс</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                    <form class="myForm mb-3" action="{{ route('prepay.add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="sum" placeholder="Введите сумму">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary btn-sm mb-3" type="submit">Добавить аванс</button>
                            </div>
                        </div>
                        <input type="hidden"  name="saldo" value="приход" placeholder="приход">
                        <input type="hidden"  name="areas_id" value="{{$id->id}}" placeholder="">
                    </form>

                    <form class="myForm mt-3" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="энергия" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на энергия</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="чвзнос" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на чвзнос</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="мусор" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на мусор</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="дороги" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на дороги</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="благоустройство" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на благоуст</button>
                    </form>


                <div class="col-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>сумма</th>
                            <th>дата</th>
                            <th>вид</th>
                            <th>тип</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Prepays as $count)
                            <tr>
                                <td> {{number_format($count->sum,2,'.','')}}</td>
                                <td> {{$count->date}}</td>
                                <td> {{$count->saldo}}</td>
                                <td> {{$count->type}}</td>
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
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>

    </div>

    </div>

