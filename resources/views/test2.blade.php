@extends('layout')
@section('content')







<table class="table">
    <thead>
    <tr>
        <th>номер</th>
        <th>номер</th>
        <th>номер</th>

    </tr>
    </thead>
    <tbody>
    @foreach($results as $result)
        <tr>
            <td> {{$result->name}}</td>
            <td> {{$result->sum1}}</td>
            <td> {{$result->sum2}}</td>
        </tr>
    @endforeach
    </tbody>
</table>



@endsection
