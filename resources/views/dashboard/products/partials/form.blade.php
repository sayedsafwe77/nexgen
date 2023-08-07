@include('dashboard.errors')
@bsMultilangualFormTabs
    {{ BsForm::text('name') }}
    {{ BsForm::text('description') }}
@endBsMultilangualFormTabs
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        {{ BsForm::text('code') }}
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        {{ BsForm::text('price') }}
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        {{ BsForm::number('discount') }}
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        {{ BsForm::text('function') }}
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        {{ BsForm::number('quantity') }}
    </div>
    {{-- categories.select --}}
    <div class="col-lg-3 col-md-6 col-sm-12">
        <select2 placeholder="@lang('categories.attributes.name')" name="category_id" label='@lang('categories.attributes.name')'
            value="{{ isset($product) ? $product->category_id : '' }}"
            remote-url="{{ route('api.categories.select') }}">
        </select2>
    </div>
</div>
<div class="row">
    {{ BsForm::checkbox('interface')->withoutDefault()->value(1)->default('0')->label(trans('products.attributes.interface'))->checked(isset($product) && $product->interface) }}
</div>
<div class="row">
    {{ BsForm::text('comment') }}
</div>
<div class="row">
    @foreach (get_generated_inputs() as $input)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="{{ $input->name }}">{{ $input->name }}</label>
            <input type="{{ $input->type }}" class="form-control" name="{{ $input->name }}">
        </div>
    @endforeach
</div>


@isset($product)
    {{ BsForm::image('product_images')->unlimited()->files($product->getMediaResource()) }}
@else
    {{ BsForm::image('product')->unlimited() }}
@endisset
