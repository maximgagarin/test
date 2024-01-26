<div class="col-5">
    <table class="table">
        <thead>
        <tr>
            <th>areas_id</th>
            <th>платёж</th>
            <th>сумма</th>
            <th>тип</th>
            <th>дата</th>
            <th>тип</th>
            <th>удалить</th>
            <th>id</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments2 as $payment)
            <tr>
                <td> {{$id->id}}</td>
                <td> {{$payment->payments_id}}</td>
                <td> {{$payment->sum}}р.</td>
                <td> {{$payment->type}}</td>
                <td> {{$payment->date}}</td>
                <td> {{$payment->prepays}}</td>
                <td>
                    <form action="{{ route('payment_mov.delete', $payment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="payment_id" value="{{$payment->payments_id}}">
                        <input type="hidden" name="areas_id" value="{{$id->id}}">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот платеж?')">Удалить</button>
                    </form>
                </td>
                <td> {{$payment->id}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
