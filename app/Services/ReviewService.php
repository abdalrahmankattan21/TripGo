<?php
namespace App\Services;

use App\Models\Review;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ReviewService 
{
    public function getAllReviews()
    {
        return Review::with(['trip', 'user'])->latest()->get();
    }

    
    public function getReviewById($id)
    {
        return Review::with(['trip', 'user'])->findOrFail($id);
    }
    public function createTripReview(array $data)
    {
        $trip = Trip::findOrFail($data['trip_id']);

        if (Carbon::now()->lt(Carbon::parse($trip->end_date))) {
            throw ValidationException::withMessages([
                'trip_id' => 'لا يمكن تقييم هذه الرحلة لأنها لم تنتهِ بعد.'
            ]);
        }

        $alreadyReviewed = Review::where('trip_id', $data['trip_id'])
            ->where('user_id', $data['user_id'])
            ->exists();

        if ($alreadyReviewed) {
            throw ValidationException::withMessages([
                'trip_id' => 'لقد قمت بتقييم هذه الرحلة مسبقاً، لا يمكنك إرسال تقييم آخر.'
            ]);
        }

        return Review::create($data);
    }

    public function updateReview($id, array $data, $userId)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== $userId) {
            throw ValidationException::withMessages([
                'auth' => 'غير مصرح لك بتعديل هذا التقييم.'
            ]);
        }

        $review->update($data);
        return $review;
    }

    public function deleteReview($id, $userId)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== $userId) {
            throw ValidationException::withMessages([
                'auth' => 'غير مصرح لك بحذف هذا التقييم.'
            ]);
        }

        return $review->delete();
    }

}
