<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\EpisodeReview;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReviewResource::collection(EpisodeReview::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'review' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'user_id' => 'required|numeric',
            'episode_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $review = EpisodeReview::create($request->only([
            'title',
            'review',
            'rating',
            'user_id',
            'episode_id',
        ]));
        return new ReviewResource($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new ReviewResource(EpisodeReview::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'review' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $review = EpisodeReview::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], Response::HTTP_NOT_FOUND);
        }

        $review->update($request->only([
            'title',
            'review',
            'rating',
            'status',
        ]));
        
        return new ReviewResource($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $episodeReview = EpisodeReview::find($id);

        if (!$episodeReview) {
            return response()->json(['message' => 'Review not found'], Response::HTTP_NOT_FOUND);
        }
    
        $episodeReview->delete();
    
        return response()->json(['message' => 'Review deleted'], Response::HTTP_OK);
    }
}
