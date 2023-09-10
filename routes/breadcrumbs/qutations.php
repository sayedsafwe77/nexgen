<?php

Breadcrumbs::for('dashboard.qutations.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('qutations.plural'), route('dashboard.qutations.index'));
});


Breadcrumbs::for('dashboard.qutations.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.qutations.index');
    $breadcrumb->push(trans('qutations.trashed'), route('dashboard.qutations.trashed'));
});


Breadcrumbs::for('dashboard.qutations.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.qutations.index');
    $breadcrumb->push(trans('qutations.actions.create'), route('dashboard.qutations.create'));
});

Breadcrumbs::for('dashboard.qutations.show', function ($breadcrumb, $qutation) {
    $breadcrumb->parent('dashboard.qutations.index');
    $breadcrumb->push($qutation->qutationable->name ?? 'qutation', route('dashboard.qutations.show', $qutation));
});

Breadcrumbs::for('dashboard.qutations.edit', function ($breadcrumb, $qutation) {
    $breadcrumb->parent('dashboard.qutations.show', $qutation);
    $breadcrumb->push(trans('qutations.actions.edit'), route('dashboard.qutations.edit', $qutation));
});
