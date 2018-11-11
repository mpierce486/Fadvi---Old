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
		<div class="modal fade" id="advisormodal-{{ $advisor->id }}">
			<div class="modal-dialog" id="advisor-bio-modal">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<div class="advisor-bio">
							<div class="advisor-bio-top">
								<div class="advisor-bio-img"><img src="{{ asset('/') }}{{ $advisor->image_path }}" /></div>
								<div class="advisor-bio-name"><h3>{{ $advisor->first_name }} {{ $advisor->last_name }}</h3></div>
								<div class="advisor-bio-title"><h5>{{ $advisor->title }}</h5></div>
								<div class="advisor-bio-firm"><h6><a href="{{ $advisor->firm_website }}">{{ $advisor->firm_name }}</a></h6></div>
							</div>
							<div class="advisor-bio-bottom"><?php echo $advisor->biography ?></div>
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