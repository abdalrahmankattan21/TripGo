<?php

namespace App\Services;

use App\Exceptions\BookingException;
use App\Models\WaitingList;
use Illuminate\Support\Facades\DB;

class WaitingListService
{

    public function getUserWaitingLists(int $userId)
    {
        return WaitingList::with(['trip', 'companions'])
            ->where('user_id', $userId)
            ->orderBy('position')
            ->paginate(15);
    }

    public function getUserWaitingList(WaitingList $waitingList, int $userId)
    {
        $this->checkIfWaitingListBelongsToUser($waitingList, $userId);

        return $waitingList->load(['trip', 'companions']);
    }

    public function leaveWaitingList(WaitingList $waitingList, int $userId)
    {
        return DB::transaction(function () use ($waitingList, $userId) {
            $waitingList = WaitingList::where($waitingList->id)->first();

            $this->checkIfWaitingListBelongsToUser($waitingList, $userId);
            $this->checkIfStillWaiting($waitingList);

            $waitingList->update(['status' => 'cancelled']);

            WaitingList::where('trip_id', $waitingList->trip_id)
                ->where('status', 'waiting')
                ->where('position', '>', $waitingList->position)
                ->decrement('position');

            return $waitingList->fresh(['trip', 'companions']);
        });
    }

    private function checkIfWaitingListBelongsToUser(WaitingList $waitingList, int $userId)
    {
        if ($waitingList->user_id !== $userId) {
            throw new BookingException('This waiting list entry does not belong to you.', 403);
        }
    }

    private function checkIfStillWaiting(WaitingList $waitingList)
    {
        if ($waitingList->status !== 'waiting') {
            throw new BookingException('This waiting list is no longer active.', 422);
        }
    }
}
