<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\HttpCode;
use App\Http\Transformers\Transformer;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * responseSuccess method
     *
     * @param Transformer|null $transformer
     * @param array $meta
     * @param int $httpCode
     * @return JsonResponse
     */
    protected function responseSuccess(
        Transformer $transformer = null,
        array $meta = [],
        int $httpCode = HttpCode::SUCCESS
    ): JsonResponse {
        $data = [];

        if (!empty($transformer)) {
            $data = $transformer->transform();
        }

        return $this->responseSuccessRaw($data, $meta, $httpCode);
    }

    /**
     * responseSuccessRaw method
     *
     * @param array $data
     * @param array $meta
     * @param int $httpCode
     * @return JsonResponse
     */
    protected function responseSuccessRaw(
        array $data = [],
        array $meta = [],
        int $httpCode = HttpCode::SUCCESS
    ): JsonResponse {
        $response = [];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        if (empty($response)) {
            $httpCode = HttpCode::SUCCESS_NO_CONTENT;
        }

        return $this->responseRaw($response, $httpCode);
    }

    /**
     * responseError method
     *
     * @param Exception $exception
     * @param int $httpCode
     * @return JsonResponse
     */
    protected function responseError(
        Exception $exception,
        int $httpCode = HttpCode::UNPROCESSABLE_ENTITY
    ): JsonResponse {
        return $this->responseRaw(get_error_from_exception($exception), $httpCode);
    }

    /**
     * responseRaw method
     *
     * @param array $response
     * @param int $httpCode
     * @return JsonResponse
     */
    protected function responseRaw(array $response, int $httpCode): JsonResponse
    {
        return response()->json($response, $httpCode);
    }
}
