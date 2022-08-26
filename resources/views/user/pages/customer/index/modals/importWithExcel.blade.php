<div class="modal fade" id="ImportWithExcelModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excel İle Müşteri Aktar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="ImportWithExcelForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="form-group">
                            <label for="import_with_excel_file">Dosyayı Seçin</label>
                            <input type="file" id="import_with_excel_file">
                        </div>
                    </div>
                    <div class="col-xl-4 text-right">
                        <a href="{{ asset('documents/customerImport.xlsx') }}" class="btn btn-sm btn-primary" download>Şablonu İndir</a>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="ImportWithExcelButton">İçe Aktar</button>
            </div>
        </div>
    </div>
</div>
