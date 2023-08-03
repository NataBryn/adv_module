<tr>
    <td>{!! Form::checkbox('campaigns[]',$campaign->id,false,['class'=>'']) !!}</td>
    <td><a href="{{ route('backend.campaigns.edit', $campaign) }}">{{ $campaign->name }}</a></td>
    <td>{{ isset($campaign->banners) ? count($campaign->banners) : 0 }}</td>
    <td>{{ $campaign->count_views }}</td>
    <td>{{ $campaign->count_clicks }}</td>
    <td>{!! \Modules\Banners\Entities\Campaign::getStatusBadge($campaign->active) !!}</td>
    <td>@if($campaign->date_start != null)
        {{ \Jenssegers\Date\Date::parse($campaign->date_start)->locale('uk')->format('j M Y') }}
        @endif
    </td>
    <td>@if($campaign->date_finish != null)
        {{ \Jenssegers\Date\Date::parse($campaign->date_finish)->locale('uk')->format('j M Y') }}
        @endif
    </td>
    <td>
        <button class="btn btn-link" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu text-left">
            <a href="{{ route('backend.campaigns.edit', $campaign) }}" class="dropdown-item">
                <span class="fa fa-edit"></span>
                @lang('banners::ui.edit')
            </a>
            <a href="{{ route('backend.campaigns.destroy', $campaign) }}" data-method="delete"
               data-token="{{csrf_token()}}"
               data-confirm="@lang('banners::ui.delete_question')" class="dropdown-item text-danger">
                <span class="fa fa-trash"></span>
                @lang('banners::ui.delete')
            </a>
        </div>
    </td>
</tr>
