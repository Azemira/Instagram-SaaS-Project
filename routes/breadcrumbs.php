<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
     $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('admin-dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin-dashboard'));
});

Breadcrumbs::register('users-list', function ($breadcrumbs) {
    $breadcrumbs->push('Users', route('users-list'));
});

Breadcrumbs::register('create-user', function ($breadcrumbs) {
    $breadcrumbs->push('Create User', route('create-user'));
});
