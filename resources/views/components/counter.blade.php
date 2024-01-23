
    <h6>Счетчик</h6>
    <div><a href="{{ route('counter2', $id->id) }}">История показаний</a></div>
    @if (empty($lastValue))
        нет показаний
        <form class="myForm" action="{{ route('store2') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="number" class="form-control" name="value" placeholder="показание">
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="date">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
            </div>
            <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
        </form>
    @else
        <h6>Последнее показание: {{$lastValue}}</h6>
        <form class="myForm"  action="{{ route('store2') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="number" class="form-control" name="value" placeholder="показание">
            </div>
            <div class="mb-3">
                <select name="select" class="form-select" aria-label="Default select example">
                    <option selected>Выберите тариф</option>
                    @foreach($tariffs as $tariff)
                        <option value="{{ $tariff->value }}">{{ $tariff->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="date">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="areas_id" value="{{$id->id}}">
            </div>
            <button type="submit" class="btn btn-outline-primary btn-sm">Отправить</button>
        </form>

    @endif
