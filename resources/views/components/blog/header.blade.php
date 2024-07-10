<div {{ $attributes->merge(['class' => 'p-4 p-md-5 mb-4 rounded text-body-emphasis bg-white']) }}>
	@if (isset($smalltitle))
		<strong class="d-inline-block mb-2 text-primary-emphasis">{{ $smalltitle }}</strong>
	@endif
	@if (isset($date))
		<div class="mb-1 text-body-secondary">{{ $date }}</div>
	@endif
	<div class="col-lg px-0">
		{{ $slot }}
	</div>
</div>
