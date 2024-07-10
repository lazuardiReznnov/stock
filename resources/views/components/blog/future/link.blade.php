<a {{ $attributes->class('icon-link gap-1 icon-link-hover stretched-link') }}>
	{{ $slot }}
	<svg class="bi">
		<use xlink:href="#chevron-right" />
	</svg>
</a>
