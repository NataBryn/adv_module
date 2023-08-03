<?php

    namespace Modules\Banners\Http\Controllers;

    use App\Models\Page;
    use Carbon\Carbon;
    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Storage;
    use Modules\Banners\Entities\Banner;
    use Modules\Banners\Entities\BannerPage;
    use Modules\Banners\Entities\Campaign;
    use Modules\Banners\Entities\File;
    use Modules\Banners\Entities\Region;
    use Modules\Banners\Entities\Size;
    use Modules\Banners\Http\Requests\BannersRequest;

    class BannersController extends Controller
    {
        /**
         * Display a listing of the resource.
         * @return Renderable
         */
        public function index()
        {
            return view('banners::index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param Request $request
         *
         * @return Renderable
         */
        public function create(Request $request)
        {
            $sizes      = Size::all()->pluck('name', 'id');
            $regions    = Region::all()->pluck('name', 'id');
            $priorities = collect(range(1, 10))->combine(range(1, 10));
            $pages      = Page::select('id', 'name')->get();
            $step_pages = round(count($pages) / 4);

            return view('banners::banners.create', [
                'campaign'   => $request->campaign,
                'sizes'      => $sizes,
                'regions'    => $regions,
                'priorities' => $priorities,
                'pages'      => $pages,
                'step_pages' => $step_pages,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param BannersRequest $request
         *
         * @return RedirectResponse
         */
        public function store(BannersRequest $request)
        {
            $categories           = $request->categories;
            $data                 = $request->except('_token', 'image_tmp', 'image_ext', 'categories');
            $data['type']         = isset($request->type) ? $request->type : Banner::TYPE_IMAGE;
            $data['date_start']   = Carbon::parse($request->date_start)->startOfDay()->toDateTimeString();
            $data['date_finish']  = Carbon::parse($request->date_finish)->endOfDay()->toDateTimeString();
            $data['limit_clicks'] = isset($request->limit_clicks) ? $request->limit_clicks : 0;
            $data['limit_views']  = isset($request->limit_views) ? $request->limit_views : 0;
            $banner               = Banner::firstOrCreate($data);

            if ($categories) {
                BannerPage::where('banner_id', $banner->id)->delete();
                foreach ($categories as $category => $val) {
                    BannerPage::create(['banner_id' => $banner->id, 'page_id' => $category]);
                }
            }
            if ($request->all_categories) {
                $banner->all_categories = 1;
            } else {
                $banner->all_categories = 0;
            }
            $banner->save();

            $campaign   = Campaign::find($banner->campaign_id);
            $min_banner = $campaign->bannersActive()->orderBy('date_start', 'ASC')->first();
            $max_banner = $campaign->bannersActive()->orderBy('date_finish', 'DESC')->first();
            $campaign->update([
                'date_start'  => isset($min_banner->date_start) ? $min_banner->date_start : null,
                'date_finish' => isset($max_banner->date_finish) ? $max_banner->date_finish : null,
            ]);

            if ($request->image_tmp) {
                $file_name = 'image_' . $banner->id . '.' . $request->image_ext;
                $file_tmp  = Storage::disk('public')->path('banners/image_tmp.' . $request->image_ext);
                Storage::disk('public')->putFileAs('banners', $file_tmp, $file_name);
                $data['banner_id'] = $banner->id;
                $data['filename']  = $file_name;
                $file              = File::create($data);
            }
            return redirect()->route('backend.campaigns.edit', $request->campaign_id)
                ->with('success', __('banners::ui.banner_added'));
        }

        /**
         * Show the specified resource.
         *
         * @param int $id
         *
         * @return Renderable
         */
        public function show($id)
        {
            return view('banners::show');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         *
         * @return Renderable
         */
        public function edit($id)
        {
            $banner     = Banner::with(['campaign', 'pages'])->findOrFail($id);
            $files      = File::with(['banner'])->where('banner_id', $banner->id)->get();
            $sizes      = Size::all()->pluck('name', 'id');
            $regions    = Region::all()->pluck('name', 'id');
            $priorities = collect(range(1, 10))->combine(range(1, 10));
            $categories = $banner->pages->pluck('page_id')->toArray();
            $pages      = Page::select('id', 'name')->get();
            $step_pages = round(count($pages) / 4);

            return view('banners::banners.edit', [
                'banner'     => $banner,
                'files'      => $files,
                'campaign'   => $banner->campaign->id,
                'sizes'      => $sizes,
                'regions'    => $regions,
                'priorities' => $priorities,
                'categories' => $categories,
                'pages'      => $pages,
                'step_pages' => $step_pages,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param BannersRequest $request
         * @param int            $banner
         *
         * @return RedirectResponse
         */
        public function update(BannersRequest $request, $banner)
        {
            $banner = Banner::findOrFail($banner);

            BannerPage::where('banner_id', $banner->id)->delete();
            if ($request->categories) {
                foreach ($request->categories as $category => $val) {
                    BannerPage::create(['banner_id' => $banner->id, 'page_id' => $category]);
                }
            }
            if ($request->all_categories) {
                $banner->all_categories = 1;
            } else {
                $banner->all_categories = 0;
            }
            $banner->save();

            $data                 = $request->except('_token', 'image_tmp', 'image_ext', 'categories');
            $data['active']       = isset($request->active) ? $request->active : false;
            $data['date_start']   = Carbon::parse($request->date_start)->startOfDay()->toDateTimeString();
            $data['date_finish']  = Carbon::parse($request->date_finish)->endOfDay()->toDateTimeString();
            $data['type']         = isset($request->type) ? $request->type : Banner::TYPE_IMAGE;
            $data['limit_clicks'] = isset($request->limit_clicks) ? $request->limit_clicks : 0;
            $data['limit_views']  = isset($request->limit_views) ? $request->limit_views : 0;
            $banner->fill($data);
            $banner->save();

            $campaign   = Campaign::find($banner->campaign_id);
            $min_banner = $campaign->bannersActive()->orderBy('date_start', 'ASC')->first();
            $max_banner = $campaign->bannersActive()->orderBy('date_finish', 'DESC')->first();
            $campaign->update([
                'date_start'  => isset($min_banner->date_start) ? $min_banner->date_start : null,
                'date_finish' => isset($max_banner->date_finish) ? $max_banner->date_finish : null,
            ]);

            return redirect()->route('backend.banners.edit', $banner)
                ->with('success', __('banners::ui.banner_updated'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $banner
         *
         * @return RedirectResponse
         */
        public function destroy($banner)
        {
            $banner = Banner::findOrFail($banner);
            Banner::destroy($banner->id);
            return redirect()->route('backend.campaigns.edit', $banner->campaign_id)
                ->with('success', __('banners::ui.banner_deleted'));
        }

        /**
         * @param Request $request
         *
         * @return JsonResponse
         */
        public function upload(Request $request)
        {
            $ext = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array(strtolower($request->file->getClientOriginalExtension()), $ext)) {
                $ext = $request->file->getClientOriginalExtension();
                if (isset($request->banner) && $request->banner > 0) {
                    $file_name         = 'image_' . $request->banner . '.' . $ext;
                    $data['banner_id'] = $request->banner;
                    $data['filename']  = $file_name;
                    $file              = File::firstOrCreate($data);
                } else {
                    $file_name = 'image_tmp.' . $ext;
                }

                if (!Storage::disk('public')->exists('banners')) {
                    Storage::disk('public')->makeDirectory('banners');
                }
                Storage::disk('public')->putFileAs('banners', $request->file, $file_name);
                return response()->json(['status' => true, 'file_id' => isset($file) ? $file->id : 0, 'ext' => $ext]);
            }
            return response()->json(['status' => false]);
        }

        /**
         * @param Request $request
         *
         * @return JsonResponse
         * @throws \Throwable
         */
        public function images(Request $request)
        {
            $res = '';
            if (isset($request->ext)) {
                $file = 'image_tmp.' . $request->ext;
                $path = 'banners/' . $file;
                if (Storage::disk('public')->exists($path)) {
                    $res .= view('banners::banners.file', ['file' => $file])->render();
                }
            } else {
                $files = File::where('banner_id', $request->id)->latest()->get();
                foreach ($files as $file) {
                    $path = 'banners/' . $file->filename;
                    if (Storage::disk('public')->exists($path)) {
                        $res .= view('banners::banners.file', ['file' => $file->filename])->render();
                    }
                }
            }
            return response()->json(['files' => !empty($res) ? $res : __('banners::ui.banners_no_images')]);
        }

        /**
         * @param Request $request
         *
         * @return JsonResponse
         * @throws \Throwable
         */
        public function imagesDelete(Request $request)
        {
            $files = File::where('banner_id', $request->id)->latest()->get();
            foreach ($files as $file) {
                File::find($file->id)->delete();
                $path = 'banners/' . $file->filename;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            return response()->json(['delete' => count($files) > 0]);
        }

        public function click(Request $request)
        {
            if (isset($request->id)) {
                Banner::find($request->id)->increment('clicks');
            }
        }

    }
