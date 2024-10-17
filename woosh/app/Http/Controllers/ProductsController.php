<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        return \response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $product = Product::create([
            'name' => $data['name'],
            'category' => $data['category'],
            'description' => $data['description'],
            'datetime' => Carbon::parse($data['datetime'])->format('Y-m-d H:i:s')
        ]);

        return \response()->json([
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return \response()->json([
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleted = $product->deleteOrFail();

        if($deleted){
            return \response()->json([
                'message' => 'Product deleted!'
            ]);
        }

        return \response()->json([
            'message' => 'Product failed to delete.'
        ], 400);
    }

    public function data(){
        $count = Product::all()->count();
        $consumables = Product::where('category', 'Consumable')->count();
        $non_consumables = Product::where('category', 'Non-Consumable')->count();

        $months = [
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0
        ];

        # Monthly Report

        for ($i = 1; $i <= 12; $i++){
            $data_count = Product::whereMonth('datetime', \str_pad($i, 2, "0", \STR_PAD_LEFT))->count();
            $months[\array_keys($months)[$i-1]] = $data_count;
        }

        return \response()->json([
            'product_count' => $count,
            'consumables' => $consumables,
            'non_consumables' => $non_consumables,
            'month' => $months
        ]);
    }
}
