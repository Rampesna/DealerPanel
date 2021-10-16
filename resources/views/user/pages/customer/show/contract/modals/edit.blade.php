<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sözleşmeyi Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="number_edit">Sözleşme Numarası</label>
                            <input id="number_edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="status_id_edit">Sözleşme Durumu</label>
                            <select id="status_id_edit" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="start_edit">Sözleşme Başlangıcı</label>
                            <input id="start_edit" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="end_edit">Sözleşme Bitişi</label>
                            <input id="end_edit" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description_edit">Açıklamalar</label>
                            <textarea id="description_edit" class="form-control" rows="4"></textarea>
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
