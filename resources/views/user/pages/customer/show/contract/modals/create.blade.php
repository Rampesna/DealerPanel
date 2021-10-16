<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sözleşme Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="CreateForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="number_create">Sözleşme Numarası</label>
                            <input id="number_create" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="status_id_create">Sözleşme Durumu</label>
                            <select id="status_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="start_create">Sözleşme Başlangıcı</label>
                            <input id="start_create" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="end_create">Sözleşme Bitişi</label>
                            <input id="end_create" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description_create">Açıklamalar</label>
                            <textarea id="description_create" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <label for="file_create">Sözleşme Dosyası</label>
                        <input id="file_create" type="file">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="CreateButton">Oluştur</button>
            </div>
        </div>
    </div>
</div>
