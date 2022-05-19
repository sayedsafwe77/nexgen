@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Qutation::class])
    @slot('url', route('dashboard.qutations.index'))
    @slot('name', trans('qutations.plural'))
    @slot('active', request()->routeIs('*qutations*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('qutations.actions.list'),
            'url' => route('dashboard.qutations.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Qutation::class],
            'active' => request()->routeIs('*qutations.index')
            || request()->routeIs('*qutations.show'),
        ],
        [
            'name' => trans('qutations.actions.create'),
            'url' => route('dashboard.qutations.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Qutation::class],
            'active' => request()->routeIs('*qutations.create'),
        ],
    ])
@endcomponent
