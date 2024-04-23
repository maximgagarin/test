<table class="table table-bordered mb-5">
    <thead>

    <tr class="bg-light">
        <th>№</th>
        <th>тип</th>
        <th>колич</th>
        <th>тариф</th>
        <th>начислено</th>
        <th>дата начисл</th>
        <th>статус</th>
        <th>Оплачено</th>
        <th>Осталось</th>

        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr id="editForm2{{$payment->id}}">
            <td> {{$payment->id}}</td>
            <td> {{$payment->type}}</td>
            <td> {{number_format($payment->amount,2,'.','')}}</td>
            <td>{{number_format($payment->tariff,2,'.','')}}р.</td>
            <td>{{number_format($payment->sum,2,'.','')}}р.</td>
            <td>{{ \Carbon\Carbon::parse($payment->date)->format('d-m-Y') }}</td>
            <td> {{$payment->status}}</td>
            <td>{{number_format($payment->sumpaid,2,'.','')}}р.</td>
            <td>{{$payment->sum - $payment->sumpaid}}р.</td>
            <td>
                <button class="btn btn-dark btn-sm" onclick="showEditForm({{$payment->id}})">Редактировать</button>
            </td>
            <td>
                <form action="{{ route('payment.delete', $payment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Вы уверены, что хотите удалить этот платеж? Оплата по платежу перейдёт в аванс')">Удалить
                    </button>
                </form>
            </td>
        </tr>
        <tr id="editForm{{$payment->id}}" style="display: none; background-color: darkgrey;">
            <form class="myForm" style="margin: 0" action="{{route('payments.update')}}" method="post">
                @csrf

                <td></td>
                <td>{{$payment->type}}</td>
                <td>
                    <input type="text" class="form-control" name="amount" placeholder="квт" value="{{$payment->amount}}">
                </td>
                <td>
                    <input type="text" class="form-control" name="tariff" placeholder="тариф" value="{{number_format($payment->tariff,2,'.','')}}">
                </td>
                <td>
                    <input type="text" class="form-control"  style="width: 80px; height: 30px ; padding: 0; margin: 0"  name="sum" placeholder="сумма" value="{{number_format($payment->sum,2,'.','')}}">
                </td>
                <td>
                    <input type="hidden" class="form-control" name="type" placeholder="сумма"
                           value="{{$payment->type}}">
                </td>
                <td>
                    <input type="hidden" class="form-control" name="id" placeholder="сумма" value="{{$payment->id}}">
                </td>


                <td>
                    <button type="submit" class="btn btn-primary btn-sm" >Сохранить</button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm"  onclick="Reload()">Закрыть</button>
                </td>
            </form>
        </tr>
    @endforeach
    </tbody>
</table>

