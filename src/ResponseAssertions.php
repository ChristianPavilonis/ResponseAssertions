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

    /**
     * @param $response
     * @return TestResponse
     */
    public function createTestResponse($response)
    {
        return TestResponse::fromBaseResponse($response);
    }

}