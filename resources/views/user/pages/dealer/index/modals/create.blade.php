<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bayi Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="CreateForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_number_create">Vergi Numarası</label>
                            <input id="tax_number_create" type="text" class="form-control onlyNumber" maxlength="11">
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="form-group">
                            <label for="name_create">Bayi Ünvanı</label>
                            <input id="name_create" type="text" class="form-control">
                        </div>
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
