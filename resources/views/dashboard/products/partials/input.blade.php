@include('dashboard.errors')
<div class="row">
    <div class="col-3">
        {{ BsForm::select('input_type')->options(['number'=>'number','text'=>'text']) }}
    </div>
    <div class="col-3">
        {{ BsForm::text('input_name') }}
    </div>
</div>
