<?php
Breadcrumbs::for('admin.setting', function ($trail) {
    $trail->push(__('setting'), route('admin.setting'));
});