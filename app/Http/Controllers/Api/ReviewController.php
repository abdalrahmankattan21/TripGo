<?php
namespace App\Http\Controllers\Api;

use App\Exceptions\BookingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\reviews\StoreReviewRequest;
use App\Http\Requests\reviews\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Trip;
use App\Services\ReviewService;
use App\Traits\ApiResponseTrait;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponseTrait;
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Trip $trip)
    {
        return $this->success('Reviews retrieved successfully.', $this->reviewService->getAllReviews($trip));
    }

    public function store(Trip $trip, StoreReviewRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $review = $this->reviewService->create($data,$trip);
        }
        catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }


        return $this->success('Review created successfully.', $review, 201);
    }


    public function update(Review $review, UpdateReviewRequest $request)
    {
        $user = auth()->user();
        if ($review->user_id !== $user->id) {
                return $this->error('Unauthorized. You can only update your own reviews.', 403);
        }

        try {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $review = $this->reviewService->update($review, $data);
        }
        catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }
        return $this->success('Review Updated successfully.', $review, 200);

    }

    public function destroy(Review $review)
    {
        $user = auth()->user();
        if ($review->user_id !== $user->id) {
                return $this->error('Unauthorized. You can only delete your own reviews.', 403);
        }

        try {
            $this->reviewService->delete($review);
        }
        catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }
        return $this->success('Review deleted successfully.', null);
    }
}
