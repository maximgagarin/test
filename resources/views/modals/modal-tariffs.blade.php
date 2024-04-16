<div class="modal fade" id="TariffsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Тарифы на энергия</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row   justify-content-center">
                    <div class="col-6">
                        <form  action="{{route('tariff.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="value" placeholder="введите значение">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">тариф</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tariffs as $count)
                                <tr>
                                    <td> {{number_format($count->value,2,'.','')}}</td>
                                    <td> <button class="btn btn-danger btn-sm">Удалить</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>
