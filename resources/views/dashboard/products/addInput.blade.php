<x-layout :title="trans('products.actions.input')" :breadcrumbs="['dashboard.products.input']">
    {{ BsForm::resource('products')->post(route('dashboard.products.add.input')) }}
    @component('dashboard::components.box')
        @slot('title', trans('products.actions.input'))

        @include('dashboard.products.partials.input')

        @slot('footer')
            {{ BsForm::submit()->label(trans('products.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
