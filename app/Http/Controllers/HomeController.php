<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\Company;
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
        //Get logged in user
        $user = Auth::user();
        //Get Company
        $company = $user->company;
        //hold variables
        $total_reviews = 0;
        $average_reviews = 0;
        $bad_reviews = 0;
        $low_ratings = [];
        $great_ratings = [];

        

        //check if there are no reviews
        if ($company->reviews()->count() < 1) {
            //return view
            return view('dashboard', [
                'total' => $total_reviews, 
                'average' => $average_reviews, 
                'bad' => $bad_reviews, 
                'low' => $low_ratings, 
                'great' => $great_ratings,
                'company' => $company
                ]);
        } else {
            $sum_of_reviews = 0;
            foreach ($company->reviews as $reviews) {
                //hold total company reviews
                $total_reviews = $total_reviews + 1;
                //add all ratings
                $sum_of_reviews = $sum_of_reviews + $reviews->rating;
                //check if rating is 1
                if ($reviews->rating === 1) {
                    //add rating to bad reviews holder
                    $bad_reviews = $bad_reviews + 1;
                }
                //check if rating is less or == 3
                if ($reviews->rating <= 3) {
                    //add ratings to low reviews holder
                    array_push($low_ratings, $reviews);
                } else {
                    //add to great reviews
                    array_push($great_ratings, $reviews);
                }
            }
            
            //find the average rating
            $average_reviews = round($sum_of_reviews / $total_reviews, 1);
        }
        //return view
        return view('dashboard.review.index', [
            'total' => $total_reviews, 
            'average' => $average_reviews, 
            'bad' => $bad_reviews, 
            'low' => $low_ratings, 
            'great' => $great_ratings,
            'company' => $company]);
    }

    public function confirmDelete($id, Request $request)
    {
        $del = '<a href="/home/delete/'.$id.'">Yes</a>';
        $request->session()->flash('message', 'Are you sure you want to delete? '.$del.' <a href="/home">No</a>');

        return redirect()->route('dashboard');
    }

    public function delete(Request $request, $id)
    {
        $review = Review::destroy($id);

        $request->session()->flash('message', 'Review Deleted');

        return redirect()->route('dashboard');
    }

    public function publish(Request $request, $id)
    {
        //get review
        $review = Review::find($id);
        //check if review is not published
        if ($review->published == 0) {
            //publish review
            $review->published = 1;
            $review->save();
            $message = 'Review Published';
        } else {
            //unpublish review
            $review->published = 0;
            $review->save();
            $message = 'Review Unpublished';
        }
        //add flash message
        $request->session()->flash('message', $message);
        //redirect to home
        return redirect()->route('dashboard');
    }
}
