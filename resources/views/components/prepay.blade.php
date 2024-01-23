<h6>Аванс: {{$d}}</h6>
<form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{$d}}" name="value">
    <input type="hidden" value="свет" name="type">
    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на свет</button>
</form>
<form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{$d}}" name="value">
    <input type="hidden" value="чвзнос" name="type">
    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на чвзнос</button>
</form>




