<x-dashboard title="{{ $title }}">

	<x-pagetitle title="{{ $title }}">
		<x-breadcrumb>
			<x-breadcrumb-item link="/dashboard" name="Dashboard" />
			<x-breadcrumb-item link="/dashboard/transaction" name="Transaction" />
			<x-breadcrumb-item link="" name="Track" />
		</x-breadcrumb>
	</x-pagetitle>

	<div class="row">
		<div class="col-md-8">
			<x-card>
				<x-card-title> Form Edit Transaction Detail</x-card-title>

				<form class="row g-3" action="/dashboard/transaction/track/{{ $data->slug }}" method="post"
					enctype="multipart/form-data">
					@csrf @method('put')

					<div class="col-md-8">
						<input id="letter_number" type="text" class="form-control @error('letter_number') is-invalid @enderror"
							placeholder="Letter Number " name="letter_number" value="{{ old('letter_number', $data->letter_number) }}" />
						@error('letter_number')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="Recipient" type="text" class="form-control @error('recipient') is-invalid @enderror"
							placeholder="recipient " name="recipient" value="{{ old('recipient', $data->recipient) }}" />
						@error('recipient')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
							placeholder="Address " name="address" value="{{ old('address', $data->address) }}" />
						@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror"
							placeholder="Weight " name="weight" value="{{ old('weight', $data->weight) }}" />
						@error('weight')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" placeholder="cost "
							name="cost" value="{{ old('cost', $data->cost) }}" />
						@error('cost')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="driver_fee" type="text" class="form-control @error('driver_fee') is-invalid @enderror"
							placeholder="driver fee " name="driver_fee" value="{{ old('driver_fee', $data->driver_fee) }}" />
						@error('driver_fee')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="mark_fee" type="text" class="form-control @error('mark_fee') is-invalid @enderror"
							placeholder="Marketing fee " name="mark_fee" value="{{ old('mark_fee', $data->mark_fee) }}" />
						@error('mark_fee')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="inline_fee" type="text" class="form-control @error('inline_fee') is-invalid @enderror"
							placeholder="Inline fee " name="inline_fee" value="{{ old('inline_fee', $data->inline_fee) }}" />
						@error('inline_fee')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8">
						<input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror"
							placeholder="Inline fee " name="transport" value="{{ old('transport', $data->transport) }}" />
						@error('transport')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="">
						<button type="submit" class="btn btn-primary">
							Update
						</button>
					</div>
				</form>
				<!-- End No Labels Form -->
			</x-card>
		</div>
	</div>
</x-dashboard>
