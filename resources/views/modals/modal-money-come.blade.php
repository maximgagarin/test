<div class="modal fade" id="MoneyComeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Поступление денег</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th>дата оплаты</th>
                                <th>сумма прихода</th>
                                <th>в аванс</th>
                                <th>всего оплачено</th>
                                <th>э/энергия</th>
                                <th>чвзнос</th>
                                <th>мусор</th>
                                <th>дороги</th>
                                <th>благоуст.</th>
                                <th>дата занесения</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incoming as $count)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($count->date)->format('d-m-Y') }}</td>

                                    <td>{{ number_format($count->sum_incoming, 2, '.', '') }}</td>
                                    <td> {{number_format($count->sum_left,2,'.','')}}</td>
                                    <td> {{number_format($count->sum_paid,2,'.','')}}</td>
                                    <td> {{number_format($count->svet,2,'.','')}}</td>
                                    <td> {{number_format($count->chvznos,2,'.','')}}</td>
                                    <td> {{number_format($count->trash,2,'.','')}}</td>
                                    <td> {{number_format($count->road,2,'.','')}}</td>
                                    <td> {{number_format($count->camera,2,'.','')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($count->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <form action="{{ route('incoming.delete', $count->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" name="id"
                                                       value="{{$count->id}}">
                                            </div>

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">
                                                Отменить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>
</div>
