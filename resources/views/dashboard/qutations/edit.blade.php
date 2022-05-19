<x-layout :title="$qutation->name" :breadcrumbs="['dashboard.qutations.edit', $qutation]">
    {{ BsForm::resource('qutations')->putModel($qutation, route('dashboard.qutations.update', $qutation)) }}
    @component('dashboard::components.box')
        @slot('title', trans('qutations.actions.edit'))

        @include('dashboard.qutations.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('qutations.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>