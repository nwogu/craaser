<!DOCTYPE html>
<html lang="en">
<head>
    
	<title>{{ $company->name }} | Add Review</title> 
	<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Muli:200,400,800|Poppins|Lato|Playfair+Display" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"> 
	 
	  
</head>

@if(session()->has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{session()->get('message')}}
</div>
@endif

<header class="header">
		<section class="story-header _padding-70-10">
			<div class="container">
				<h1 class="_margin-0 _half-width _middle">Express Yourself</h1>
				<form method='post'>
				@csrf
				<div class="story">
					<!--<img src="https://www.piggybank.ng/sitestatics/img/gab.jpg" class="avatar" alt="">-->
					<!-- <div class="avatar" style="background-image: url('https://storage.googleapis.com/piggybankservice.appspot.com/_story_pics/ava609c4c7b88.jpg');">.</div> -->
					<div class="card ">
                        
                        <div class='row'>
                        <div class='col-md-9'>
                            <div class="form-group">
						        <div class="name">What's your name?</div>
						        <input type='text' name='name' class="_margin-20 form-control" required />
						        <p class="_margin-20"><span class="tinystorytime"><i></i></span></p>
                            </div>

                            <div class="form-group">
						        <div class="name">What's your email?</div>
						        <input type='email' name='email' class="_margin-20 form-control" required />
						        <p class="_margin-20"><span class="tinystorytime"><i></i>Don't Worry, Your email would not be visble</span></p>
                            </div>
                            <div class="form-group">
						        <div class="name">Say something about {{$company->name}}</div>
						        <textarea  class="_margin-20 form-control" name='review' maxlength="140"required ></textarea>
						        <p class="_margin-20"><span class="tinystorytime"><i></i>Feel Free, Don't hide the bad things as well. But be honest.</span></p>
                            </div>
                        </div>

							<div class='col-md-3'>
							<div class="form-group">
						        <div class="name">Rate {{$company->name}} Out of 5</div>
						        <select  name ='rating' class="_margin-20 form-control" required >
								<option value='null' selected> Pick a Rating</option>
								<option value='5'> 5 Stars | Excellent </option>
								<option value='4'> 4 Stars | Good </option>
								<option value='3'> 3 Stars | Fair </option>
								<option value='2'> 2 Stars | Poor </option>
								<option value='1'> 1 Star | Very Bad </option>
								</select>
						        <p class="_margin-20"><span class="tinystorytime"><i></i>Just be honest.</span></p>
                            </div>
							</div>
                        </div>
					</div>
				</div>
				<button type="submit" class="btn _margin-50">Add Your Review</a>
                </form>
			</div>
		</section>
	</header>