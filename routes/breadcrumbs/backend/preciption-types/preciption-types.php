<?php

Breadcrumbs::for('admin.preciption-types.index', function ($trail) {
    $trail->push(__('labels.backend.access.preciption-types.management'), route('admin.preciption-types.index'));
});

Breadcrumbs::for('admin.preciption-types.create', function ($trail) {
    $trail->parent('admin.preciption-types.index');
    $trail->push(__('labels.backend.access.preciption-types.management'), route('admin.preciption-types.create'));
});

Breadcrumbs::for('admin.preciption-types.edit', function ($trail, $id) {
    $trail->parent('admin.preciption-types.index');
    $trail->push(__('labels.backend.access.preciption-types.management'), route('admin.preciption-types.edit', $id));
});

// Breadcrumbs::for('admin.prescriptions.show', function ($trail, $id) {
//     $trail->parent('admin.prescriptions.index');
//     $trail->push(__('labels.backend.access.prescriptions.management'), route('admin.prescriptions.edit', $id));
// });

