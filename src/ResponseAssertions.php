<?php

namespace ChristianPav\ResponseAssertions;

/**
 * Trait ResponseAssertions
 * @package ResponseAssertions
 * @method TestResponse get(string $uri, $headers = [])
 * @method TestResponse post(string $uri, $data = [], $headers = [])
 * @method TestResponse getJson(string $uri, $data = [], $headers = [])
 * @method TestResponse postJson(string $uri, $data = [], $headers = [])
 */
trait ResponseAssertions
{

    private $debugOnInternalError = false;

    /**
     * @param $response
     * @return TestResponse
     */
    public function createTestResponse($response)
    {
        $response = TestResponse::fromBaseResponse($response);

        if($response->getStatusCode() == 500 && $this->debugOnInternalError) {
            $this->kill($response->exception);
        }

        return $response;
    }

    public function debugOnInternalError($on = true)
    {
        $this->debugOnInternalError = $on;
    }

    protected function kill($exception)
    {
        dd(
            $exception->getMessage(),
            $exception->getFile() . ' on line: ' . $exception->getLine()
        );
    }

}