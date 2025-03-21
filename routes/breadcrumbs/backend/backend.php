<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
require __DIR__.'/blogs/blog.php';
require __DIR__.'/drugs/drug.php';
require __DIR__.'/blog-categories/blog-categories.php';
require __DIR__.'/blog-tags/blog-tags.php';
require __DIR__.'/pages/page.php';
require __DIR__.'/faqs/faq.php';
require __DIR__.'/email-templates/email-template.php';
require __DIR__.'/prescriptions/prescription.php';
require __DIR__.'/auth/permission.php';
require __DIR__.'/enterprise-connects/enterprise-connects.php';
require __DIR__.'/preciption-types/preciption-types.php';
require __DIR__.'/auto-messages/auto-messages.php';
require __DIR__.'/mail-messages/mail-messages.php';
require __DIR__.'/provinces/provinces.php';
require __DIR__.'/transfer-requests/transfer-requests.php';
require __DIR__.'/setting/setting.php';
require __DIR__.'/orders/orders.php';
require __DIR__.'/prescription-refill/prescription-refill.php';
require __DIR__.'/prescription-existing-refill/prescription-existing-refill.php';
require __DIR__.'/referrals/referrals.php';


