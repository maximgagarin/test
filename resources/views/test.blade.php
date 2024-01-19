<!-- resources/views/your-view.blade.php -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <form class="row g-3" action="{{route('payments.pay',$id->id)}}" method="POST" >
                        @csrf
                        <div class="col-auto">
                            <input type="text" class="form-control" name="value" placeholder="введите сумму">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Оплатить свет</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <form class="row g-3" action="{{route('payments.store', $id->id)}}" method="POST" >
                        @csrf
                        <div class="col-auto">
                            <input type="text" class="form-control" name="amount"  placeholder="количество квт">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="tariff"  placeholder="тариф">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="sum" placeholder="сумма">
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Добавить платёж</button>
                        </div>
                    </form>

                </div>
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th >вид</th>
                            <th >ед.изм</th>
                            <th >количество</th>
                            <th >сумма</th>
                            <th >оплачено</th>
                            <th >осталось</th>
                            <th >статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-danger">ОБЩЕЕ СВЕТ</th>
                            <th></th>
                            <th></th>
                            <th class="text-danger">{{$sumAllSvet}} </th>
                            <th class="text-danger">{{$sumPaidSvet}} </th>
                            <th class="text-danger">{{$sumLeft}} </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <th>
                    <table class="table">
                        <thead>
                        <tr>
                            <th >номер</th>
                            <th >тип</th>
                            <th >колич</th>
                            <th >тариф</th>
                            <th >сумма</th>
                            <th >дата</th>
                            <th >статус</th>
                            <th >Оплачено</th>
                            <th >Осталось</th>

                            <th ></th>
                            <th ></th>
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
                                <td >
                                    <button class="btn btn-danger btn-sm">удалить</button>
                                </td>
                            </tr>
                            <tr id="editForm{{$payment->id}}"  style="display: none; background-color: #f8f9fa;">
                                <form class= action=""  >
                                    @csrf
                                    @method('PATCH')
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control" name="init"  placeholder="квт">
                                    </td>
                                    <td  >
                                        <input  type="text" class="form-control" name="amount"  placeholder="тариф">
                                    </td>
                                    <td>
                                        <input  type="text" class="form-control" name="tariff"  placeholder="сумма">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                        <button type="submit" class="btn btn-primary  btn-sm">Закрыть</button>
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <th>

                                    </th>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>



        <script>
            function showEditForm(paymentId) {

                // Show the clicked edit form
                document.getElementById(`editForm${paymentId}`).style.display = 'table-row';
            }
        </script>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">123123123123</div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
