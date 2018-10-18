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
			<span class="advisor-detail-more"><i class="fas fa-ellipsis-h"></i></span>
			<div class="card card-body">{{ $advisor->about }}</div>
		</div>
		@endforeach
	</div>
	@endif
</div>

<script src="{{ asset('js/advisors.js') }}"></script>

@stop