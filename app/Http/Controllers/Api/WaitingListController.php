<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BookingException;
use App\Http\Controllers\Controller;
use App\Models\WaitingList;
use App\Services\WaitingListService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WaitingListController extends Controller
{
    private WaitingListService $waitingListService;
    use ApiResponseTrait;

    public function __construct(WaitingListService $waitingListService) {
        $this->waitingListService = $waitingListService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(
            'Waiting list records retrieved successfully.',
            $this->waitingListService->getUserWaitingLists(auth()->id())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(WaitingList $waitingList)
    {
        try {
            $waitingList = $this->waitingListService->getUserWaitingList($waitingList, auth()->id());
        } catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }

        return $this->success('Waiting list details retrieved successfully.', $waitingList);
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(WaitingList $waitingList): JsonResponse
    {
        try {
            $waitingList = $this->waitingListService->leaveWaitingList($waitingList, auth()->id());
        } catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }

        return $this->success('You have left the waiting list.', $waitingList);
    }
}
