@extends('banners::layouts.app')

@section('title', __('banners::ui.new_banner'))

@section('css-code')
    <link href="{{ asset('assets/backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
@endsection

@section('banners-content')
    {!! Form::open([
            'url' => route('backend.banners.store'),
            'method'=>'POST',
            'autocomplete'=>'off',
            'enctype' => 'multipart/form-data',
            'class'=>'form-horizontal form-label-left'
        ]) !!}
    @include('banners::banners.fields')
    {!! Form::close() !!}
@endsection

@section('js-code')
    <script src="{{ asset('assets/backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            format        : 'dd.mm.yyyy',
            todayHighlight: true,
            autoclose     : true
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if ($(e.target).attr('id') === 'code-tab') {
                $('#field_type').val(1);
                $('#code-banner').removeClass('hide').addClass('show');
                $('#images-banner').removeClass('show').addClass('hide');
            } else {
                $('#field_type').val(0);
                $('#code-banner').removeClass('show').addClass('hide');
                $('#images-banner').removeClass('hide').addClass('show');
            }
        })

        $(".import-file").dropzone({
            url      : '{{ route('backend.banners.upload') }}',
            sending  : function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("banner", "{{ isset($banner) ? $banner->id : 0 }}");
            },
            addedfile: function (file) {
                //console.log(file);
            },
            success  : function (file, res) {
                //console.log(res);
                $('#image_ext').val(res.ext);
                $('#image_tmp').val(0);
                if (res.file_id === 0) {
                    $('#image_tmp').val(1);
                }
                getImagesBanners();
            },
            error    : function (error) {
                console.log(error);
            }
        });

        function getImagesBanners() {
            var ext = $('#image_ext').val();
            $.ajax({
                url     : '{{ route('backend.banners.images') }}',
                type    : 'GET',
                data    : {
                    id : '{{ isset($banner) ? $banner->id : 0 }}',
                    ext: ext,
                },
                dataType: 'json',
                success : function (res) {
                    $("[data-files]").html(res.files);
                }
            });
        }

        getImagesBanners();
    </script>
@endsection
