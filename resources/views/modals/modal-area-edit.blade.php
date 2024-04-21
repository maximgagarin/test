<div class="modal fade" id="AreaEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактировать участок</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <form class="myForm" id="form1" action="{{route('area.update')}}" method="POST">
                        @csrf



                        <div>
                            <input type="radio" id="huey" name="test1" {{$id->area_status==1 ? 'checked' : ''}} value="on"/>
                            <label for="huey">включен в рассчеты</label>
                        </div>

                        <div>
                            <input type="radio" id="dewey" name="test1" {{$id->area_status==0 ? 'checked' : ''}} value="off" />
                            <label for="dewey">отключен от рассчетов</label>
                        </div>

                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="id" value="{{$id->id}}" >
                        </div>
                        <div class="mb-3">
                            <label>Номер участка</label>
                            <input type="text" class="form-control" name="number" value="{{$id->number}}" >
                        </div>
                        <div class="mb-3">
                            <label>Собственник</label>
                            <input type="text" class="form-control" name="name" value="{{$id->name}}" >
                        </div>
                        <div class="mb-3">
                            <label>Адрес собственника</label>
                            <input type="text" class="form-control" name="address" value="{{$id->address}}" >
                        </div>
                        <div class="mb-3">
                            <label>Телефон</label>
                            <input type="text" class="form-control" name="telephone" value="{{$id->telephone}}" >
                        </div>

                        <div class="mb-3">
                            <label>Площадь участка</label>
                            <input type="text" class="form-control" name="square" value="{{$id->square}}" >
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm mb-3">Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>

    </div>

