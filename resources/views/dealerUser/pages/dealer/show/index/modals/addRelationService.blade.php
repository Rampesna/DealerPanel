<div class="modal fade" id="AddRelationServiceModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hizmet Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="AddRelationServiceForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="form-group">
                            <label for="service_id_create">Hizmet</label>
                            <select id="service_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="amount_create">Adet</label>
                            <input id="amount_create" type="text" class="form-control decimal">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="start_create">Başlangıç Tarihi</label>
                            <input id="start_create" type="datetime-local" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="end_create">Bitiş Tarihi</label>
                            <input id="end_create" type="datetime-local" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="status_id_create">Durum</label>
                            <select id="status_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="AddRelationServiceButton">Oluştur</button>
            </div>
        </div>
    </div>
</div>
