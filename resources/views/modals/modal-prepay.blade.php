<div class="modal fade " id="PrepayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable   custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Аванс</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-6">
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
                        <input type="hidden" value="видеонаблюдение" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на в.наблюд</button>
                    </form>
                </div>

                <div class="col-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">сумма</th>
                            <th scope="col">дата</th>
                            <th scope="col">приход</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Prepays as $count)
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
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>

    </div>

