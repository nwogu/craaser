<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logged = Auth::user();

        $total_reviews = 0;
        $average_reviews = 0;
        $bad_reviews = 0;
        $low_ratings = [];
        $great_ratings = [];

        if ($logged->reviews()->count() < 1) {
            return view('dashboard', ['total' => $total_reviews, 'average' => $average_reviews, 'bad' => $bad_reviews, 'low' => $low_ratings, 'great' => $great_ratings]);
        } else {
            $sum_of_reviews = 0;
            foreach ($logged->reviews as $reviews) {
                $total_reviews = $total_reviews + 1;
                $sum_of_reviews = $sum_of_reviews + $reviews->rating;

                if ($reviews->rating == 1) {
                    $bad_reviews = $bad_reviews + 1;
                }
                if ($reviews->rating <= 3) {
                    array_push($low_ratings, $reviews);
                } else {
                    array_push($great_ratings, $reviews);
                }
            }
            $average_reviews = round($sum_of_reviews / $total_reviews, 1);
        }

        return view('dashboard', ['total' => $total_reviews, 'average' => $average_reviews, 'bad' => $bad_reviews, 'low' => $low_ratings, 'great' => $great_ratings]);
    }

    public function confirmDelete($id, Request $request)
    {
        $del = '<a href="/home/delete/'.$id.'">Yes</a>';
        $request->session()->flash('message', 'Are you sure you want to delete? '.$del.' <a href="/home">No</a>');

        return redirect('/home');
    }

    public function delete(Request $request, $id)
    {
        $review = Review::destroy($id);

        $request->session()->flash('message', 'Review Deleted');

        return redirect('/home');
    }

    public function publish(Request $request, $id)
    {
        $review = Review::find($id);
        if ($review->published == 0) {
            $review->published = 1;
            $review->save();
            $message = 'Review Published';
        } else {
            $review->published = 0;
            $review->save();
            $message = 'Review Unpublished';
        }

        $request->session()->flash('message', $message);

        return redirect('/home');
    }
}
