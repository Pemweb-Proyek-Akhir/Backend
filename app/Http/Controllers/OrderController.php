<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Campaign;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
        try {
            $validated = $this->validate($request, [
                'campaign_id' => 'required|integer',
                'package_id' => 'required',
                'name' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'total' => 'required',
                'payment_method' => 'required',
            ]);

            DB::beginTransaction();
            $validated['user_id'] = $request['user_data']['id'];
            Order::create($validated);

            $campaign = Campaign::find($validated['campaign_id']);
            $campaign->current += $validated['quantity'];
            $campaign->save();

            DB::commit();
            return $validated;
        } catch (Exception $err) {
            DB::rollBack();
            return ResponseHelper::err($err->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
            return ResponseHelper::baseResponse("Success retrieve data", 200, $order::all());
        } catch (Exception $err) {
            return ResponseHelper::err($err->getMessage());
        }
    }

    public function getDetail(Order $order, $id)
    {
        try {
            $data = $order::find($id);
            if ($data == null) {
                return ResponseHelper::err('ID ' . $id . ' is invalid');
            }
            return ResponseHelper::baseResponse("Success retrieve data", 200, $order::find($id));
        } catch (Exception $err) {
            return ResponseHelper::err($err->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
