
@extends('layout')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row mb-3"> <h3>Начислить всем участинкам взносы</h3></div>

    <div class="row">
        <div class="col-2">
            <form  action="{{route('vznos.calculation')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="value" placeholder="введите значение">
                </div>
                <div class="mb-3">
                    <select class="form-select" name="type" id="type">
                        <option selected>Выберите взнос</option>
                        <option>чвзнос</option>
                        <option>мусор</option>
                        <option>дороги</option>
                        <option>видеонаблюдение</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Начислить</button>
            </form>
        </div>
        <div class="col-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">тариф</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


@endsection
