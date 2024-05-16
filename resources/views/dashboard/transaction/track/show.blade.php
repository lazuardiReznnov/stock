<x-dashboard title="{{ $title }}">
	<x-pagetitle title="{{ $title }}">
		<x-breadcrumb>
			<x-breadcrumb-item link="/dashboard" name="Dashboard" />
			<x-breadcrumb-item link="/dashboard/transaction/track" name="Track" />
			<x-breadcrumb-item link="" name="{{ $title }}" />
		</x-breadcrumb>
	</x-pagetitle>
	<div class="row my-4">
		<div class="col-md-6">
			<x-button-group>
				<x-button-link class="btn-primary" href="/dashboard/transaction/track" data-bs-toggle="tooltip"
					data-bs-placement="top" title="Back">
					Back
				</x-button-link>




			</x-button-group>
		</div>
	</div>
	<x-section class="profile">
		<div class="row">
			<div class="col-xl-4">
				<x-card2>
					<x-card-body class="profile-card pt-4 d-flex flex-column align-items-center">

						<h2>{{ $data->name }}</h2>
					</x-card-body>
				</x-card2>
			</div>
			<div class="col-xl-8" wire:ignore.self>
				<x-card2>
					<x-card-body class="pt-2">
						<ul class="nav nav-tabs nav-tabs-bordered">
							<li class="nav-item">
								<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
									Overview
								</button>
							</li>

							<li class="nav-item">
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#rate">
									Rate
								</button>
							</li>
							<li class="nav-item">
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#letter">
									Letter
								</button>
							</li>
						</ul>
						<div class="tab-content pt-2">
							<div class="tab-pane fade show active profile-overview" id="profile-overview">
								<!-- Spesification -->

								<x-card-title>Detail Transaction </x-card-title>
								<div class="profile-overview">
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Letter Number
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Recipt
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Address
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Area
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											region
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Type
										</div>
										<div class="col-lg-9 col-md-8">

										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">

										</div>
										<div class="col-lg-9 col-md-8">
											<x-button-link href="#" class="btn-success" data-bs-toggle="modal"
												data-bs-target="#updateTransactionModal" title="Update Transaction">
												Update
											</x-button-link>
										</div>
									</div>

									<!-- spesification -->


									<!-- endSpesification -->
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Last Update
										</div>
										<div class="col-lg-9 col-md-8">
											{{ $data->updated_at->diffforhumans() }}
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade rate pt-3 profile-overview" id="rate">
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										Fare
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										Weight
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										Driver Fee
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										cost
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>

								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										Driver Fee
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										mark Fee
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-4 label">
										Inline Fee
									</div>
									<div class="col-lg-9 col-md-8">

									</div>
								</div>
							</div>
							<div class="tab-pane fade repair pt-3" id="repair">
								/>
							</div>
						</div>
					</x-card-body>
				</x-card2>
			</div>
		</div>
	</x-section>
</x-dashboard>
