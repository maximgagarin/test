<form   action="{{route('debts3')}}" >
    @csrf

    <div class="col-auto">
        <input type="hidden" class="form-control" name="type" value="{{$slot}}" placeholder="сумма">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary btn-sm mb-3 custom-button">{{$button}}</button>

    </div>
</form>

<style>
.custom-button {
width: 80px; /* Задайте желаемую ширину кнопки здесь */
}
</style>
