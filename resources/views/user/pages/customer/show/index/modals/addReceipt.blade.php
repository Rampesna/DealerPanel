<div class="modal fade" id="AddReceiptModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ödeme Al</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="AddReceiptForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="price">Ödeme Alınacak Tutar</label>
                            <input id="price" type="text" class="form-control decimal">
                        </div>
                    </div>
                </div>
                <div id="paymentLinkRow" class="row" style="display: none">
                    <hr>
                    <div class="col-xl-12">
                        <p>
                            Ödeme linki: <a id="paymentLink" href="" target="_blank"></a>
                        </p>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="AddReceiptButton">Ödeme Al</button>
            </div>
        </div>
    </div>
</div>
