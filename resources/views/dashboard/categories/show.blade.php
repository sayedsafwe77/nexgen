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
</x-layout>
