<?php

/**
 * get_error_from_exception function
 *
 * @param \App\Exceptions\Exception $e
 * @param string|null $message
 * @return array
 */
function get_error_from_exception(\App\Exceptions\Exception $e, string $message = null): array
{
    $response = [
        'message' => $message ?? $e->getMessage(),
        'code' => $e->getErrorCode()
    ];

    return $response;
}

/**
 * get_error_response_from_exception function
 *
 * @param \App\Exceptions\Exception $e
 * @param string|null $message
 * @param int $httpCode
 * @return \Illuminate\Http\JsonResponse
 */
function get_error_response_from_exception(
    \App\Exceptions\Exception $e,
    string $message = null,
    int $httpCode = 422
): \Illuminate\Http\JsonResponse
{
    return response()->json([
        'error' => get_error_from_exception($e, $message)
    ], $httpCode);
}

/**
 * is_email function
 *
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
