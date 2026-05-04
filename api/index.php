<?php
// Paksa Laravel membuang semua cache dan file sementara ke folder /tmp bawaan Vercel
$_SERVER['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_SERVER['APP_EVENTS_CACHE'] = '/tmp/events.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/services.php';
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp';
putenv('VIEW_COMPILED_PATH=/tmp');

require __DIR__ . '/../public/index.php';