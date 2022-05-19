@include('dashboard.errors')

@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs
{{ BsForm::select('currency')->options(['EGP' => 'EGP', 'USD' => 'USD']) }}
