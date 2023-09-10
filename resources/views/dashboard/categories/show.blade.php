<x-layout :title="$category->name" :breadcrumbs="['dashboard.categories.show', $category]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                        <tr>
                            <th width="200">@lang('categories.attributes.name')</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('categories.attributes.currency')</th>
                            <td>{{ $category->currency }}</td>
                        </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.categories.partials.actions.edit')
                    @include('dashboard.categories.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
    </div>
    <div class="row">

        {{ BsForm::resource('categories')->putModel($category, route('dashboard.categories.update', $category)) }}
        @component('dashboard::components.table-box')

            @slot('title')
                @lang('products.actions.list') Products ({{ $products->total() }})
            @endslot

            <thead>
                <tr>
                    <th style="width: 30px;" class="text-center">
                        <x-check-all></x-check-all>
                    </th>
                    <th>@lang('products.attributes.name')</th>
                    <th>@lang('products.attributes.code')</th>
                    <th style="width: 160px">...</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="text-center">
                            <x-check-all-item :model="$product"></x-check-all-item>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.products.show', $product) }}"
                                class="text-decoration-none text-ellipsis">

                                <img src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->name }}"
                                    class="img-circle img-size-32 mr-2" style="height: 32px;">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            {{ $product->code }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">@lang('products.empty')</td>
                    </tr>
                @endforelse
                @slot('footer')
                    @if ($products->hasPages())
                        {{ $products->links() }}
                    @endif
                    {{ BsForm::submit()->label(trans('products.actions.save')) }}
                @endslot
            @endcomponent
            {{ BsForm::close() }}

    </div>
</x-layout>
