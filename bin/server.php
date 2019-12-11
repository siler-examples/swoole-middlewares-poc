<?php declare(strict_types=1);

namespace Acme;

use function Siler\Swoole\{emit, http};

require_once __DIR__ . '/../vendor/autoload.php';

$handler = function () {
    emit('It works');
};

http($handler, 8000)->start();