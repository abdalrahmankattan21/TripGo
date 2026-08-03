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

    public function store(StoreReviewRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $review = $this->reviewService->create($data);
        }
        catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }


        return $this->success('Review created successfully.', $review, 201);
    }


    public function update(UpdateReviewRequest $request, Review $review)
    {
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
        try {
            $this->reviewService->delete($review);
        }
        catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }
    }
}
