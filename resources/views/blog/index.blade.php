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
			<x-blog.title-header>{{ $datas[0]->title }}</x-blog.title-header>
			<x-slot name="smalltitle">
				<a href="{{ $datas[0]->categoryblog->slug }}">{{ $datas[0]->categoryblog->name }}</a>
			</x-slot>
			<x-slot name="date">
				Created By <a href="{{ $datas[0]->user_id }}">{{ $datas[0]->user->name }}
					at {{ $datas[0]->created_at->diffForHumans() }}
				</a>
			</x-slot>
			<x-blog.body-header>

				{{ Str::limit($datas[0]->body, 200) }}
			</x-blog.body-header>
			<x-blog.link-header><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></x-blog.link-header>
		</x-blog.header>

		<div class="row mb-3">
			@foreach ($datas->skip(1) as $data)
				<div class="col-lg-6">
					<x-blog.future>
						<x-blog.future.card>
							<x-slot name="smalltitle">
								<a href="{{ $data->categoryblog->slug }}">{{ $data->categoryblog->name }}</a>
							</x-slot>

							@slot('title', $data->title)
							<x-slot name="date">
								Created By <a href="{{ $data->user_id }}">{{ $data->user->name }}
									at {{ $data->created_at->diffForHumans() }}
								</a>
							</x-slot>

							<x-slot name="text">
								{{ Str::limit($data->body, 75) }}
							</x-slot>
							<x-blog.future.link href="#">
								Continue reading
							</x-blog.future.link>
						</x-blog.future.card>
						<x-blog.future.tumb>
							@slot('title', $data->title)
							@slot('thumb', $data->categoryblog->name)
						</x-blog.future.tumb>
					</x-blog.future>

				</div>
			@endforeach

		</div>



	</x-section>
</x-dashboard>
