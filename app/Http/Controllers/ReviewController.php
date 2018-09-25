<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
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
        $company = User::where('company_slug', $slug)->first();

        if ($company == null) {
            return redirect('/');
        }

        if ($request->filled('name')
        && $request->filled('email')
        && $request->filled('review')
        && $request->filled('rating')) {
            if ($request->rating == 'null') {
                $request->session()->flash('message', 'Hey, You did not pick a rating. Please Rate out of 5');
            } else {
                $review = new Review();
                $review->name = $request->name;
                $review->email = $request->email;
                $review->review = $request->review;
                $review->rating = $request->rating;
                if ($request->rating == 5) {
                    $review->published = 1;
                }
                $company->reviews()->save($review);

                $request->session()->flash('message', 'Your Review Was Received Gracefully');

                return redirect('/'.$slug);
            }
        } elseif ($request->has('name') && !$request->filled('name')
        && $request->has('email') && !$request->filled('email')
        && $request->has('review') && !$request->filled('review')
        && $request->has('rating') && !$request->filled('rating')) {
            $request->session()->flash('message', 'Hey, it\'s a really short review. Help fill all fields');
        }

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
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $company = User::where('company_slug', $slug)->first();

        if ($company == null) {
            return redirect('/');
        }

        $reviews = Review::where('user_id', $company->id)
        ->where('published', 1)
        ->orderBy('created_at', 'desc')->get();

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
