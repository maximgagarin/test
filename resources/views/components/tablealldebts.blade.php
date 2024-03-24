
    <table class="table table-bordered ">
        <tr style="background-color: darkred">
            <td colspan="2"><h6  style="color: #edf2f7">Задолженность : <span id="alldebt">{{$totalsum}}</span></h6></td>
        </tr>
        <tr>
            <td>Свет</td>
            <td><span id="svetdebt">{{$svet}}</span>р.</td>
        </tr>
        <tr>
            <td>Чвзнос</td>
            <td><span id="chvznosdebt">{{$chvznos}}</span>р.</td>
        </tr>
        <tr>
            <td>Дороги</td>
            <td><span id="roaddebt">{{$road}}</span>р.</td>
        </tr>
        <tr>
            <td>в.наблюдение</td>
            <td><span id="cameradebt">{{$camera}}</span>р.</td>
        </tr>
        <tr>
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
        <button>Печатная форма</button>
    </form>

