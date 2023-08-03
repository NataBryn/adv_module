{{ Form::hidden('campaign_id', $campaign) }}
{{ Form::hidden('type', 0, ['id' => 'field_type']) }}
{{ Form::hidden('image_tmp', 0, ['id' => 'image_tmp']) }}
{{ Form::hidden('image_ext', 0, ['id' => 'image_ext']) }}
<div class="row">
    <div class="col-6 col-md-8 col-lg-10">
        <p>
            <a href="{{ route('backend.campaigns.edit', $campaign) }}" class="btn btn-dark btn-sm pull-right">
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
            <div class="col-6 col-xl-6">
                {{-- left panel--}}
                <label>
                    <h4><b>@lang('banners::ui.settings_banner')</b></h4>
                </label>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.name_banner')*</b></label>
                                    {!! Form::text('name', (isset($banner)) ? $banner->name : null,['id'=>'name', 'class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.active')</b></label>
                                    <label class="checkbox-container">
                                        {{ Form::checkbox('active', 1, (isset($banner) ? ($banner->active == true ? 1 : 0) : 1), ['class' => 'form-control']) }}
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <label><b>@lang('banners::ui.position')</b></label>
                        <div class="row">
                            @for($i=0;$i<4;$i++)
                                <div class="col-3">
                                    <div class="form-group">
                                        @if($i == 0)
                                            <div class="nav-item mb-2">
                                                {{ Form::checkbox('all_categories', 1, (isset($banner) ? ($banner->all_categories == true ? 1 : 0) : 1), ['class' => 'checkbox']) }}
                                                <b> Усі розділи</b>
                                            </div>
                                        @endif
                                        @for($p=$step_pages*$i;$p<($step_pages*$i)+$step_pages;$p++)
                                            @if($p < count($pages))
                                                <div class="nav-item mb-2">
                                                    {{ Form::checkbox('categories['.$pages[$p]['id'].']', 1, (isset($categories) && in_array($pages[$p]['id'], $categories)) ? 1 : 0, ['class' => 'checkbox']) }}
                                                    <b> {{ $pages[$p]['name'] }}</b>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.size_banner')*</b></label>
                                    {!! Form::select('size_id', $sizes, (isset($banner) ? $banner->size_id : null),['id'=>'size_id', 'class'=>($errors->has('size_id')) ? 'form-control is-invalid' : 'form-control', 'placeholder'=>__('banners::ui.select'), 'required']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.priority_banner')</b></label>
                                    {!! Form::select('priority', $priorities, (isset($banner) ? $banner->priority : 1),['id'=>'priority', 'class'=>($errors->has('priority')) ? 'form-control is-invalid' : 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.date_start_banner')*</b></label>
                                    {!! Form::text('date_start', (isset($banner)) ? \Carbon\Carbon::parse($banner->date_start)->format('d.m.Y') : null,['id'=>'date_start', 'class'=>'datepicker form-control', 'placeholder'=> 'дд.мм.рррр', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.date_finish_banner')*</b></label>
                                    {!! Form::text('date_finish', (isset($banner)) ? \Carbon\Carbon::parse($banner->date_finish)->format('d.m.Y') : null,['id'=>'date_finish', 'class'=>'datepicker form-control', 'placeholder'=> 'дд.мм.рррр', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.region_banner')</b></label>
                                    {!! Form::select('region_id', $regions, (isset($banner) ? $banner->region_id : 1),['id'=>'region_id', 'class'=>($errors->has('region_id')) ? 'form-control is-invalid' : 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="title"></label>
                                <div class="form-group">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item mb-2">
                                            {{ Form::checkbox('hide_mobile', 1, isset($banner) ? $banner->hide_mobile : 0, ['class' => 'checkbox']) }}
                                            <b> @lang('banners::ui.hide_mobile')</b>
                                        </li>
                                        <li class="nav-item mb-2">
                                            {{ Form::checkbox('hide_tablets', 1, isset($banner) ? $banner->hide_tablets : 0, ['class' => 'checkbox']) }}
                                            <b> @lang('banners::ui.hide_tablets')</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.stop_limit_clicks')</b></label>
                                    {!! Form::number('limit_clicks', (isset($banner)) ? $banner->limit_clicks : null,['id'=>'limit_clicks', 'class'=>($errors->has('limit_clicks')) ? 'form-control is-invalid' : 'form-control', 'min' => 0, 'step' => 1]) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.stop_limit_views')</b></label>
                                    {!! Form::number('limit_views', (isset($banner)) ? $banner->limit_views : null,['id'=>'limit_views', 'class'=>($errors->has('limit_views')) ? 'form-control is-invalid' : 'form-control', 'min' => 0, 'step' => 1]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-danger mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tech"><b>@lang('banners::ui.description')</b></label>
                                    {!! Form::textarea('description', (isset($banner)) ? $banner->description : null,['id'=>'description', 'class'=>'form-control', 'rows' => 5]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- END left panel--}}
            </div>
            <div class="col-4 col-xl-4">
                {{-- right panel--}}
                <label>
                    <h4><b>@lang('banners::ui.banner')</b></h4>
                </label>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tech"><b>@lang('banners::ui.preview_banner')</b></label>
                                    <div class="row pl-3 pr-3">
                                        <div class="card mb-2 col-12 p-0">
                                            <div class="card-body p-0">
                                                @if(isset($banner))
                                                    <div id="images-banner" data-files class="toast @if($banner->type == true) hide @else show @endif"></div>
                                                    <div id="code-banner" class="toast  @if($banner->type == false) hide @else show @endif">{!! $banner->code !!}</div>
                                                @else
                                                    <div id="images-banner" data-files class="toast show"></div>
                                                    <div id="code-banner" class="toast hide"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tech"><b>@lang('banners::ui.content_banner')*</b></label>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item @if(isset($banner) && $banner->type == true) active @endif">
                                            <a class="nav-link @if(isset($banner) && $banner->type == true) active @endif" id="code-tab" data-toggle="tab" href="#code" data-tab="#code" role="tab" aria-controls="code"
                                               aria-selected="true">Code </a>
                                        </li>
                                        <li class="nav-item @if(isset($banner) && $banner->type == false) active @endif">
                                            <a class="nav-link @if(isset($banner) && $banner->type == false) active @endif" id="image-tab" data-toggle="tab" href="#image" data-tab="#image" role="tab"
                                               aria-controls="profile" aria-selected="false">Image / GIF </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in @if(isset($banner) && $banner->type == true) active show @endif" id="code" role="tabpanel" aria-labelledby="code-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        {!! Form::textarea('code', (isset($banner)) ? $banner->code : null,['id'=>'code', 'class'=>'form-control', 'rows' => 10]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade in @if(isset($banner) && $banner->type == false) active show @endif" id="image" role="tabpanel" aria-labelledby="code-tab">
                                            <div class="row pl-3 pr-3">
                                                <div class="card mb-2 col-12">
                                                    <div class="card-body">
                                                        <button id="import-file" type="button" class="btn btn-primary btn-sm pull-right import-file">
                                                            <i class="fa fa-download import-file"></i>
                                                            <b class="import-file">@lang('banners::ui.download_banner')</b>
                                                        </button>
                                                        <button id="delete-file" type="button" class="btn btn-sm pull-right btn-danger"><span class="fa fa-trash"></span>@lang('banners::ui.delete_banner')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title"><b>@lang('banners::ui.target_url')*</b></label>
                                    {!! Form::text('target_url', (isset($banner)) ? $banner->target_url : null,['id'=>'target_url', 'class'=>'form-control', 'placeholder'=> 'https://', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- END right panel--}}
            </div>
        </div>
    </div>
</div>

