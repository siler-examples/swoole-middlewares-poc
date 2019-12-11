<?php declare(strict_types=1);

namespace Acme;

use Siler\Swoole\Middleware;
use Swoole\Http\Request;
use Swoole\Http\Response;

class GetName implements Middleware
{
    private string $defaultName;
    private string $forbidden;

    public function __construct(string $defaultName, string $forbidden)
    {
        $this->defaultName = $defaultName;
        $this->forbidden = $forbidden;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $name = $request->get['name'] ?? $this->defaultName;

        if ($name === $this->forbidden) {
            $response->status(403);
            $response->end('The forbidden name!');
            return null;
        }

        $request->name = $name;
        return $next;
    }
}