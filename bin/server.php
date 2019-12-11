<?php declare(strict_types=1);

namespace Acme;

use Swoole\Http\Request;
use Swoole\Http\Response;
use function Siler\Swoole\{emit, http, middleware};

require_once __DIR__ . '/../vendor/autoload.php';

$get_name = new GetName('Siler', 'Laravel');

$greet = fn(Request $req, Response $res) => emit("Hello {$req->name}");

$handler = [$get_name, $greet];

http(middleware($handler), 8000)->start();