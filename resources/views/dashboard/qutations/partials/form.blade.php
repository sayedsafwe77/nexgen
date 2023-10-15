@include('dashboard.errors')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/image-slider.css') }}">
@endpush
<div class="row">
    <div class="col-lg-2 col-md-6 col-ls-9 ">
        <select2 placeholder="@lang('categories.attributes.name')" class="select2-customer-nme" name="category_id"
            value="{{ request('category_id') }}" {{-- label="@lang('categories.attributes.name')" --}} remote-url="{{ route('api.categories.select') }}">
        </select2>
    </div>
    <div class="col-lg-1 col-sm-2">
        <button formaction='{{ route('dashboard.qutations.create') }}' formmethod='get'
            class="btn btn-primary">find</button>
    </div>
</div>

{{ BsForm::text('name') }}
<div>
    <label for="">@lang('customers.attributes.name')</label>
    <input type="hidden" name="exist-customer" id="exist-customer">
    <a class="new-customer">New Cumstomer</a>
</div>
<div class="select-customer">
    <select2 placeholder="@lang('customers.attributes.name')" name="qutationable_id" value=""
        remote-url="{{ route('api.customer.index') }}"></select2>
</div>

<div class="customer-container">
    {{ BsForm::text('customer-name')->label(trans('customers.attributes.name')) }}
    {{ BsForm::text('email')->label(trans('customers.attributes.email')) }}
    {{ BsForm::text('phone')->label(trans('customers.attributes.phone')) }}
    {{ BsForm::text('address')->label(trans('customers.attributes.address')) }}
</div>
<div>
    {{ BsForm::number('discount')->label(trans('qutations.attributes.discount')) }}
</div>
@component('dashboard::components.table-box')
    <thead class="thead-dark">
        <tr>
            <th></th>
            <th class="product-count text-center">@lang('qutations.attributes.product_count')</th>
            <th>@lang('products.attributes.name')</th>
            <th>@lang('products.attributes.category')</th>
            <th>@lang('products.attributes.price')</th>
            <th>@lang('products.attributes.discount')</th>
            <th>@lang('products.attributes.image')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>
                    <x-check-all-products :model="$product"></x-check-all-products>
                </td>
                <td class="product-count-{{ $product->id }}">
                    {{ BsForm::number('count-' . $product->id)->attribute('disabled', 'disabled')->value(1) }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '' }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->discount }}</td>
                @if ($product->getFirstMedia())
                    <td>
                        <x-image-slider :product='$product->getMediaResource()' />
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
@endcomponent

@push('scripts')
    <script>
        $('.new-customer').on('click', newCustomer);
        let toggle_create_cutomer = 1;
        console.log({
            toggle_create_cutomer
        });

        function newCustomer(params) {
            console.log('newCustomer');
            if (toggle_create_cutomer) {
                $('#exist-customer').attr('value', '1');
                $('.select-customer').fadeOut(500, () => {
                    $('.customer-container').fadeIn(500);
                })
                toggle_create_cutomer = 0;
            } else {
                $('#exist-customer').attr('value', '0');
                $('.customer-container').fadeOut(500, () => {
                    $('.select-customer').fadeIn(500);
                })
                toggle_create_cutomer = 1;
            }
        }
    </script>
@endpush
@push('scripts')
    <script>
        $('.item-checkbox').on('change', showCount)

        function showCount() {
            console.log($(this).val());
            let count = '.product-count-' + $(this).val();
            if ($(this).prop('checked')) {
                $(count).find('.form-control').prop('disabled', '');
            } else {
                $(count).find('.form-control').prop('disabled', 'disabled');
            }
        }
    </script>
@endpush
