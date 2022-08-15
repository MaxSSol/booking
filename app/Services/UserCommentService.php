<?php

namespace App\Services;

use App\Exceptions\AccommodationCommentException;
use App\Models\AccommodationComment;
use Illuminate\Support\Facades\Auth;

class UserCommentService
{
    public function getComments()
    {
        return AccommodationComment::with('accommodationUnit')
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * @throws AccommodationCommentException
     */
    public function storeComment($validated)
    {
        if ($this->isCommentExists($validated['accommodation_unit_id'])) {
            return $this->getComment($validated['accommodation_unit_id']);
        }

        $validated['total_rating'] = collect($validated)->only(['location', 'service', 'price', 'facilities'])->avg();
        $validated['user_id'] = Auth::user()->id;

        $comment = AccommodationComment::create($validated);

        if ($comment) {
            return $comment;
        }

        throw new AccommodationCommentException('An error occurred while creating the comment');
    }

    public function getComment(int $accommodation_unit_id)
    {
        return AccommodationComment::with('accommodationUnit')
            ->where('user_id', Auth::user()->id)
            ->where('accommodation_unit_id', $accommodation_unit_id)
            ->first();
    }

    public function isCommentExists(int $accommodation_unit_id): bool
    {
        return AccommodationComment::where('user_id', Auth::user()->id)
            ->where('accommodation_unit_id', $accommodation_unit_id)
            ->exists();
    }
}
