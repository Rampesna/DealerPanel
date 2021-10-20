<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="dealer_id_edit">Bayi Bağlantısı</label>
                            <select id="dealer_id_edit" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_number_edit">Vergi Numarası</label>
                            <input id="tax_number_edit" type="text" class="form-control onlyNumber" maxlength="11">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="name_edit">Müşteri Ünvanı</label>
                            <input id="name_edit" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="email_edit">E-posta Adresi</label>
                            <input id="email_edit" type="text" class="form-control emailMask">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="gsm_edit">Telefon(GSM) Numarası</label>
                            <input id="gsm_edit" type="text" class="form-control gsmMask">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="tax_office_edit">Vergi Dairesi</label>
                            <input id="tax_office_edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="website_edit">Website Adresi</label>
                            <input id="website_edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="foundation_date_edit">Firma Kuruluş Tarihi</label>
                            <input id="foundation_date_edit" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="country_id_edit">Ülke</label>
                            <select id="country_id_edit" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="province_id_edit">Şehir</label>
                            <select id="province_id_edit" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="district_id_edit">İlçe</label>
                            <select id="district_id_edit" class="form-control selectpicker" data-live-search="true">

                            </select>
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
