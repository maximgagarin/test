<table class="table">
    <thead>
    <tr>
        <th>номер</th>
        <th>тип</th>
        <th>колич</th>
        <th>тариф</th>
        <th>сумма</th>
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
            <td> {{$payment->amount}}</td>
            <td> {{$payment->tariff}}р.</td>
            <td> {{$payment->sum}}р.</td>
            <td>{{ \Carbon\Carbon::parse($payment->date)->format('d-m-Y') }}</td>
            <td> {{$payment->status}}</td>
            <td> {{$payment->sumpaid}}</td>
            <td>{{$payment->sum - $payment->sumpaid}}р.</td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="showEditForm({{$payment->id}})">Редактировать</button>
            </td>
            <td>
                <form action="{{ route('payment.delete', $payment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                </form>
            </td>
        </tr>
        <tr id="editForm{{$payment->id}}" style="display: none; background-color: #f8f9fa;">
            <form class= "myForm" action="{{route('payments.update')}}"  method="post" >
                @csrf

                <td>{{$payment->id}}</td>
                <td>{{$payment->type}}</td>

                <td>
                    <input type="text" class="form-control" name="amount" placeholder="квт" value="{{$payment->amount}}">
                </td>
                <td>
                    <input type="text" class="form-control" name="tariff" placeholder="тариф" value="{{$payment->tariff}}">
                </td>
                <td>
                    <input type="text" class="form-control" name="sum" placeholder="сумма" value="{{$payment->sum}}">
                </td>
                <td>
                    <input type="hidden" class="form-control" name="type" placeholder="сумма" value="{{$payment->type}}">
                </td>
                <td>
                    <input type="hidden" class="form-control" name="id" placeholder="сумма" value="{{$payment->id}}">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="Reload()">Закрыть</button>

                </td>
                <td></td>
                <td></td>
                <th>
                </th>
            </form>
        </tr>
    @endforeach
    </tbody>
</table>

