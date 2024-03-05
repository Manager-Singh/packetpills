<?php

Breadcrumbs::for('admin.auth.user.index', function ($trail) {
    $trail->push(__('labels.backend.access.users.management'), route('admin.auth.user.index'));
});
Breadcrumbs::for('admin.auth.user.members', function ($trail,$id) {
    $trail->push(__('labels.backend.access.users.management'), route('admin.auth.user.members',$id));
});
Breadcrumbs::for('admin.auth.user.deactivated', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.deactivated'), route('admin.auth.user.deactivated'));
});
Breadcrumbs::for('admin.auth.user.employee', function ($trail) {
    $trail->push(__('Employee'), route('admin.auth.user.employee'));
});
Breadcrumbs::for('admin.auth.user.employee.create', function ($trail) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('Create'), route('admin.auth.user.employee.create'));
});
Breadcrumbs::for('admin.auth.user.employee.show', function ($trail,$id) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('Create'), route('admin.auth.user.employee.show',$id));
});
Breadcrumbs::for('admin.auth.user.employee.edit', function ($trail,$id) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('Create'), route('admin.auth.user.employee.edit',$id));
});
Breadcrumbs::for('admin.auth.user.employee.update', function ($trail,$id) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('Create'), route('admin.auth.user.employee.update',$id));
});
Breadcrumbs::for('admin.auth.user.employee.delete', function ($trail,$id) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('Create'), route('admin.auth.user.employee.delete',$id));
});

Breadcrumbs::for('admin.auth.user.deleted', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.deleted'), route('admin.auth.user.deleted'));
});

Breadcrumbs::for('admin.auth.user.create', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('labels.backend.access.users.create'), route('admin.auth.user.create'));
});
Breadcrumbs::for('admin.auth.member.create', function ($trail,$id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('labels.backend.access.members.create'), route('admin.auth.member.create',$id));
});

Breadcrumbs::for('admin.auth.user.show', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.view'), route('admin.auth.user.show', $id));
});

Breadcrumbs::for('admin.auth.user.edit', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.edit'), route('admin.auth.user.edit', $id));
});

Breadcrumbs::for('admin.auth.user.change-password', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.change-password'), route('admin.auth.user.change-password', $id));
});

Breadcrumbs::for('admin.auth.user.employee.change-password', function ($trail, $id) {
    $trail->parent('admin.auth.user.employee');
    $trail->push(__('menus.backend.access.users.change-password'), route('admin.auth.user.employee.change-password', $id));
});
