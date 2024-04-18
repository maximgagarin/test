
    <table class="table table-bordered border-top border-3 border-bottom border-3">
        <tr  class="tr-link" >
            <td colspan="2"><h6  style="color:red">Долг : <span id="alldebt">{{$totalsum}}</span></h6></td>
        </tr>
        <tr class="tr-link" data-bs-toggle="modal" data-bs-target="#PaymentsSvetModal">
            <td>Э/энерия</td>
            <td><span id="svetdebt">{{$svet}}</span>р.

            </td>
        </tr>
        <tr class="tr-link" data-bs-toggle="modal" data-bs-target="#PaymentsChvznosModal">
            <td>Чвзнос</td>
            <td><span id="chvznosdebt">{{$chvznos}}</span>р.</td>
        </tr>
        <tr class="tr-link" data-bs-toggle="modal" data-bs-target="#PaymentsRoadModal">
            <td>Дороги</td>
            <td><span id="roaddebt">{{$road}}</span>р.</td>
        </tr>
        <tr class="tr-link" data-bs-toggle="modal" data-bs-target="#PaymentsVideoModal">
            <td>Благоустройство</td>
            <td><span id="cameradebt">{{$camera}}</span>р.</td>
        </tr>

        <tr class="tr-link" data-bs-toggle="modal" data-bs-target="#PaymentsTrashModal">
            <td>Мусор</td>
            <td><span id="trashdebt">{{$trash}}</span>р.</td>
        </tr>


    </table>
    <form action="{{route('form')}}" method="POST">
        @csrf
        <input type="hidden" name="id"  value="{{$id->id}}">
        <input type="hidden" name="svet" value="{{$svet}}">
        <input type="hidden" name="chvznos" value="{{$chvznos}}">
        <input type="hidden" name="road" value="{{$road}}">
        <input type="hidden" name="camera" value="{{$camera}}">
        <input type="hidden" name="trash" value="{{$trash}}">
        <input type="hidden" name="totalsum" value="{{$totalsum}}">
    </form>

