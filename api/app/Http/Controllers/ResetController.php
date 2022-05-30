<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ResetServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetController extends Controller
{
    public function __invoke(ResetServiceContract $resetService): JsonResponse
    {
        try {
            $resetService->initApp();
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(0, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return new JsonResponse([ 'error' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('OK');
    }
}
