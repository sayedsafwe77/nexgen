@can('viewTrash', \App\Models\Product::class)
    <a href="{{ route('dashboard.products.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('products.trashed')
    </a>
@endcan
