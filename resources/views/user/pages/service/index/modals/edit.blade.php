<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hizmet Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="name_edit">Paket Adı</label>
                            <input id="name_edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="credit_amount_edit">Kontör Sayısı</label>
                            <input id="credit_amount_edit" type="text" class="form-control onlyNumber">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="price_edit">Fiyatı</label>
                            <input id="price_edit" type="text" class="form-control decimal">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="UpdateButton">Güncelle</button>
            </div>
        </div>
    </div>
</div>
