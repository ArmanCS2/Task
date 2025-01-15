<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Jobs\uploadImageJob;
use App\Models\Product;
use App\Services\Image\ImageService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductCollection($this->productService->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'required|image',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
        ]);
        if ($data->fails()) {
            return response(['errors' => $data->errors()], 422);
        }
        $result = '';
        if (!empty($request->image)) {
            $imageService = new ImageService();
            $imageService->setExclusiveDirectory('products');
            $result = $imageService->fitAndSave($request->image, $request->width, $request->height);
        }

        //uploadImageJob::dispatch($request->image,$request->width, $request->height);

        $product = $this->productService->create([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id ?? null,
            'image' => $result ?? null,
        ]);
        return response([
            'message' => 'محصول با موفقیت ایجاد شد',
            'data' => new ProductResource($product)
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!empty($product)) {
            return new ProductResource($this->productService->find($product->id));
        }
        return response()->json([
            'errors' => 'محصول یافت نشد'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (empty($product)) {
            return response()->json([
                'errors' => 'محصول برای ویرایش یافت نشد'
            ], 404);
        }
        $data = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image',
            'height' => 'nullable|required_with:image|numeric',
            'width' => 'nullable|required_with:image|numeric',
        ]);
        if ($data->fails()) {
            return response(['errors' => $data->errors()], 422);
        }

        $result = '';
        if (!empty($request->image)) {
            $imageService = new ImageService();
            $imageService->deleteImage($product->image);
            $imageService->setExclusiveDirectory('products');
            $result = $imageService->fitAndSave($request->image, $request->width, $request->height);
        }
        $product = $this->productService->update([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id ?? $product->category_id,
            'image' => $result ?? $product->image,
        ], $product->id);

        return response([
            'message' => 'محصول با موفقیت ویرایش شد',
            'data' => new ProductResource($product)
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!empty($product)) {
            $this->productService->delete($product->id);
        }
        return response()->json([
            'message' => 'محصول با موفقیت حذف شد'
        ], 200);
    }
}
