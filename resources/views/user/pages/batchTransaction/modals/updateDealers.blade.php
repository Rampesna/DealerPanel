<div class="modal fade" id="UpdateDealersModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Müşterilere Bayi Ataması Yap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="UpdateDealersForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <label for="dealers">Atama Yapılacak Bayiyi Seçin</label>
                        <select id="dealers" class="form-control selectpicker" data-live-search="true">

                        </select>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="UpdateDealersButton">Atama Yap</button>
            </div>
        </div>
    </div>
</div>
