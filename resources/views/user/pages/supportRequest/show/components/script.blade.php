<script>

    var CreateSupportRequestMessageButton = $('#CreateSupportRequestMessageButton');

    var timeline = $('#timeline');

    var nameSpan = $('#nameSpan');
    var descriptionSpan = $('#descriptionSpan');
    var creatorSpan = $('#creatorSpan');
    var categorySpan = $('#categorySpan');
    var prioritySpan = $('#prioritySpan');
    var createdAtSpan = $('#createdAtSpan');
    var statusSpan = $('#statusSpan');
    var filesSpan = $('#filesSpan');

    var CompleteButtons = $('#CompleteButtons');
    var ReActivateButtons = $('#ReActivateButtons');
    var CreateSupportRequestMessageForm = $('#CreateSupportRequestMessageForm');

    function getSupportRequest() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.supportRequest.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: '{{ $id }}'
            },
            success: function (response) {
                var favicon = '{{ asset('assets/media/favicon/favicon.png') }}';

                console.log(response.response)
                nameSpan.html(response.response.name);
                descriptionSpan.html(response.response.description);
                creatorSpan.html(response.response.creator.name);
                createdAtSpan.html(reformatDatetimeForHuman(response.response.created_at));
                categorySpan.html(response.response.category.name);
                prioritySpan.html(response.response.priority.name);
                statusSpan.removeClass().addClass(`label label-light-${response.response.status.color} label-inline font-weight-bolder mr-1`).html(response.response.status.name);
                timeline.empty();
                $.each(response.response.messages, function (i, message) {
                    var messageFiles = ``;
                    $.each(message.files, function (i, file) {
                        messageFiles += `<a download href="${file.path + file.name}" target="_blank" class="fa fa-file cursor-pointer mt-4 ml-2" title="${file.name}"></a>`;
                    });
                    timeline.append(`
                    <div class="timeline-item">
                        <div class="timeline-media">
                            <img alt="Pic" src="${favicon}" />
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="mr-2">
                                    <a class="text-dark-75 text-hover-primary font-weight-bold cursor-pointer">${message.creator.name}</a>
                                    <span class="text-muted ml-2">${reformatDatetimeForHuman(message.created_at)}</span>
                                </div>
                            </div>
                            <p class="p-0">${message.message}</p>
                            <hr>
                            <div class="row">
                                <div class="col-xl-12">
                                    <i class="fa fa-paperclip mr-2"></i>Ekler: ${messageFiles}
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
                var files = ``;
                $.each(response.response.files, function (i, file) {
                    files += `<a href="${file.path + file.name}" target="_blank" class="fa fa-file cursor-pointer mt-4 mr-2" title="${file.name}"></a>`;
                });
                filesSpan.html(files);
                if (response.response.status_id === 1 || response.response.status_id === 2) {
                    CompleteButtons.show();
                    CreateSupportRequestMessageForm.show();
                    ReActivateButtons.hide();

                } else {
                    CompleteButtons.hide();
                    CreateSupportRequestMessageForm.hide();
                    ReActivateButtons.show();
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Detayları Alınırken sistemsel Bir Sorun Oluştu!');
            }
        });
    }

    function save(method, data) {
        $('#loader').fadeIn(250);
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.supportRequestMessage.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                getSupportRequest();
                $('#files_create').val(null);
                $('#message_create').val('');
                $('#loader').fadeOut(250);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yanıt Oluşturulurken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').fadeOut(250);
            }
        });
    }

    function updateStatus(status_id) {
        $('#loader').fadeIn(250);
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.user.supportRequest.updateStatus') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: '{{ $id }}',
                status_id: status_id
            },
            success: function () {
                getSupportRequest();
                $('#loader').fadeOut(250);
                toastr.success('Başarıyla Güncellendi');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Durumu Güncellenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').fadeOut(250);
            }
        });
    }

    getSupportRequest();

    CreateSupportRequestMessageButton.click(function () {
        var support_request_id = '{{ $id }}';
        var creator_type = '{{ str_replace('\\', '\\\\', auth()->user()->authType()) }}';
        var creator_id = '{{ auth()->id() }}';
        var message = $('#message_create').val();
        var files = $('#files_create').val();

        if (support_request_id === '' || creator_type === '' || creator_id === '') {
            toastr.warning('Oturum Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (message == null || message === '') {
            toastr.warning('Mesaj Boş Olamaz!');
        } else {
            save('post', {
                support_request_id: support_request_id,
                creator_type: creator_type,
                creator_id: creator_id,
                message: message
            });
        }
    });

</script>
