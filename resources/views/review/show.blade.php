<!DOCTYPE html>
<html lang="en">
<head>
    
	<title>{{ $company->name }} | Reviews</title>
	<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Muli:200,400,800|Poppins|Lato|Playfair+Display" rel="stylesheet">
     
    
	  
</head>

@if(session()->has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{session()->get('message')}}
</div>
@endif


<header class="header">
        <section class="intro-text _margin-30">
            <div class="container">
                <h1 class="_margin-50 _half-width _middle">{{$company->name}}</h1>
                <p class="_margin-20 _half-width _middle">Reviews from our amazing customers</p>

                                <a href="{{route('add-company-review', ['slug' => $company->slug])}}" class="btn btn-large btn-success blue _margin-50"><b>Add Your Review</b></a>
                                
            </div>
        </section>
    </header>
    <!-- Header + Nav End -->

    <div class="content stories">
        <div class="container">
        @if ($reviews->isEmpty())
        <div class="story">
        <div class="card">
        <p class="_margin-20">There are no reviews to display.</p>
        </div>
        </div>
        @else
        @foreach ($reviews as $review)
			<div class="story"> 
            @if ($review->image_url != null)
			<div class="avatar" style="background-image: url('{{$review->image_url}}');">.</div>
            @endif
			<div class="card">
			<div class="name">{{$review->name}}.</div>
			<p class="_margin-20">"{{$review->review}}"<span class="tinystorytime"><i>Posted on {{$review->created_at->format('d M, Y')}}</i></span></p>
			</div>
			</div>
        @endforeach 
        @endif
        </div>
    </div>

        <section class="content cta">
		<div class="container _center">
			<h1>Have You Patronized {{$company->name}} ?</h1>
			<p>Leave your Review. It would only take 1 minute</p>
			<a href="{{route('add-company-review', ['slug' => $company->slug])}}" class="btn blue _margin-20">Add Your Review</a>
            
		</div>
	</section>