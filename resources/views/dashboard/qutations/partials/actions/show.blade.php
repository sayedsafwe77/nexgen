@can('view', $qutation)
    <a href="{{ route('dashboard.qutations.show', $qutation) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
