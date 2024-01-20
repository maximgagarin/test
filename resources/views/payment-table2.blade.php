<table class="table">
    <thead>
    <tr>
        <th>номер</th>
        <th>тип</th>
        <th>колич</th>
        <th>тариф</th>
        <th>сумма</th>
        <th>дата</th>
        <th>статус</th>
        <th>Оплачено</th>
        <th>Осталось</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td> {{$payment->id}}</td>
            <td> {{$payment->type}}</td>
            <td> {{$payment->amount}}</td>
            <td> {{$payment->tariff}}</td>
            <td> {{$payment->sum}}</td>
            <td> {{$payment->date}}</td>
            <td> {{$payment->status}}</td>
            <td> {{$payment->sumpaid}}</td>
            <td>{{$payment->sum - $payment->sumpaid}}</td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="showEditForm({{$payment->id}})">Редактировать</button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm">удалить</button>
            </td>
        </tr>
        <tr id="editForm{{$payment->id}}" style="display: none; background-color: #f8f9fa;">
            <form class=action="">
                @csrf
                @method('PATCH')
                <td></td>
                <td>
                    <input type="text" class="form-control" name="init" placeholder="квт">
                </td>
                <td>
                    <input type="text" class="form-control" name="amount" placeholder="тариф">
                </td>
                <td>
                    <input type="text" class="form-control" name="tariff" placeholder="сумма">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                    <button type="submit" class="btn btn-primary  btn-sm">Закрыть</button>
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

