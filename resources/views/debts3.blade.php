
@extends('layout')
@section('content')
<div class="container">
    <h4 class="text-center p-3">Задолженности по участкам</h4>

    <div class="row">


        <h5>Всего долг  {{$type}}: {{$formattedTotal}}р.</h5>


        <table class="mt-4 table table-bordered">

            {{ $paginator->withQueryString()->links() }}
            <thead>
            <tr>
                <th>Участок</th>
                <th class="text-danger">долг</th>
            </tr>
            </thead>
            <tbody>
            @foreach($paginator as $result)
                <tr class="tr-link" onclick="window.location='{{ route('dashboard', $result->id) }}';">
                    <td> {{$result->number}}</td>
                    <td> {{  $result->total_payments_sum - $result->total_payment_movs_sum}}р.</td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
