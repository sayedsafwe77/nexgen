@if($qutation)
    @if(method_exists($qutation, 'trashed') && $qutation->trashed())
        <a href="{{ route('dashboard.qutations.trashed.show', $qutation) }}" class="text-decoration-none text-ellipsis">
            {{ $qutation->name }}
        </a>
    @else
        <a href="{{ route('dashboard.qutations.show', $qutation) }}" class="text-decoration-none text-ellipsis">
            {{ $qutation->name }}
        </a>
    @endif
@else
    ---
@endif
