<?php

Breadcrumbs::for('admin.provinces.index', function ($trail) {
    $trail->push(__('labels.backend.access.provinces.management'), route('admin.provinces.index'));
});

Breadcrumbs::for('admin.provinces.create', function ($trail) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('labels.backend.access.provinces.management'), route('admin.provinces.create'));
});

Breadcrumbs::for('admin.provinces.edit', function ($trail, $id) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('labels.backend.access.provinces.management'), route('admin.provinces.edit', $id));
});

// Breadcrumbs::for('admin.prescriptions.show', function ($trail, $id) {
//     $trail->parent('admin.prescriptions.index');
//     $trail->push(__('labels.backend.access.prescriptions.management'), route('admin.prescriptions.edit', $id));
// });

