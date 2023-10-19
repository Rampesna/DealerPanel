<div class="modal fade" id="UpdateStatusModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Durum Güncelle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <label for="update_status_status_id">Durum</label>
                        <select id="update_status_status_id" class="form-control selectpicker" data-live-search="true">
                            <option value="0">Yeni</option>
                            <option value="1">Müşteriye Ulaşılamadı</option>
                            <option value="2">Yetkili Dönecek</option>
                            <option value="3">Mali Mühür/Eimza Yok</option>
                            <option value="4">İletişim Bilgisi Hatalı</option>
                            <option value="5">Müşteri Oluşturuldu</option>
                            <option value="6">Aktivasyon Alındı</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn btn-success" id="UpdateStatusButton">Güncelle</button>
            </div>
        </div>
    </div>
</div>
