@extends('templates.default')

@section('content')

<div id="main-top">
	<div id="main-top-text">
		<h1 id="main-text">Financial Advice For the Next Generation</h1>
	</div>
	<div id="main-topics-wrapper">
		<div id="main-topics" class="container advisor-categories">
			<h3 id="topics-header-text">Choose one of the topics below</h3>
			<div id="topics-wrapper" class="col-lg-10 col-lg-offset-1 col-xs-12">
				@foreach ($topics as $topic)
					<div class="topics-item-wrapper">
						<div class="topics-item img-thumbnail">
							<p>{{ $topic }}</p>
						</div>
					</div>
				@endforeach
			</div>
			<div id="life-events-wrapper" class="col-lg-10 col-lg-offset-1 col-xs-12">
				@foreach ($life_events as $life_event)
					<div class="topics-item-wrapper">
						<div class="topics-item img-thumbnail">
							<p>{{ $life_event }}</p>
						</div>
					</div>
				@endforeach
			</div>
			<h6 id="life-events-toggle">Or choose life events <i class="fas fa-ellipsis-h"></i></h6>
			<h6 id="topics-toggle">Or choose topics <i class="fas fa-ellipsis-h"></i></h6>
		</div>
	</div>
</div>

<div id="main-middle-wrapper">
	<div class="collapse" id="middleCollapse">
		<div id="collapse-inside-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm" id="middle-left">
						<span id="middle-left-header">Fadvi Learning Center</span>
						<p id="middle-left-sub-header">Come learn about <strong><span></span></strong></p>
						<div id="middle-left-article-list">
							<ul>
								<li>
									<a href="#" class="middle-left-article-link">This is the title of the article - <span class="article-author">John Smith</span></a>
								</li>
								<li>
									<a href="#" class="middle-left-article-link">This is the title of the article that is about a certain topic - <span class="article-author">John Smith</span></a>
								</li>
								<li>
									<a href="#" class="middle-left-article-link">This is the title of - <span class="article-author">John Smith</span></a>
								</li>
								<li>
									<a href="/blog" class="middle-left-article-link" id="browse-article-link">View More...</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm" id="middle-right">
						<span id="middle-right-header">Ask An Advisor</span>
						<i class="far fa-comments"></i>
						<p id="main-right-text">Want some extra help? Don't go look for quality financial advisors. Instead, post your question and have them come to you!</p>
						<a href="/question" class="btn" id="middle-right-button">Ask Question</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-bottom-wrapper" class="container">
	<div class="main-bottom-header"><h1>How Does It Work?</h1></div>
	<div class="main-bottom-inside-wrapper">
		<div class="main-bottom-step-wrapper">
			<div class="main-bottom-step row">
				<div class="main-bottom-step-img col-md show-xs">
					<img src="https://i.imgur.com/pW1Yb2o.jpg" class="img-fluid" id="first-step-img" />
				</div>
				<div class="main-bottom-step-text col-md">
					<div class="main-bottom-step-number">1</div>
					<div class="main-bottom-step-text-header">CHOOSE A TOPIC</div>
					<div class="main-bottom-step-text-copy">I'm guessing you came here because you have some questions about finances. Don't worry, we all have questions about that every now and then. Fadvi makes it easy. Simply choose your topic above and start learning!</div>
				</div>
				<div class="main-bottom-step-img col-md hide-xs">
					<img src="https://i.imgur.com/pW1Yb2o.jpg" class="img-fluid" />
				</div>
			</div>
		</div>
	</div>

	<div class="main-bottom-inside-wrapper">
		<div class="main-bottom-step-wrapper">
			<div class="main-bottom-step row">
				<div class="main-bottom-step-img col-md">
					<img src="https://i.imgur.com/e1lg2Ob.jpg" class="img-fluid" />
				</div>
				<div class="main-bottom-step-text col-md">
					<div class="main-bottom-step-number">2</div>
					<div class="main-bottom-step-text-header">BROWSE ARTICLES OR INTERACT WITH ADVISORS</div>
					<div class="main-bottom-step-text-copy">You can be the "do-it-yourselfer" and browse through our library of articles. Did we mention those articles are written by actual financial advisors themselves? You can even take it a step further and connect with advisors directly. Simply post your question and sit back and let advisors answer to you!</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main-bottom-inside-wrapper">
		<div class="main-bottom-step-wrapper">
			<div class="main-bottom-step row">
				<div class="main-bottom-step-img col-md show-xs">
					<img src="https://i.imgur.com/jM2AR96.jpg" class="img-fluid" id="third-step-img" />
				</div>
				<div class="main-bottom-step-text col-md">
					<div class="main-bottom-step-number">3</div>
					<div class="main-bottom-step-text-header">CELEBRATE YOUR NEWFOUND KNOWLEDGE</div>
					<div class="main-bottom-step-text-copy">You just took the first step on your way to financial enlightenment! Whether you browsed the Fadvi Learning Center or connected with an advisor, you should feel more empowered to take charge of your finances and even help others do the same.</div>
				</div>
				<div class="main-bottom-step-img col-md hide-xs">
					<img src="https://i.imgur.com/jM2AR96.jpg" class="img-fluid" />
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-mission-wrapper">
	<div id="main-mission-inside-wrapper">
		<div class="main-bottom-step-wrapper">
			<div class="main-bottom-step row">
				<div class="main-mission-img col-md">
					<img src="https://i.imgur.com/CLElCBZ.png" class="img-fluid" />
				</div>
				<div class="main-mission-text col-md">
					<div class="main-mission-text-header">OUR MISSION</div>
					<div class="main-mission-text-copy">We help empower you by using two main resources. You can be the "Do It Yourself" person and browse through our library of information on your topic or you can connect with our hand-picked network of financial advisors. Connecting with a advisor is super easy and confidential! Just post a question and advisors will respond to you right here on Fadvi. No outside emails or phone calls needed. We respect your confidentiality and host all communication on Fadvi.</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Include register modal -->
@include ('templates.partials.register-modal')

<!-- JS -->
<script src="{{ asset('js/main.js') }}"></script>


@stop