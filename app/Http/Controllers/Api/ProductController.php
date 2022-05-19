<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Routing\Controller;
use App\Http\Resources\SelectResource;
use App\Http\Resources\ProductResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the products.
     * @OA\Get(
     *      path="/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = Product::filter()->simplePaginate();
        return ProductResource::collection($products);
    }

    /**
     * Display the specified product.
     *
     * @OA\Get(
     *      path="/products/{id}",
     *      operationId="getProductById",
     *      tags={"Products"},
     *      summary="Get product information",
     *      description="Returns product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Product")
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     * @param \App\Models\Product $product
     * @return \App\Http\Resources\ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Display a listing of the resource.
    * @OA\Get(
     *      path="/select/products",
     *      operationId="getSelectProductsList",
     *      tags={"Products"},
     *      summary="Get list of Select products",
     *      description="Returns list of Select products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function select()
    {
        $products = Product::filter()->simplePaginate();

        return SelectResource::collection($products);
    }
}
