<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Qutation;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\QutationRequest;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laraeast\LaravelSettings\Facades\Settings;

class QutationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * QutationController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Qutation::class, 'qutation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qutations = Qutation::filter()->orderBy('created_at', 'DESC')->paginate();
        return view('dashboard.qutations.index', compact('qutations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where(function ($q) {
            if (request()->has('category_id')) {
                $q->whereHas('category', function ($q) {
                    $q->where('id', request('category_id'));
                });
            }
        })->paginate(5);
        return view('dashboard.qutations.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\QutationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QutationRequest $request)
    {
        $products = Product::whereIn('id', $request->items)->get();
        if ($request->qutationable_id) {
            $user = Customer::where('id', $request->qutationable_id)->select('id')->first();
        } else {
            $custmer = $request->only('customer-name', 'email', 'phone', 'address');
            $custmer['name'] = $custmer['customer-name'];
            $user =  Customer::create($custmer);
        }
        $qutation = $user->qutations()->create(['name' => $request->name, $user, 'discount' => $request->discount]);
        $sub_total = 0;
        $products->map(function ($item) use ($request, &$sub_total) {
            $count = "count-$item[id]";
            $item['quantity'] = $request[$count];
            $sub_total += ($item['price'] * $item['quantity']);
            return $item;
        });
        $qutation->sub_total = $sub_total;
        $qutation->category_id = $request->category_id;
        $qutation->installation_fees = Settings::get('additional');
        $qutation->total = $sub_total + ((Settings::get('additional') / 100) * $sub_total);
        $qutation->save();
        $product_quantity = [];
        foreach ($products as $product) {
            $count = "count-$product->id";
            $product_quantity['quantity'] = $request[$count];
            $qutation->products()->attach($product, $product_quantity);
        }
        flash(trans('qutations.messages.created'));

        return redirect()->route('dashboard.qutations.show', $qutation);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Qutation $qutation
     * @return \Illuminate\Http\Response
     */
    public function show(Qutation $qutation)
    {

        return view('dashboard.qutations.show', compact('qutation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Qutation $qutation
     * @return \Illuminate\Http\Response
     */
    public function edit(Qutation $qutation)
    {
        return view('dashboard.qutations.edit', compact('qutation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\QutationRequest $request
     * @param \App\Models\Qutation $qutation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QutationRequest $request, Qutation $qutation)
    {
        $qutation->update($request->all());

        flash(trans('qutations.messages.updated'));

        return redirect()->route('dashboard.qutations.show', $qutation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Qutation $qutation
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Qutation $qutation)
    {
        $qutation->delete();

        flash(trans('qutations.messages.deleted'));

        return redirect()->route('dashboard.qutations.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewTrash', Qutation::class);

        $qutations = Qutation::onlyTrashed()->paginate();

        return view('dashboard.qutations.trashed', compact('qutations'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Qutation $qutation
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Qutation $qutation)
    {
        return view('dashboard.qutations.show', compact('qutation'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Qutation $qutation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Qutation $qutation)
    {
        $this->authorize('restore', $qutation);

        $qutation->restore();

        flash()->success(trans('qutations.messages.restored'));

        return redirect()->route('dashboard.qutations.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Qutation $qutation
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Qutation $qutation)
    {
        $this->authorize('forceDelete', $qutation);

        $qutation->forceDelete();

        flash(trans('qutations.messages.deleted'));

        return redirect()->route('dashboard.qutations.trashed');
    }
}
