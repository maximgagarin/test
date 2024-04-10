<div class="modal fade " id="PrepayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable   custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Аванс</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <form class="myForm mt-3" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="свет" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на свет</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="чвзнос" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на чвзнос</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="мусор" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на мусор</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="дороги" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на дороги</button>
                    </form>
                    <form class="myForm" action="{{ route('prepay', $id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$prepayActual}}" name="value">
                        <input type="hidden" value="видеонаблюдение" name="type">
                        <button class="btn btn-outline-primary btn-sm mb-3" type="submit">Списать аванс на в.наблюд</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>

    </div>

