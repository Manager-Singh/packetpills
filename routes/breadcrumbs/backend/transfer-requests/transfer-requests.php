<?php

Breadcrumbs::for('admin.transfer-requests.index', function ($trail) {
    $trail->push(__('labels.backend.access.transfer-requests.management'), route('admin.transfer-requests.index'));
});

// Breadcrumbs::for('admin.preciption-types.create', function ($trail) {
//     $trail->parent('admin.preciption-types.index');
//     $trail->push(__('labels.backend.access.preciption-types.management'), route('admin.preciption-types.create'));
// });

// Breadcrumbs::for('admin.preciption-types.edit', function ($trail, $id) {
//     $trail->parent('admin.preciption-types.index');
//     $trail->push(__('labels.backend.access.preciption-types.management'), route('admin.preciption-types.edit', $id));
// });



