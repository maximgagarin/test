<div class="modal fade" id="PaymentsChvznosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Счета на членский взнос</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="myForm" id="form2" action="{{route('payments.store', $id->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Площадь</label>
                        <input type="text" class="form-control" name="amount" id="amount"
                               value="">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="tariff" id="tariff"
                               placeholder="цена за сотку">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="sum" id="sum" placeholder="сумма">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="type" value="свет"
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
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
