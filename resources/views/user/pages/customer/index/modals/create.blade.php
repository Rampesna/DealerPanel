<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Müşteri Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="CreateForm" class="modal-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="dealer_id_create">Bayi Bağlantısı</label>
                            <select id="dealer_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label for="tax_number_create">Vergi Numarası</label>
                            <input id="tax_number_create" type="text" class="form-control onlyNumber" maxlength="11">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="name_create">Müşteri Ünvanı</label>
                            <input id="name_create" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="email_create">E-posta Adresi</label>
                            <input id="email_create" type="text" class="form-control emailMask">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="gsm_create">Telefon(GSM) Numarası</label>
                            <input id="gsm_create" type="text" class="form-control gsmMask">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="tax_office_create">Vergi Dairesi</label>
                            <input id="tax_office_create" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="website_create">Website Adresi</label>
                            <input id="website_create" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="foundation_date_create">Firma Kuruluş Tarihi</label>
                            <input id="foundation_date_create" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="country_id_create">Ülke</label>
                            <select id="country_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="province_id_create">Şehir</label>
                            <select id="province_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="district_id_create">İlçe</label>
                            <select id="district_id_create" class="form-control selectpicker" data-live-search="true">

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="divisor_create">Katsayı Böleni</label>
                            <input id="divisor_create" type="number" class="form-control">
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
