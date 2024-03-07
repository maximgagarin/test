@extends('layout')
@section('content')





    <div class="container">
   <h5>123</h5>
   <div class="col-6">
    <table class="table #counters-table" id="counters-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Value</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
   </div>
</div>

    <button type="button" class="ajax" id="ajax">кнопа</button>

    <!-- ... -->

<script>
    let button = document.getElementById('ajax');
    button.onclick = function (){
        axios.get('/test3')
            .then(function (response) {
                // handle success
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
    }


</script>

@endsection
