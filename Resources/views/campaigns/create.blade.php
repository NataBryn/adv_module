@extends('banners::layouts.app')

@section('title', __('banners::ui.new_campaign'))

@section('banners-content')
    {{ Form::open(['url' => route('backend.campaigns.store'), 'method' => 'POST', 'class' => 'validate', "novalidate" => 'novalidate',  'enctype' => 'multipart/form-data']) }}
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
            <p></p>
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
                                            {{ Form::checkbox('active', 1, 1, ['class' => 'form-control']) }}
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
@endsection
