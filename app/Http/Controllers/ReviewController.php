<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
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
            return view('dashboard.review.index', [
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug, Request $request)
    {
        //Get company
        $company = Company::where('slug', $slug)->first();
        //Check if company is set
        if ($company == null) {
            //redirect to home page if company is not found
            return redirect()->route('home');
        }

        //Handle review form submission
        if ($request->filled('name')
        && $request->filled('email')
        && $request->filled('review')
        && $request->filled('rating')) {
            //Check if rating is null
            if ($request->rating == 'null') {
                //add message for rating
                $request->session()->flash('message', 'Hey, You did not pick a rating. Please Rate out of 5');
            } else {
                //create new review object
                $review = new Review();
                //set review with data from review form
                $review->name = $request->name;
                $review->email = $request->email;
                $review->review = $request->review;
                $review->rating = $request->rating;
                //Check if rating is 5
                if ($request->rating == 5) {
                    //publish review
                    $review->published = 1;
                }
                //save review
                $company->reviews()->save($review);
                //add flash message on succesful review saved
                $request->session()->flash('message', 'Your Review Was Received Gracefully');
                //redirect to home page
                return redirect()->route('company-review-page', ['slug' => $slug]);
            }
            //check if no data from review form is set
        } elseif ($request->has('name') && !$request->filled('name')
        && $request->has('email') && !$request->filled('email')
        && $request->has('review') && !$request->filled('review')
        && $request->has('rating') && !$request->filled('rating')) {
            //add flash message
            $request->session()->flash('message', 'Hey, it\'s a really short review. Help fill all fields');
        }
        //render view
        return view('review.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //Get company via slug
        $company = Company::where('slug', $slug)->first();
        //check if company is set
        if ($company == null) {
            //if null, redirect to homepage
            return redirect()->route('home');
        }
        //find all reviews belonging to company
        $reviews = Review::where('company_id', $company->id)
        //where published is true
        ->where('published', 1)
        //order the reviews
        ->orderBy('created_at', 'desc')->get();
        //render reviews page.
        return view('review.show', ['company' => $company, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    }

    public function confirmDelete($id, Request $request)
    {
        //Hold Delete Route
        $deleteRoute = route('delete-review', ['id' => $id]);
        //Hold Go Back Route
        $goBack = route('reviews');
        $del = '<a href="'.$deleteRoute.'">Yes</a>';
        $request->session()->flash('message', 'Are you sure you want to delete? '.$del.' <a href="'.$goBack.'">No</a>');

        return redirect()->route('reviews');
    }

    public function delete(Request $request, $id)
    {
        $review = Review::destroy($id);

        $request->session()->flash('message', 'Review Deleted');

        return redirect()->route('reviews');
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
        return redirect()->route('reviews');
    }
}
