<?php

namespace App\Http\Controllers\API;

use App\Http\ApiController;
use App\Http\Resources\api\master\ProductResource;
use App\Models\Product;
use App\Services\Api\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $productObject = Product::orderBy('product_name', 'asc')->get();

            return ApiResponse::ok(
                __('common.fetched', ['module' => "Product"]),
                [
                    'list' => ProductResource::collection($productObject)
                ]
            );
        } catch (Exception $e) {
            Log::error("Product fetching failed: " . $e->getMessage());
            return ApiResponse::error(
                __('auth.something_went_wrong')
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validationErrors = $this->validateRequeest($request);
            if (count($validationErrors)) {
                Log::error("Validation Errors: " . implode(", ", $validationErrors->all()));
                return ApiResponse::validation(__('common.validation_errors'), ["errors" => $this->formatValidationErrors($validationErrors->toArray())]);
            }
            $products = new Product;
            $products->product_name = $request->product_name;
            $products->sku_id = $request->sku_id;
            $products->hsn_code = $request->hsn_code;
            $products->cost_price = $request->cost_price;
            $products->tax = $request->tax;
            $products->sales_price = $request->sales_price;
            $products->save();
            return ApiResponse::ok(
                __('common.created', ['module' => "Product"]),
                []
            );
        } catch (Exception $e) {
            Log::error("Product adding failed: " . $e->getMessage());
            return ApiResponse::error(__($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $productObject = Product::find($id);

            if (!$productObject) {
                return ApiResponse::forbidden(__('common.not_found', ['module' => "Product Details"]));
            }

            $productObject->first();

            return ApiResponse::ok(
                __('common.fetched', ['module' => "Product"]),
                [
                    'details' => new ProductResource($productObject)
                ]
            );
        } catch (Exception $e) {
            Log::error("Product fetching failed: " . $e->getMessage());
            return ApiResponse::error(
                __('auth.something_went_wrong')
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validationErrors = $this->validateRequeest($request);
            if (count($validationErrors)) {
                Log::error("Validation Errors: " . implode(", ", $validationErrors->all()));
                return ApiResponse::validation(__('common.validation_errors'), ["errors" => $this->formatValidationErrors($validationErrors->toArray())]);
            }
            $products = Product::find($id);
            $products->product_name = $request->product_name;
            $products->sku_id = $request->sku_id;
            $products->hsn_code = $request->hsn_code;
            $products->cost_price = $request->cost_price;
            $products->tax = $request->tax;
            $products->sales_price = $request->sales_price;
            $products->save();
            return ApiResponse::ok(
                __('common.updated', ['module' => "Product"]),
                []
            );
        } catch (Exception $e) {
            Log::error("Product updation failed: " . $e->getMessage());
            return ApiResponse::error(__($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $productObject = Product::find($id);

            if (!$productObject) {
                return ApiResponse::forbidden(__('common.not_found', ['module' => "Product Details"]));
            }

            $productObject->delete();

            return ApiResponse::ok(
                __('common.deleted', ['module' => "Product"])
            );
        } catch (Exception $e) {
            Log::error("Product deletion failed: " . $e->getMessage());
            return ApiResponse::error(
                __('auth.something_went_wrong')
            );
        }
    }

    private function validateRequeest(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'product_name' => 'required|unique:products',
                'sku_id' => 'required|unique:products',
                'sales_price' => 'required|numeric'
            ],
            [
                'product_name.required' => 'Please enter a product name.',
                'product_name.unique' => 'Product name should be unique.',
                'sku_id.required' => 'Please enter a sku id.',
                'sku_id.unique' => 'SKU Id should be unique.',
                'sales_price.required' => 'Please enter a sales price.',
                'sales_price.numeric' => 'Sales price must be a number'
            ]
        )->errors();
    }
}
