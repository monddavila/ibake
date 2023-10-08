<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomizeOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;

class CustomizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('customize_orders')->insert([
            'userID' => $request->user()->id,
            'orderID' => date("sdmY"),
            'isSelectionOrder' => 1,
            'cakeOrderImage' => null,
            'cakeSize' => $request->input('cakeSize'),
            'cakeFlavor' => $request->input('cakeFlavor'),
            'cakeFilling' => $request->input('cakeFilling'),
            'cakeIcing' => $request->input('cakeIcing'),
            'cakeTopBorder' => $request->input('cakeTopBorder'),
            'cakeBottomBorder' => $request->input('cakeBottomBorder'),
            'cakeDecoration' => $request->input('cakeDecoration'),
            'cakeMessage' => $request->input('cakeMessage'),
            'cakePrice' => $request->input('cakePrice'),
            'orderStatus' => 1
        ]);
        return redirect('/customer');
    }

    public function ___insertCustomOrderImage(Request $request)
    {
        $directory = 'images' . DIRECTORY_SEPARATOR . 'customerUploadedOrderCake';
        $newImgName = uniqid() . '-' . $request->name . '.' . $request->cakeOrderImage->getClientOriginalExtension();
        $stored = $request->file('cakeOrderImage')->move($directory, $newImgName);

        DB::table('customize_orders')->insert([
            'userID' => $request->user()->id,
            'orderID' => date("sdmY"),
            'isSelectionOrder' => 2,
            'cakeOrderImage' => $stored,
            'cakeSize' => null,
            'cakeFlavor' => null,
            'cakeFilling' => null,
            'cakeIcing' => null,
            'cakeTopBorder' => null,
            'cakeBottomBorder' => null,
            'cakeDecoration' => null,
            'cakeMessage' => $request->input('cakeMessage'),
            'cakePrice' => null,
            'orderStatus' => 1
        ]);

        return redirect('/customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
