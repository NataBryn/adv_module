<?php

    namespace Modules\Banners\Services;

    use App\Services\SeoPageService;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;

    class Banner
    {
        protected $mobile = false;
        protected $tablet = false;

        protected $region_id = 1;

        /**
         * @param       $alias
         * @param       $page
         *
         * @return mixed
         */
        public function get($alias = null, $page = null)
        {
            if (isset($alias)) {
                $banner = \Modules\Banners\Entities\Banner::onlyActive()
                    ->with('file')
                    ->whereHas('size', function (Builder $query) use ($alias) {
                        $query->where('alias', $alias);
                    })
                    ->where('date_start', '<=', Carbon::now()->toDateTimeString())
                    ->where('date_finish', '>=', Carbon::now()->toDateTimeString())
                    ->where(function ($query) {
                        $query->whereRaw('limit_views > views OR limit_views = 0');
                    })
                    ->where(function ($query) {
                        $query->whereRaw('limit_clicks > clicks OR limit_clicks = 0');
                    })
                    ->where(function ($query) use ($page) {
                        $query->whereHas('pages', function (Builder $query) use ($page) {
                            $query->where('page_id', isset($page->id) ? $page->id : null);
                        })->orWhere('all_categories', true);
                    });

                if ($this->mobile) {
                    $banner->where('hide_mobile', 0);
                }
                if ($this->tablet) {
                    $banner->where('hide_tablets', 0);
                }
                if ($this->region_id > 0) {
                    $banner->where('region_id', $this->region_id);
                }
                $banner = $banner->orderBy('priority', 'desc')->orderBy('views', 'asc')->first();

                if ($banner) {
                    $altName = $this->getSeoName($page);
                    $banner->increment('views');
                    if ($banner->type == \Modules\Banners\Entities\Banner::TYPE_CODE) {
                        return '<div onclick="$.ajax({url:\'' . route('images.click') . '?id=' . $banner->id . '\',});">' . $banner->code . '</div>';
                    } else {
                        return '<a href="' . $banner->target_url . '" target="_blank" onclick="$.ajax({url:\'' . route('images.click') . '?id=' . $banner->id . '\',});"><img src="' . asset('/storage/banners/' .
                                $banner->file->filename) .
                            '?' . time() . '" alt="' . __("frontend.image.alt", ["name" => $altName, "id" => $banner->file->id]) . '" title="' . __("frontend.image.title", ["name" => $altName, "id" => $banner->file->id]) . '"></a>';
                    }
                }
            }
            return '';
        }

        protected function getSeoName($page = null){
            if(isset($page)){
                $seoService = new SeoPageService();
                $seoService->setModel($page);
                return $seoService->getH1();
            } else {
                return '';
            }
        }
    }
