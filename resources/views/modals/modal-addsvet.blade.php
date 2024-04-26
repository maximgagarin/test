<div class="modal fade" id="AddSvetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить старый долг на э/энергия</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-4">
                <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">

                        <input type="text" class="form-control" name="amount" id="amount"  placeholder="квт"
                               value="">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="tariff" id="tariff"
                               placeholder="тариф">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="type" value="энергия"
                               placeholder="сумма">
                    </div>
                    <label>Дата</label>
                    <div class="mb-3">
                        <input type="date" class="form-control" name="date" value="">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm mb-3">Начислить
                        </button>
                    </div>
                </form>
                </div>

            <div class="modal-footer">
                <div class="col-4">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
