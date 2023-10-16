<x-layout :title="trans('qutations.actions.create')" :breadcrumbs="['dashboard.qutations.create']">
    {{ BsForm::resource('qutations')->post(route('dashboard.qutations.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('qutations.actions.create'))
        @include('dashboard.qutations.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('qutations.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
