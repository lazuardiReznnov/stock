<x-dashboard>
	@slot('title', $title)
	<x-pagetitle title="Home">
		<x-breadcrumb>
			<x-breadcrumb-item link="home.php" name="home" />
			<x-breadcrumb-item link="" name="home" />
		</x-breadcrumb>
	</x-pagetitle>

	<!-- End Page Title -->
	<x-section>

		<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
			<div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
				<h1 class="display-4 fw-bold lh-1 text-body-emphasis">Welcome To </h1>
				<h1 class="display-2"> lazuardi code</h1>
				<p class="lead"></p>

			</div>
			<div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
				<img class="rounded-lg-3" src="/assets/img/gambar.jpg" alt="" width="540">
			</div>
		</div>


	</x-section>
</x-dashboard>
