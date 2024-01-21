<table class="table mt-3">

    <thead>
    <tr>
        <th scope="col">номер</th>
        <th scope="col">начислено </th>
        <th scope="col">оплачено  </th>
        <th scope="col">долг  </th>
    </tr>
    </thead>
    <tbody>
    @foreach($result as $al)
        <tr>
            <td> {{$al->number}}</td>
            <td> {{$al->total_payments_sum}}</td>
            <td> {{$al->total_payment_movs_sum}}</td>
            <td> {{  $al->total_payments_sum - $al->total_payment_movs_sum}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
