
<form class="myForm" action="{{route('payments.pay',$id->id)}}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control" name="value" placeholder="введите сумму">
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="type" value="{{$type}}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary btn-sm mb-3">{{$button}}</button>
    </div>
</form>


