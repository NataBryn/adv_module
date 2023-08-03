<tr>
    <td>{!! Form::checkbox('banners[]',$banner->id,false,['class'=>'']) !!}</td>
    <td><a href="{{ route('backend.banners.edit', $banner) }}">{{ $banner->name }}</a></td>
    <td>{{ $banner->size->name }}</td>
    <td>{!! \Modules\Banners\Entities\Banner::getTypeBadge($banner->type) !!}</td>
    <td>{{ ($banner->views > 0) ? round(($banner->clicks / $banner->views) * 100, 2) : 0 }}</td>
    <td>{{ $banner->views }}</td>
    <td>{{ $banner->clicks }}</td>
    <td>{!! \Modules\Banners\Entities\Banner::getStatusBadge($banner->active) !!}</td>
    <td>
        <button class="btn btn-link" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu text-left">
            <a href="{{ route('backend.banners.edit', $banner) }}" class="dropdown-item">
                <span class="fa fa-edit"></span>
                @lang('banners::ui.edit')
            </a>
            <a href="{{ route('backend.banners.destroy', $banner) }}" data-method="delete"
               data-token="{{csrf_token()}}"
               data-confirm="@lang('banners::ui.delete_question')" class="dropdown-item text-danger">
                <span class="fa fa-trash"></span>
                @lang('banners::ui.delete')
            </a>
        </div>
    </td>
</tr>
