<?php

declare(strict_types=1);

namespace Reconmap;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddlewareTest extends TestCase
{

    public function testJwtTokenValidation()
    {
        /*
        {
        "iss": "reconmap.org",
        "aud": "reconmap.com",
        "iat": 1516239022,
        "nbf": 1516239022,
        "exp": 1616239022,
        "data": {
            "id": 5,
            "role": "creator"
        }
        }*/
        $request = $this->createMock(ServerRequestInterface::class);
        $request->expects($this->once())
            ->method('getHeader')
            ->willReturn(['Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJyZWNvbm1hcC5vcmciLCJhdWQiOiJyZWNvbm1hcC5jb20iLCJpYXQiOjE1MTYyMzkwMjIsIm5iZiI6MTUxNjIzOTAyMiwiZXhwIjoxNjE2MjM5MDIyLCJkYXRhIjp7ImlkIjo1LCJyb2xlIjoiY3JlYXRvciJ9fQ.Qh7jLOmA1X4Z9RhhX8AIugs3_HzJuA4s2xVnLRjQD6w']);
        $request->expects($this->once())
            ->method('withAttribute')
            ->with('userId', 5)
            ->willReturn($request);

        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->once())
            ->method('handle')
            ->with($request);

        /** @var AuthMiddleware */
        $middleware = $this->getMockBuilder(AuthMiddleware::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $middleware->process($request, $handler);
    }
}
