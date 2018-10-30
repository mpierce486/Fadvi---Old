@extends('templates.default')

@section('content')

<div class="container global-wrapper">
	<h1>Our Advisors</h1>
	<div id="nav-buttons-wrapper">
		<div class="btn-group btn-group-lg row" id="nav-buttons" role="group" aria-label="Basic example">
			<button type="button" class="btn col-sm" data-type="FP">Financial Planners</button>
			<button type="button" class="btn col-sm" data-type="EPA">Estate Planning Attorneys</button>
			<button type="button" class="btn col-sm" data-type="CPA">Certified Public Accountants</button>
		</div>
	</div>
	@if ($advisors)
	<div id="advisors-wrapper">
		@foreach ($advisors as $advisor)
		<div class="advisor-detail col-md-6 {{ $advisor->advisor_type }}">
			<div class="advisor-detail-img">
				<img src="{{ asset('/') }}{{ $advisor->image_path }}" />
			</div>
			<div class="advisor-detail-name">
				<h4>{{ $advisor->first_name }} {{ $advisor->last_name }}</h4>
			</div>
			<div class="advisor-detail-firm">
				<h5>{{ $advisor->firm_name }}</h5>
			</div>
			<span class="advisor-detail-more" data-toggle="modal" data-target="#advisormodal-{{ $advisor->id }}"><i class="fas fa-ellipsis-h"></i></span>
		</div>
		<!-- Advisor modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="advisormodal-{{ $advisor->id }}">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="media">
							<img class="mr-3" src="{{ asset('/') }}{{ $advisor->image_path }}">
							<div class="media-body">
								<h5 class="mt-0">Media heading</h5>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End advisor modal -->
		@endforeach
	</div>
	@endif
</div>

<script src="{{ asset('js/advisors.js') }}"></script>

@stop