<x-layout :title="$product->name" :breadcrumbs="['dashboard.products.show', $product]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                        <tr>
                            <th width="200">@lang('products.attributes.code')</th>
                            <td>{{ $product->code }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.name')</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.price')</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.interface')</th>
                            <td>{{ $product->interface }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.discount')</th>
                            <td>{{ $product->discount }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('categories.attributes.%name%')</th>
                            <td> {{ $product->category ? $product->category->name : '' }}</td>
                        </tr>
                        @foreach (get_generated_inputs() as $input)
                            <tr>
                                <th width="200">{{ $input->name }}</th>
                                <td> {{ $product[$input->name] ? $product[$input->name] : '' }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th width="200">@lang('products.attributes.description')</th>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.function')</th>
                            <td>{{ $product->function }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('products.attributes.quantity')</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        @if ($product->getFirstMedia())
                            <tr>
                                <th width="200">@lang('products.attributes.image')</th>
                                <td>
                                    <file-preview :media="{{ $product->getMediaResource() }}"></file-preview>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.products.partials.actions.edit')
                    @include('dashboard.products.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
