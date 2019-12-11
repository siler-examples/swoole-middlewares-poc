<?php declare(strict_types=1);

namespace Siler\Swoole;

use Swoole\Http\Request;
use Swoole\Http\Response;

interface Middleware
{
    public function __invoke(Request $request, Response $response, callable $next);
}