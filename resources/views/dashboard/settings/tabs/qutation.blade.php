<x-layout :title="trans('settings.tabs.qutation')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::number('down_payment')->value(Settings::get('down_payment')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::number('remaining_payment')->value(Settings::get('remaining_payment')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::number('remaining_hour')->value(Settings::get('remaining_hour')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::number('tax')->value(Settings::get('tax')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::number('additional')->value(Settings::get('additional')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::text('address')->value(Settings::get('address')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::text('mobile')->value(Settings::get('mobile')) }}
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            {{ BsForm::text('email')->value(Settings::get('email')) }}
        </div>
    </div>

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
