<div class="row">
    <div class="col-12 col-lg-12">
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger fade show in">
                <span class="close" data-dismiss="alert">×</span>
                <p class="m-b-0 m-t-5">
                    <i class="fa fa-times-circle fa-2x pull-left m-r-10"></i>
                    <strong>@lang('banners::ui.error_title')</strong>
                    @foreach ($errors->all() as $error) {{ '' . $error . ' ' }} @endforeach
                </p>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success fade show in">
                <span class="close" data-dismiss="alert">×</span>
                <p class="m-b-0 m-t-5">
                    <i class="fa fa-check fa-2x pull-left m-r-10"></i>
                    <strong>{{ session('success.title') ?? __('banners::ui.success_title') }}</strong>
                    {{ session('success') }}
                </p>
            </div>
        @endif
        <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title js_message"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" id="confirmBtnNo">@lang('banners::ui.no')</button>
                        <button type="button" class="btn btn-info" id="confirmBtnYes">@lang('banners::ui.yes')</button>
                    </div>
                </div>
            </div>
        </div>
        @if (session('danger'))
            <div class="alert alert-danger fade show in">
                <span class="close" data-dismiss="alert">×</span>
                <p class="m-b-0 m-t-5">
                    <i class="fa fa-exclamation-triangle fa-2x pull-left m-r-10"></i>
                    <strong>{{ session('danger.title') ?? __('banners::ui.error_title') }}</strong>
                    {{ session('danger') }}
                </p>
            </div>
        @endif
    </div>
</div>

