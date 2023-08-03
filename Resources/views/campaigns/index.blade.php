@extends('banners::layouts.app')

@section('title', __('banners::ui.campaigns'))

@section('banners-content')
    <div class="row">
        <div class="col-6 col-lg-2">
            <p>
                <a href="{{ route('backend.campaigns.create') }}" class="btn btn-block btn-sm btn-success text-uppercase">
                    <i class="fa fa-plus"></i>
                    @lang('banners::ui.add_campaign')
                </a>
            </p>
        </div>
        <div class="col-6 col-md-8 col-lg-10 text-right">
            {!! Form::open(['method'=>'get','class'=>'form-inline']) !!}
            <div class="form-group mr-2">
                {!! Form::text('q',request('q'),['class'=>'form-control form-control-sm','placeholder'=>__('banners::ui.request_search')]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit(__('banners::ui.search'),['class'=>'btn btn-sm btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                    <tr>
                        <td width="1%"></td>
                        <td>@lang('banners::ui.name_campaign')</td>
                        <td>@lang('banners::ui.count_banners')</td>
                        <td width="5%">@lang('banners::ui.views')</td>
                        <td width="5%">@lang('banners::ui.clicks')</td>
                        <td width="5%">@lang('banners::ui.status')</td>
                        <td width="10%">@lang('banners::ui.start')</td>
                        <td width="10%">@lang('banners::ui.finish')</td>
                        <td width="1%"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($campaigns)>0)
                        @each('banners::campaigns.row',$campaigns,'campaign')
                    @else
                        <tr>
                            <td colspan="9">@lang('banners::ui.not_found')</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            {!! $campaigns->appends(request()->except('page'))->render() !!}
        </div>
    </div>
@endsection
