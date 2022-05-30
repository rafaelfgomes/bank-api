<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Http\Resources\BalanceResource;
use App\Services\Contracts\AccountServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BalanceController extends Controller
{
    public function __invoke(BalanceRequest $request, AccountServiceInterface $accountService)
    {
        try {
            $response = $accountService->search($request->query->get('account_id'));
        } catch (ModelNotFoundException $e) {
            return new JsonResponse(0, Response::HTTP_NOT_FOUND);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(0, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return new JsonResponse([ 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($response['balance']);
    }
}
