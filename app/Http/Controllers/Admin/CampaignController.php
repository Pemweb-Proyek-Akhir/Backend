<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Http\Controllers\Controller;
use App\Models\BannerCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Package;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('banners')->get();
        return view('admin.campaign.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaign.create');
    }

    public function store(Request $request)
    {
        $newId = Campaign::max('id') + 1;

        try {
            DB::beginTransaction();

            $campaign = new Campaign;
            $campaign->id = $newId;
            $campaign->name = $request->input('name');
            $campaign->description = $request->input('description');
            $campaign->target = $request->input('target');
            $campaign->status = $request->input('status');
            $campaign->current = $request->input('current');
            $campaign->save();

            $packages = Package::all();
            $campaign->packages()->attach($packages);

            DB::commit();

            return redirect()->route('admin.campaign.index')->with('success', 'Campaign and Banners added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error occurred while adding Campaign and Banners');
        }
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $packages = Package::all();

        return view('admin.campaign.edit', compact('campaign', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'target' => 'required',
            'status' => 'required',
            'current' => 'required',
        ]);

        $campaign = Campaign::findOrFail($id);
        $campaign->update($validatedData);

        // Update banner
        $bannerUrls = $request->input('banner_urls');

        if ($bannerUrls) {
            $bannerIds = $campaign->banners->pluck('id');

            foreach ($bannerUrls as $index => $bannerUrl) {
                $bannerId = $bannerIds[$index] ?? null;

                if ($bannerId) {
                    $banner = BannerCampaign::findOrFail($bannerId);
                    $banner->url = $bannerUrl;
                    $banner->save();
                } else {
                    $newBanner = new BannerCampaign;
                    $newBanner->campaign_id = $campaign->id;
                    $newBanner->url = $bannerUrl;
                    $newBanner->save();
                }
            }
        }

        // Update packages
        $packages = $request->input('packages');
        $campaign->packages()->sync($packages);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign berhasil diperbarui');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);

        // Hapus banner terkait campaign
        $campaign->banners()->delete();

        // Hapus campaign
        $campaign->delete();

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign berhasil dihapus');
    }
}
