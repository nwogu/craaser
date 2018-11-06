<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\Company;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
}
