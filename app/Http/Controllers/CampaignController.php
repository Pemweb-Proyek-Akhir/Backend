<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\BannerCampaign;
use App\Models\Campaign;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newId = Campaign::max('id') + 1;

        try {
            $validated = $this->validate($request, [
                "name" => "required",
                "description" => "required",
                "target" => "required|integer",
                'banner.*' => 'image|mimes:jpeg,png,jpg,gif',
            ]);


            DB::beginTransaction();

            $campaign = Campaign::create([
                "name" => $validated['name'],
                "description" => $validated['description'],
                "target" => $validated['target'],
            ]);

            if ($request->hasFile('banner')) {
                $files = $request->file('banner');
                foreach ($files as $file) {
                    $this->uploadBanner($file, $campaign->id);
                }
            }

            $packages = Package::all();
            $campaign->packages()->attach($packages);

            DB::commit();

            return ResponseHelper::baseResponse("Create campaign success", 200, $campaign);
        } catch (Exception $err) {
            DB::rollback();
            // return redirect()->back()->with('error', 'Error occurred while adding Campaign and Banners');
            return ResponseHelper::err($err->getMessage());
        }
    }

    private function uploadBanner(UploadedFile $file, int $campaign_id)
    {

        try {
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            $path = '/api/public/images/' . $filename;

            $HOST = $_SERVER['HTTP_HOST'];

            $banner = new BannerCampaign();
            $banner->campaign_id = $campaign_id;
            $banner->url = $HOST . $path;
            $banner->save();
        } catch (Exception $err) {
            throw $err;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
        return $campaign;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
