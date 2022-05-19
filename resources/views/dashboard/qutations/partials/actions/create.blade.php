@can('create', \App\Models\Qutation::class)
    <a href="{{ route('dashboard.qutations.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('qutations.actions.create')
    </a>
@endcan
