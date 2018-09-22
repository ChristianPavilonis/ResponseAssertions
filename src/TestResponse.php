<?php

namespace ChristianPav\ResponseAssertions;


use Illuminate\Foundation\Testing\TestResponse as LaravelTestResponse;
use PHPUnit\Framework\Assert as PHPUnit;

class TestResponse extends LaravelTestResponse
{
    /**
     * @param \Illuminate\Http\Response $response
     * @return TestResponse
     */
    public static function fromBaseResponse($response)
    {
        return parent::fromBaseResponse($response);
    }

    public function assertStatus($expected)
    {
        $actual = $this->getStatusCode();
        PHPUnit::assertTrue(
            $actual === $expected,
            "Expected response {$this->decipherCode($expected)} but received {$this->decipherCode($actual)} status."
        );

        return $this;
    }

    public function assertOkay()
    {
        return $this->assertOk();
    }

    public function assertCreated()
    {
        return $this->assertStatus(201);
    }

    public function assertAccepted()
    {
        return $this->assertStatus(202);
    }

    public function assertNoContent()
    {
        return $this->assertStatus(204);
    }

    public function assertDeleted()
    {
        return $this->assertNoContent();
    }

    public function assertPartialContent()
    {
        return $this->assertStatus(206);
    }

    public function assertUnauthenticated()
    {
        return $this->assertStatus(401);
    }

    public function assertUnauthorized()
    {
        return $this->assertStatus(403);
    }

    public function assertInternalServerError()
    {
        return $this->assertStatus(500);
    }

    public function assertInternalError()
    {
        return $this->assertInternalServerError();
    }

    public function assertServerError()
    {
        return $this->assertInternalServerError();
    }

    private function decipherCode(int $code)
    {
        if($this->isRedirectCode($code)) {
            return "Redirect ($code)";
        }

        return $this->statusTexts[$code] ?? $code;
    }

    private function isRedirectCode(int $code)
    {
        return $code >= 300 && $code < 400;
    }

}