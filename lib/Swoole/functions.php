<?php declare(strict_types=1);

namespace Siler\Swoole;

use Closure;
use Swoole\Http\Request;
use Swoole\Http\Response;

function middleware(array $pipeline): Closure
{
    return function (Request $request, Response $response) use ($pipeline) {
        $tail = array_reduce($pipeline, function (?callable $current, callable $next) use ($request, $response): ?callable {
            if ($current === null) {
                return $next;
            }

            return $current($request, $response, $next);
        });

        if ($tail === null) {
            return $tail;
        }

        return $tail($request, $response);
    };
}