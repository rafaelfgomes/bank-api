<?php

namespace App\Http\Controllers;

use App\Enums\EventType;
use App\Http\Controllers\Events\DepositController;
use App\Http\Controllers\Events\TransferController;
use App\Http\Controllers\Events\WithdrawController;
use App\Http\Requests\EventRequest;
use App\Http\Resources\AccountDepositResource;
use App\Http\Resources\AccountTransferResource;
use App\Http\Resources\AccountWithdrawResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function __invoke(EventRequest $request, DepositController $depositController, WithdrawController $withdrawController, TransferController $transferController)
    {
        switch ($request->get('type')) {
            case EventType::DEPOSIT:
                try {
                    $response = new AccountDepositResource($depositController->deposit($request->all()));
                } catch (NotFoundHttpException $e) {
                    return new JsonResponse(0, Response::HTTP_NOT_FOUND);
                } catch (\Exception $e) {
                    return new JsonResponse([ 'error' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
                }

                break;

            case EventType::WITHDRAW:
                try {
                    $response = new AccountWithdrawResource($withdrawController->withdraw($request->all()));
                } catch (ModelNotFoundException $e) {
                    return new JsonResponse(0, Response::HTTP_NOT_FOUND);
                }
                catch (NotFoundHttpException $e) {
                    return new JsonResponse(0, Response::HTTP_NOT_FOUND);
                }
                catch (\Exception $e) {
                    return new JsonResponse([ 'error' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
                }

                break;

            case EventType::TRANSFER:
                try {
                    $response = new AccountTransferResource($transferController->transfer($request->all()));
                } catch (ModelNotFoundException $e) {
                    return new JsonResponse(0, Response::HTTP_NOT_FOUND);
                }
                catch (NotFoundHttpException $e) {
                    return new JsonResponse(0, Response::HTTP_NOT_FOUND);
                }
                catch (\Exception $e) {
                    return new JsonResponse([ 'error' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
                }

                break;
            default:
                return new JsonResponse([ 'error' => 'Type invalid' ], Response::HTTP_BAD_REQUEST);
                break;
        }

        return new JsonResponse($response, Response::HTTP_CREATED);
    }
}
