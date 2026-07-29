<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    // حقن الخدمة بشكل عادي بدون أي ميثود middleware
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * 1. عرض كل التقييمات
     */
    public function index()
    {
        $reviews = $this->reviewService->getAllReviews();
        return response()->json(['success' => true, 'data' => $reviews], 200);
    }

    /**
     * 2. عرض تقييم واحد محدد
     */
    public function show($id)
    {
        $review = $this->reviewService->getReviewById($id);
        return response()->json(['success' => true, 'data' => $review], 200);
    }

    /**
     * 3. إنشاء تقييم جديد
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trip_id'  => 'required|exists:trips,id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string|max:1000',
        ]);

        $validatedData['user_id'] = auth()->id();

        try {
            $review = $this->reviewService->createTripReview($validatedData);
            return response()->json(['success' => true, 'message' => 'تم إضافة التقييم.', 'data' => $review], 201);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    /**
     * 4. تحديث تقييم موجود
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string|max:1000',
        ]);

        try {
            $review = $this->reviewService->updateReview($id, $validatedData, auth()->id());
            return response()->json(['success' => true, 'message' => 'تم تحديث التقييم.', 'data' => $review], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    /**
     * 5. حذف التقييم
     */
    public function destroy($id)
    {
        try {
            $this->reviewService->deleteReview($id, auth()->id());
            return response()->json(['success' => true, 'message' => 'تم حذف التقييم بنجاح.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }
}
