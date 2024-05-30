<x-dashboard title="{{ $title }}">
	<x-pagetitle title="{{ $title }}">
		<x-breadcrumb>
			<x-breadcrumb-item link="/dashboard" name="Dashboard" />
			<x-breadcrumb-item link="/dashboard/transaction/customer" name="Customer" />
			<x-breadcrumb-item link="" name="{{ $title }}" />
		</x-breadcrumb>
	</x-pagetitle>
	<div class="row my-4">
		<div class="col-md-6">
			<x-button-group>
				<x-button-link class="btn-primary" href="/dashboard/transaction/customer" data-bs-toggle="tooltip"
					data-bs-placement="top" title="Back">
					Back
				</x-button-link>

				<x-button-link href="/dashboard/transaction/customer/{{ $data->slug }}/edit" class="btn-warning"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Edit transaction/customer"><i
						class="bi bi-pencil-square"></i> Edit
					transaction/customer
				</x-button-link>

				<form action="/dashboard/transaction/customer/{{ $data->slug }}" method="post" class="d-inline">
					@method('delete') @csrf
					<button class="btn btn-danger border-0 rounded-0" data-bs-toggle="tooltip" data-bs-placement="top"
						title="Delete Customer" onclick="return confirm('are You sure ??')">
						<i class="bi bi-x-lg"></i>
					</button>
				</form>
			</x-button-group>
		</div>
	</div>
	<x-section class="profile">
		<div class="row">
			<div class="col-xl-4">
				<x-card2>
					<x-card-body class="profile-card pt-4 d-flex flex-column align-items-center">
						@if ($data->image)
							<img width="200" class="rounded-circle" alt="" src="{{ asset('storage/' . $data->image->pic) }}" />
						@else
							<img class="rounded-circle mx-auto d-block shadow my-3" src="http://source.unsplash.com/200x200?smartphones"
								alt="" />
						@endif
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
								<button class="nav-link" data-bs-toggle="tab" data-bs-target="#posted">
									POSTED
								</button>
							</li>
						</ul>
						<div class="tab-content pt-2">
							<div class="tab-pane fade show active profile-overview" id="profile-overview">
								<!-- Spesification -->

								<x-card-title> Spesification </x-card-title>
								<div class="profile-overview">
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Company Name
										</div>
										<div class="col-lg-9 col-md-8">
											{{ $data->name }}
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											address
										</div>
										<div class="col-lg-9 col-md-8">
											{{ $data->address }}
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											phone
										</div>
										<div class="col-lg-9 col-md-8">
											{{ $data->phone }}
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Email
										</div>
										<div class="col-lg-9 col-md-8">
											{{ $data->email }}
										</div>
									</div>
									<!-- spesification -->

									/>
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
							<div class="tab-pane fade rate pt-3" id="rate">



							</div>
							<div class="tab-pane fade repair pt-3" id="posted">
								<x-card-title> Post Mail </x-card-title>

								<x-card>
									<livewire:transaction.customer.postmail :customerId="$data->id" />
								</x-card>

								<x-button-link href="#" class="btn-success" data-bs-toggle="modal" data-bs-target="#customerPostmailModal"
									title="Post Mail">
									add Postmail
								</x-button-link>

							</div>
						</div>
					</x-card-body>
				</x-card2>
			</div>
		</div>
	</x-section>
	@push('csslivewire')
		<livewire:styles />
	@endpush
	@push('jslivewire')
		<livewire:scripts />

		<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
		<script>
			window.addEventListener("close-modal", (event) => {
				$("#customerPostmailModal").modal("hide");
				$("#updateCustomerPostmailModal").modal("hide");
				$("#deleteCustomerPostmailModal").modal("hide");
			});
		</script>
	@endpush
</x-dashboard>
