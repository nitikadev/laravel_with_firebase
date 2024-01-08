<?php

namespace App\Services\Api\Contracts;

use Illuminate\Http\JsonResponse;

interface ApiInterface
{
    /**
     * Create API response.
     *
     * @param int    $status
     * @param string $message
     * @param array  $data
     * @param array  $extraData
     *
     * @return JsonResponse
     */
    public static function response($status = 200, $message = null, $data = [], ...$extraData);

    /**
     * Create successful (200) API response.
     *
     * @param string $message
     * @param array  $data
     * @param array  $extraData
     *
     * @return JsonResponse
     */
    public static function ok($message = null, $data = [], ...$extraData);

    /**
     * Create Not found (404) API response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public static function notFound($message = null);

    /**
     * Create Validation (422) API response.
     *
     * @param string $message
     * @param array  $errors
     * @param array  $extraData
     *
     * @return JsonResponse
     */
    public static function validation($message = null, $errors = [], ...$extraData);

    /**
     * Create Validation (422) API response.
     *
     * @param string $message
     * @param array  $data
     * @param array  $extraData
     *
     * @return JsonResponse
     */
    public static function forbidden($message = null, $data = [], ...$extraData);

    /**
     * Create Server error (500) API response.
     *
     * @param string $message
     * @param array  $data
     * @param array  $extraData
     *
     * @return JsonResponse
     */
    public static function error($message = null, $data = [], ...$extraData);
}