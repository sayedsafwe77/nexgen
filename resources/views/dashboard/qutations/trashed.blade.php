<x-layout :title="trans('qutations.trashed')" :breadcrumbs="['dashboard.qutations.trashed']">
    @include('dashboard.qutations.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title')
            @lang('qutations.actions.list') ({{ count_formatted($qutations->total()) }})
        @endslot

        <thead>
        <tr>
            <th colspan="100">
                <x-check-all-force-delete
                        type="{{ \App\Models\Qutation::class }}"
                        :resource="trans('qutations.plural')"></x-check-all-force-delete>
                <x-check-all-restore
                        type="{{ \App\Models\Qutation::class }}"
                        :resource="trans('qutations.plural')"></x-check-all-restore>
            </th>
        </tr>
        <tr>
            <th>
                <x-check-all></x-check-all>
            </th>
            <th>@lang('qutations.attributes.name')</th>
            <th>@lang('qutations.attributes.deleted_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($qutations as $qutation)
            <tr>
                <td class="text-center">
                  <x-check-all-item :model="$qutation"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.qutations.show', $qutation) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $qutation->name }}
                    </a>
                </td>

                <td>{{ $qutation->deleted_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.qutations.partials.actions.show')
                    @include('dashboard.qutations.partials.actions.restore')
                    @include('dashboard.qutations.partials.actions.forceDelete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('qutations.empty')</td>
            </tr>
        @endforelse

        @if($qutations->hasPages())
            @slot('footer')
                {{ $qutations->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
