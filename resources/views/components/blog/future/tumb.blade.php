<div class="col-auto d-none d-lg-block">
	<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
		aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
		@isset($title)
			<title>{{ $title }}</title>
		@endisset
		@isset($thumb)
		<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" @endisset
			dy=".3em">{{ $thumb }}</text>
	</svg>
</div>
