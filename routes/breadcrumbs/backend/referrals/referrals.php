<?php
Breadcrumbs::for('admin.referrals', function ($trail) {
    $trail->push(__('referrals'), route('admin.referrals'));
});