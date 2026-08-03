<?php
namespace App\Services;

use App\Models\Review;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ReviewService
{
    public function getAllReviews(Trip $trip)
    {
        return Review::with(['trip', 'user'])->where('trip_id', $trip->id)->latest()->get();
    }



    public function create(array $data, Trip $trip)
    {

        if (Carbon::now()->lt(Carbon::parse($trip->end_date))) {
            throw ValidationException::withMessages([
                'trip_id' => 'You Cannot Review this trip because the thip does not end yet.'
            ]);
        }

        $alreadyReviewed = Review::where('trip_id', $trip->id)
            ->where('user_id', $data['user_id'])
            ->exists();

        if ($alreadyReviewed) {
            throw ValidationException::withMessages([
                'trip_id' => 'You already review the trip you cannot review it more than once.'
            ]);
        }

        $data['trip_id'] = $trip->id;

        return Review::create($data);
    }

    public function update(Review $review, array $data)
    {
        $review->update($data);

        return $review->fresh();
    }

    public function delete(Review $review)
    {
        $review->delete();
    }

}
