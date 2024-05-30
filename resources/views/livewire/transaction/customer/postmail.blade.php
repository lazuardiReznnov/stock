<div>
	@include('livewire.transaction.customer.postmail-modal')
	<x-card-title> Post Mail </x-card-title>
	<div class="row">
		<div class="col-md-12">
			@if (session()->has('success'))
				<!-- pesan -->

				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}

					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
				</div>

				<!-- endpesan -->
			@endif
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>

				<th scope="col">PIC</th>
				<th scope="col">Address</th>

				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@if ($datas->count())
				@foreach ($datas as $post)
					<tr>
						<th scope="row">
							{{ $loop->iteration }}
						</th>
						<td>
							{{ $post->pic }}
						</td>
						<td>
							{{ $post->address }}
						</td>


						<td>
							<a href="/dashboard/transaction/customer/postmail/{{ $post->id }}" class="badge bg-warning"><i
									class="bi bi-printer"></i></a>

							<a href="#" class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#updatePostMailModal"
								wire:click="editPostMail({{ $post->id }})"><i class="bi bi-pencil-square"></i></a>
							<button class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#deletePostMailModal"
								wire:click="deletePostMail({{ $post->id }})">
								<i class="bi bi-x-lg"></i>
							</button>
						</td>
						<!-- Modal Image -->
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7" class="text-center">Data Not Found</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
