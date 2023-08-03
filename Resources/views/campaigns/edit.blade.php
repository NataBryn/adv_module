@extends('banners::layouts.app')

@section('title', __('banners::ui.campaign'))

@section('banners-content')
    {{ Form::open(['url' => route('backend.campaigns.update', ['campaign'=> $campaign]), 'method'=>'PUT', 'autocomplete'=>'off']) }}
    <div class="row">
        <div class="col-6 col-md-8 col-lg-10">
            <p>
                <a href="{{ route('backend.campaigns.index') }}" class="btn btn-dark btn-sm pull-right">
                    <i class="fa fa-reply"></i>
                    @lang('banners::ui.back')
                </a>
                <button type="submit" class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-save"></i>
                    <b>@lang('banners::ui.save')</b>
                </button>
            </p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p>
                <a href="{{ route('backend.banners.create', ['campaign' => $campaign]) }}" class="btn btn-block btn-sm btn-success text-uppercase"><i class="fa fa-plus"></i>
                    @lang('banners::ui.add_banner')
                </a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="title"><b>@lang('banners::ui.name_campaign')</b></label>
                                        {!! Form::text('name', (isset($campaign)) ? $campaign->name : null,['id'=>'name', 'class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="title"><b>@lang('banners::ui.contact_person')</b></label>
                                        {!! Form::text('contact_person', (isset($campaign)) ? $campaign->contact_person : null,['id'=>'contact_person', 'class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="title"><b>@lang('banners::ui.phone')</b></label>
                                        {!! Form::text('phone', (isset($campaign)) ? $campaign->phone : null,['id'=>'phone', 'class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="title"><b>@lang('banners::ui.email')</b></label>
                                        {!! Form::text('email', (isset($campaign)) ? $campaign->email : null,['id'=>'email', 'class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="title"><b>@lang('banners::ui.active')</b></label>
                                        <label class="checkbox-container">
                                            {{ Form::checkbox('active', 1, $campaign->active, ['class' => 'form-control']) }}
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                    <tr>
                        <td width="1%"></td>
                        <td width="20%">@lang('banners::ui.banner')</td>
                        <td width="15%">@lang('banners::ui.size_banner')</td>
                        <td width="15%">@lang('banners::ui.type_banner')</td>
                        <td width="10%">@lang('banners::ui.ctr_banner')</td>
                        <td width="10%">@lang('banners::ui.views')</td>
                        <td width="10%">@lang('banners::ui.clicks')</td>
                        <td width="15%">@lang('banners::ui.status')</td>
                        <td width="1%"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($banners)>0)
                        @each('banners::campaigns.row_banners',$banners,'banner')
                    @else
                        <tr>
                            <td colspan="9">@lang('banners::ui.not_found')</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            {!! $banners->render() !!}
        </div>
    </div>
@endsection
