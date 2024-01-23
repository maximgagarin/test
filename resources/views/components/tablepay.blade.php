<div class="col-3">
    <table class="table">
        <thead>
        <tr>
            <th>платёж</th>
            <th>сумма</th>
            <th>дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments2 as $payment)
            <tr>
                <td> {{$payment->payments_id}}</td>
                <td> {{$payment->sum}}</td>
                <td> {{$payment->date}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
