<?php

Breadcrumbs::for('admin.orders.index', function ($trail) {
    $trail->push('Order managment', route('admin.orders.index'));
});


