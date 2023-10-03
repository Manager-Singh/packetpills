<?php

Breadcrumbs::for('admin.auto-messages.index', function ($trail) {
    $trail->push(__('labels.backend.access.auto-messages.management'), route('admin.auto-messages.index'));
});

Breadcrumbs::for('admin.auto-messages.create', function ($trail) {
    $trail->parent('admin.auto-messages.index');
    $trail->push(__('labels.backend.access.auto-messages.management'), route('admin.auto-messages.create'));
});

Breadcrumbs::for('admin.auto-messages.edit', function ($trail, $id) {
    $trail->parent('admin.auto-messages.index');
    $trail->push(__('labels.backend.access.auto-messages.management'), route('admin.auto-messages.edit', $id));
});

