<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Category;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::filter()->paginate();
        $categories = Category::select('id')->get()->toArray();
        return view('dashboard.products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->except('media'));

        $product->addAllMediaFromTokens();

        flash(trans('products.messages.created'));

        return redirect()->route('dashboard.products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\ProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        $product->addAllMediaFromTokens();

        flash(trans('products.messages.updated'));

        return redirect()->route('dashboard.products.show', $product);
    }
    public function getInputForm()
    {
        return view('dashboard.products.addInput');
    }
    public function createInput(Request $request)
    {
        $input = ['type'=>$request->input_type ,'name'=>$request->input_name ];
        $generated_inputs = json_decode(file_get_contents(storage_path('generated_inputs.json')));
        $generated_inputs[] = $input;
        file_put_contents(storage_path('generated_inputs.json'),json_encode($generated_inputs));
        Schema::table('products', function (Blueprint $table) use($request) {
            if($request->input_type == 'number'){
                $table->integer($request->input_name)->nullable();
            }else{
                $table->string($request->input_name)->nullable();
            }
        });
        flash(trans('products.messages.input_created'));
        return redirect()->route('dashboard.products.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        flash(trans('products.messages.deleted'));

        return redirect()->route('dashboard.products.index');
    }

   /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewTrash', Product::class);

        $products = Product::onlyTrashed()->paginate();

        return view('dashboard.products.trashed', compact('products'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Product $product)
    {
        $this->authorize('restore', $product);

        $product->restore();

        flash()->success(trans('products.messages.restored'));

        return redirect()->route('dashboard.products.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Product $product)
    {
        $this->authorize('forceDelete', $product);

        $product->forceDelete();

        flash(trans('products.messages.deleted'));

        return redirect()->route('dashboard.products.trashed');
    }
}
