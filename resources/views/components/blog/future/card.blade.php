<div {{ $attributes->merge(['class' => 'col p-4 d-flex flex-column position-static']) }}>
	@if (isset($smalltitle))
		<strong class="d-inline-block mb-2 text-primary-emphasis">{{ $smalltitle }}</strong>
	@endif
	@if (isset($title))
		<h3 class="mb-0">{{ $title }}</h3>
	@endif
	@if (isset($date))
		<div class="mb-1 text-body-secondary">{{ $date }}</div>
	@endif
	@if (isset($text))
		<p class="card-text mb-auto">{{ $text }}</p>
	@endif

	{{ $slot }}
</div>
