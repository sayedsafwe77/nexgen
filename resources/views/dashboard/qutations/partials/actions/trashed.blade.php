@can('viewTrash', \App\Models\Qutation::class)
    <a href="{{ route('dashboard.qutations.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('qutations.trashed')
    </a>
@endcan
