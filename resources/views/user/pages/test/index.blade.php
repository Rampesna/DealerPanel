@extends('user.layouts.master')
@section('title', 'Test Sayfası')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

<<<<<<< Updated upstream
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <form id="testForm" method="post" action="{{ route('user.test.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="excel_file">Dosya Seçin</label>
                                    <input id="excel_file" type="file" name="excel_file" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Yükle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
=======

>>>>>>> Stashed changes

@endsection

@section('page-styles')

@stop

@section('page-script')
    <script>

<<<<<<< Updated upstream

=======
        function getOpportunities() {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.user.opportunity.test') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    test1: 1,
                    test2: 2
                },
                success: function (response) {
                    console.log(response)
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Sistem Arızası');
                }
            });
        }

        getOpportunities();
>>>>>>> Stashed changes

    </script>
@stop
