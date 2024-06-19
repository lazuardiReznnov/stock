<x-dashboard>
	@slot('title', $title)
	<x-pagetitle title="{{ $title }}">
		<x-breadcrumb>
			<x-breadcrumb-item link="home.php" name="home" />
			<x-breadcrumb-item link="" name="{{ $title }}" />
		</x-breadcrumb>
	</x-pagetitle>

	<!-- End Page Title -->
	<x-section>

		<x-blog.header>
			<x-blog.title-header>Judul Blog</x-blog.title-header>
			<x-blog.body-header>Multiple lines of text that form the lede, informing new readers quickly and efficiently about
				what’s most interesting in this post’s contents.</x-blog.body-header>
			<x-blog.link-header><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></x-blog.link-header>
		</x-blog.header>

		<div class="row mb-2">
			<div class="col-md-6">
				<x-blog.future-body>
					<x-blog.future-body-card>
						<strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
						<h3 class="mb-0">Featured post</h3>
						<div class="mb-1 text-body-secondary">Nov 12</div>
						<p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional
							content.</p>
						<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
							Continue reading
							<svg class="bi">
								<use xlink:href="#chevron-right" />
							</svg>
						</a>
					</x-blog.future-body-card>
					<div class="col-auto d-none d-lg-block">
						<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
							aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
							<title>Placeholder</title>
							<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
								dy=".3em">Thumbnail</text>
						</svg>
					</div>
				</x-blog.future-body>
			</div>
			<div class="col-md-6">
				<x-blog.future-body>
					<x-blog.future-body-card>
						<strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
						<h3 class="mb-0">Post title</h3>
						<div class="mb-1 text-body-secondary">Nov 11</div>
						<p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
							Continue reading
							<svg class="bi">
								<use xlink:href="#chevron-right" />
							</svg>
						</a>
					</x-blog.future-body-card>
					<div class="col-auto d-none d-lg-block">
						<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
							aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
							<title>Placeholder</title>
							<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
								dy=".3em">Thumbnail</text>
						</svg>
					</div>
				</x-blog.future-body>
			</div>
		</div>

	</x-section>
</x-dashboard>
