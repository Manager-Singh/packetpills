<?php

Breadcrumbs::for('admin.enterpriseconnects.index', function ($trail) {
    $trail->push(__('labels.backend.access.enterpriseconnects.management'), route('admin.enterpriseconnects.index'));
});

// Breadcrumbs::for('admin.prescriptions.create', function ($trail) {
//     $trail->parent('admin.prescriptions.index');
//     $trail->push(__('labels.backend.access.prescriptions.management'), route('admin.prescriptions.create'));
// });

// Breadcrumbs::for('admin.prescriptions.edit', function ($trail, $id) {
//     $trail->parent('admin.prescriptions.index');
//     $trail->push(__('labels.backend.access.prescriptions.management'), route('admin.prescriptions.edit', $id));
// });

// Breadcrumbs::for('admin.prescriptions.show', function ($trail, $id) {
//     $trail->parent('admin.prescriptions.index');
//     $trail->push(__('labels.backend.access.prescriptions.management'), route('admin.prescriptions.edit', $id));
// });

