<?php

namespace App\Exceptions\Traits;

use App\Exceptions\ApiResponseException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ApiExceptionTrait
{
    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request   $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch (true) {
            case $this->isModelNotFoundException($e):

                $response = $this->jsonResponse([
                    'status'    => false,
                    'message' => trans('exception.model_not_found_exception'),
                ], 404);

                break;

            case $this->isRouteNotFoundException($e):

                $response = $this->jsonResponse([
                    'status'    => false,
                    'message' => trans('exception.page_not_found_exception'),
                ], 404);

                break;

            case $this->isAuthenticationException($e):

                $response = $this->jsonResponse([
                    'status'    => false,
                    'message' => trans('exception.unauthorized_exception'),
                ], 403);

                break;

            case $this->isApiResponseException($e):

                Log::debug("GENERAL_DEBUG:Line: {$e->getLine()} File: {$e->getFile()} Message: {$e->getMessage()}" ?: '');

                $response = $this->jsonResponse([
                    'status'    => false,
                    'message' => $e->getMessage(),
                ], $e->getCode());

                break;

            default:
                $origin  = 'origin';
                $data    = json_encode($request->all());
                $message = json_encode($e->getMessage());

                Log::error("GENERAL_ERROR: Line: {$e->getLine()} File: {$e->getFile()} Message: {$message} Origin: {$origin} Request: $data Uri: {$request->capture()
                    ->getUri()}" ?: '');

                $response = $this->jsonResponse([
                    'status'    => false,
                    'message' => $e->getMessage(),
                    'trace'   => "Line: {$e->getLine()}
                    File: {$e->getFile()}
                    Message: {$message}
                    Uri: {$request->capture()
                        ->getUri()}" ?: ''
                ], 500);
        }

        return $response;
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int        $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is from api response and display proper message
     *
     * @param Exception $e
     * @return bool
     */
    public function isApiResponseException(Exception $e)
    {
        return $e instanceof ApiResponseException;
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Determines if the given exception is a Route not found
     *
     * @param Exception $e
     * @return bool
     */
    protected function isRouteNotFoundException(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }

    /**
     * Determines if the given exception is an Authentication is needed.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isAuthenticationException(Exception $e)
    {
        return $e instanceof AuthenticationException;
    }
}
