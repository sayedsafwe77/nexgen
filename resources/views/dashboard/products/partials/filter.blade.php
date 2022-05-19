{{ BsForm::resource('products')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('products.filter'))

    <div class="row">
        <div class="col-md-6">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-6">
            <label for="category">{{ trans('categories.attributes.name') }}</label>
            <select name="category" class="form-control" value='{{ request('category') }}'>
                @foreach ($categories as $category)
                    <option value="{{ $category['name'] }}" {{ (request('category') == $category['name']) ? 'selected' : '' }}>{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('products.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('products.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
