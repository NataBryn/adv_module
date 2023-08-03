<?php

    namespace Modules\Banners\Http\Controllers;

    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Modules\Banners\Entities\Banner;
    use Modules\Banners\Entities\Campaign;
    use Modules\Banners\Http\Requests\CampaignsRequest;

    class CampaignsController extends Controller
    {
        /**
         * Display a listing of the resource.
         * @return Renderable
         */
        public function index()
        {
            $campaigns = Campaign::with(['banners'])
                ->latest()->paginate(config('banners.pagination.limit'));
            return view('banners::campaigns.index', [
                'campaigns' => $campaigns,
            ]);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            return view('banners::campaigns.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param CampaignsRequest $request
         *
         * @return RedirectResponse
         */
        public function store(CampaignsRequest $request)
        {
            Campaign::firstOrCreate($request->except('_token'));
            return redirect()->route('backend.campaigns.index')
                ->with('success', __('banners::ui.campaign_added'));
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
            $campaign = Campaign::with(['banners'])->findOrFail($id);
            $banners = Banner::latest()
                ->where('campaign_id', $campaign->id)
                ->paginate(config('banners.pagination.limit'));
            return view('banners::campaigns.edit', [
                'campaign' => $campaign,
                'banners'  => $banners,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param CampaignsRequest $request
         * @param int              $campaign
         *
         * @return RedirectResponse
         */
        public function update(CampaignsRequest $request, $campaign)
        {
            $campaign       = Campaign::findOrFail($campaign);
            $data           = $request->except('_token');
            $data['active'] = isset($request->active) ? $request->active : false;
            $campaign->fill($data);
            $campaign->save();

            return redirect()->route('backend.campaigns.edit', $campaign)
                ->with('success', __('banners::ui.campaign_updated'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $campaign
         *
         * @return RedirectResponse
         */
        public function destroy($campaign)
        {
            Campaign::destroy($campaign);
            return redirect()->route('backend.campaigns.index')
                ->with('success', __('banners::ui.campaign_deleted'));
        }
    }
