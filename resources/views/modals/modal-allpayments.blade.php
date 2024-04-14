<div class="modal fade" id="AllPaymentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Все платежи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('form.submit') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>выбрать</th>
                            <th>тип</th>
                            <th>сумма</th>
                            <th>год</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($AllPayments as $count)
                            <tr>
                                <td><input type="checkbox" checked id="{{$count->idid}}" name="selected_payments[]" value="{{$count->idid}}"></td>
                                <td>{{ $count->type }}</td>
                                <td>{{number_format($count->sum,2,'.','')}}р.</td>
                                <td>{{ \Carbon\Carbon::parse($count->date)->format('Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" value="{{$id->name}}" name="namesnt">
                    <input type="hidden" value="{{$id->number}}" name="numbersnt">
                    <button type="submit" class="btn btn-primary btn-sm">Создать квитанцию</button>
                </form>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>
</div>
