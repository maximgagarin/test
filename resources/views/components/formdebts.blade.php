<form   action="{{route('debts2')}}" method="POST">
    @csrf

    <div class="col-auto">
        <input type="hidden" class="form-control" name="type" value="{{$slot}}" placeholder="сумма">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary btn-sm mb-3">{{$button}}</button>
    </div>
</form>

