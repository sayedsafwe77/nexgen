<x-layout :title="trans('qutations.plural')" :breadcrumbs="['dashboard.qutations.index']">
    @include('dashboard.qutations.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('qutations.actions.list') ({{ $qutations->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
                <x-check-all-delete
                    type="{{ \App\Models\Qutation::class }}"
                    :resource="trans('qutations.plural')"></x-check-all-delete>
                {{-- <x-import-excel
                            model="{{ \App\Models\Qutation::class }}"
                            import="{{ \App\Imports\QutationsImport::class }}"
                            exportResource="{{ App\Http\Resources\QutationResource::class }}"
                            :resource="trans('qutations.plural')"></x-import-excel>
                <x-export-excel
                            model="{{ \App\Models\Qutation::class }}"
                            export="{{ \App\Exports\Export::class }}"
                            resource="{{ App\Http\Resources\QutationResource::class }}"
                            fileName="Qutations"
                            ></x-export-excel> --}}
                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.qutations.partials.actions.create')
                    @include('dashboard.qutations.partials.actions.trashed')
                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
              <x-check-all></x-check-all>
            </th>
            <th>@lang('qutations.attributes.name')</th>
            <th>@lang('qutations.attributes.owner')</th>
            <th>@lang('qutations.attributes.created_at')</th>
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
                <td>
                    {{ $qutation->qutationable->name }}
                </td>
                <td>{{ $qutation->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.qutations.partials.actions.show')
                    @include('dashboard.qutations.partials.actions.edit')
                    @include('dashboard.qutations.partials.actions.delete')
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
