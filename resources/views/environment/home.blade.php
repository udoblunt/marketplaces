<!-- Stored in resources/views/environment/home.blade.php -->

@extends('layouts.environment_master')
	
@section('title', $title)

@section('content')
	<div class="marketsContainer">
		@if (!empty($userSubscriptions))
			
			@foreach ($userSubscriptions as $userSubscription)
				<div class="market">
					<div class="upvote">
						<a class="up" href="{{ url('/ctrl/m/vote', [$userSubscription->name, 'up'])}}">Up</a>
						<h5>{{ $userSubscription->upvote }}</h5>
						<a class="down" href="{{ url('/ctrl/m/vote', [$userSubscription->name, 'down'])}}">Down</a>
					</div>
					<div class="info">
						<h1><a class="pull-left" href="{{ url('/m', [$userSubscription->name]) }}">{{ $userSubscription->name }}</a></h1>
						<a class="subscribe" href="{{ url('/ctrl/m/subscription', [$userSubscription->name])}}">Unsubscribe</a>
						<h2>{{ $userSubscription->description }}</h2>
						<div class="items">
							@foreach ($items[$userSubscription->id] as $item)
								<div class="item">
									<div class="head">
										<h4><a href="{{ url('/m', [$userSubscription->name, $item->name]) }}">{{ $item->name }}</a></h5>
										<h5><small>Created by <a href="#">{{ $users[$item->id]->first_name }}</a></small></h5>
										<h5>{{ $item->price }} euro</h5>
									</div>
									<div class="description">
										<p>{{ $item->description }}</p>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@endforeach

		@else

			<h1>No subscriptions yet! Here are some suggestions</h1>

			@foreach ($markets as $market)
				<div class="market">
					<div class="upvote">
						<a class="up" href="{{ url('/ctrl/m/vote', [$market->name, 'up'])}}">Up</a>
						<h5>{{ $market->upvote }}</h5>
						<a class="down" href="{{ url('/ctrl/m/vote', [$market->name, 'down'])}}">Down</a>
					</div>
					<div class="info">
						<h1><a class="pull-left" href="{{ url('/m', [$market->name]) }}">{{ $market->name }}</a></h1>
						<a class="subscribe" href="{{ url('/ctrl/m/subscription', [$market->name])}}">{{ (!empty($userSubscriptions) && $userSubscriptions[$market->id] != null) ? "Unsubscribe" : "Subscribe" }}</a>						<h2>{{ $market->description }}</h2>
						<div class="items">
							@foreach ($items[$market->id] as $item)
								<div class="item">
									<div class="head">
										<h4><a href="{{ url('/m', [$market->name, $item->name]) }}">{{ $item->name }}</a></h5>
										<h5><small>Created by <a href="#">{{ $users[$item->id]->first_name }}</a></small></h5>
										<h5>{{ $item->price }} euro</h5>
									</div>
									<div class="description">
										<p>{{ $item->description }}</p>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@endforeach
		@endif 
	</div>
	<div class="generalInfoContainer">
		<h4>Marketplaces</h4>
		<h5>How to in a nutshell</h5>
		<p>Subsribe to markets that reflect your intrests to see items that matter to you.</p>
		<p>Create a market if you cannot find the one you need. (Privilege for accounts older than 10 days)</p>
		<p>Offer your items to specific markets to sell it quickly.</p>
	</div>
@endsection
