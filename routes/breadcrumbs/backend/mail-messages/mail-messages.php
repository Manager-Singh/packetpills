<?php

Breadcrumbs::for('admin.mail-messages.index', function ($trail) {
    $trail->push(__('labels.backend.access.mail-messages.management'), route('admin.mail-messages.index'));
});

Breadcrumbs::for('admin.mail-messages.create', function ($trail) {
    $trail->parent('admin.mail-messages.index');
    $trail->push(__('labels.backend.access.mail-messages.management'), route('admin.mail-messages.create'));
});

Breadcrumbs::for('admin.mail-messages.edit', function ($trail, $id) {
    $trail->parent('admin.mail-messages.index');
    $trail->push(__('labels.backend.access.mail-messages.management'), route('admin.mail-messages.edit', $id));
});

