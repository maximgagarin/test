<h6>Аванс: {{$d}}р.</h6>
<a href="{{route('prepay.index', $id->id)}}" >История</a>
<form class="myForm mt-3" action="{{ route('prepay', $id->id) }}" method="POST">
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
<form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{$d}}" name="value">
    <input type="hidden" value="мусор" name="type">
    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на мусор</button>
</form>
<form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{$d}}" name="value">
    <input type="hidden" value="дороги" name="type">
    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на дороги</button>
</form>
<form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{$d}}" name="value">
    <input type="hidden" value="видеонаблюдение" name="type">
    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на в.наблюд</button>
</form>
{{--<form class="myForm" action="{{ route('prepay.store') }}" method="POST">--}}
{{--    @csrf--}}
{{--    <input type="text"  name="value" placeholder="Добавить аванс">--}}
{{--    <input type="hidden"  name="areas_id" value="{{$id->id}}" placeholder="Добавить аванс">--}}
{{--    <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Добавить аванс</button>--}}
{{--</form>--}}





