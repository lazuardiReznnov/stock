<!-- input -->
<!-- Modal input -->
<div wire:ignore.self class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="trackModalLabel">
					Create Track Data
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="saveTrack">
				<div class="modal-body">

					<div class="col-md-8 mb-3" wire:ignore>
						<select id="unit" class="form-select @error('unit_id') is-invalid @enderror" name="unit_id"
							wire:model="unit_id">
							<option>Choose unit ...</option>
							@if ($units !== null)
								@foreach ($units as $unit)
									<option value="{{ $unit->id }}">
										{{ $unit->name }}
									</option>
								@endforeach
							@endif
						</select>

						@error('unit_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-8 mb-3">
						<input id="driver" type="text" class="form-control @error('driver') is-invalid @enderror"
							placeholder="driver" name="driver" wire:model="driver" />
						@error('driver')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-8 mb-3" wire:ignore>
						<select id="customer" class="form-select @error('selectedCustomers') is-invalid @enderror"
							name="selectedCustomers" wire:model="selectedCustomers">
							@if ($customers !== null)
								<option>Choose customer ...</option>
								@foreach ($customers as $customer)
									<option value="{{ $customer->id }}">
										{{ $customer->name }}
									</option>
								@endforeach
							@endif
						</select>

						@error('customer_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>


					@if (!is_null($selectedCustomers))
						<div class="col-md-8 mb-3">
							<select id="rate_id" class="form-select @error('rateId') is-invalid @enderror" name="rate_id"
								wire:model="rateId">
								<option>Choose rate ...</option>
								@foreach ($rates as $rate)
									<option value="{{ $rate->id }}">
										{{ $rate->name }} {{ $rate->type }}
									</option>
								@endforeach
							</select>

							@error('rate_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					@endif

					@if (!is_null($rateId))
						<div class="col-md-8 mb-3">
							<input id="region" type="text" class="form-control @error('region') is-invalid @enderror"
								placeholder="region" name="region" wire:model="region" />
							@error('region')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<input type="hidden" name="type" wire:model="type">

						<div class="col-md-8 mb-3">
							<input id="fare" type="fare" class="form-control @error('fare') is-invalid @enderror" placeholder="fare"
								name="fare" wire:model="fare" />
							@error('fare')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					@endif


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
						<i class="bi bi-x-lg"></i>
					</button>
					<button type="submit" class="btn btn-primary">
						Save changes
					</button>
					<div wire:loading>save...</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- endinput -->

<!-- modal update -->
<div wire:ignore.self class="modal fade" id="updateTrackModal" tabindex="-1" aria-labelledby="updateTrackModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="updateTrackModalLabel">
					Update Track Data
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="updateTrack">
				<div class="modal-body">
					<div class="col-md-8 mb-3" wire:ignore>
						<select id="unit" class="form-select @error('unit_id') is-invalid @enderror" name="unit_id"
							wire:model="unit_id">
							<option>Choose unit ...</option>
							@if ($units !== null)
								@foreach ($units as $unit)
									<option value="{{ $unit->id }}">
										{{ $unit->name }}
									</option>
								@endforeach
							@endif
						</select>

						@error('unit_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-8 mb-3">
						<input id="driver" type="text" class="form-control @error('driver') is-invalid @enderror"
							placeholder="driver" name="driver" wire:model="driver" />
						@error('driver')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-8 mb-3" wire:ignore>
						<select id="customer" class="form-select @error('selectedCustomers') is-invalid @enderror"
							name="selectedCustomers" wire:model="selectedCustomers">
							@if ($customers !== null)
								<option>Choose customer ...</option>
								@foreach ($customers as $customer)
									<option value="{{ $customer->id }}">
										{{ $customer->name }}
									</option>
								@endforeach
							@endif
						</select>

						@error('customer_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>


					@if (!is_null($selectedCustomers))

						<div class="col-md-8 mb-3">
							<select id="rate_id" class="form-select @error('rateId') is-invalid @enderror" name="rate_id"
								wire:model="rateId">
								<option>Choose rate ...</option>
								@foreach ($rates as $rate)
									@if ($rate->id == $area)
										<option value="{{ $rate->id }}" selected>
											{{ $rate->name }} {{ $rate->type }}
										</option>
									@else
										<option value="{{ $rate->id }}">
											{{ $rate->name }} {{ $rate->type }}
										</option>
									@endif
								@endforeach
							</select>

							@error('rate_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					@endif

					@if (!is_null($rateId))
						<div class="col-md-8 mb-3">
							<input id="region" type="text" class="form-control @error('region') is-invalid @enderror"
								placeholder="region" name="region" wire:model="region" />
							@error('region')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<input type="hidden" name="type" wire:model="type">

						<div class="col-md-8 mb-3">
							<input id="fare" type="fare" class="form-control @error('fare') is-invalid @enderror"
								placeholder="fare" name="fare" wire:model="fare" />
							@error('fare')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					@endif

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
						<i class="bi bi-x-lg"></i>
					</button>
					<button type="submit" class="btn btn-primary">
						Update changes
					</button>
					<div wire:loading>Update...</div>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- modal Delete -->
<div wire:ignore.self class="modal fade" id="deleteTrackModal" tabindex="-1"
	aria-labelledby="deleteTrackModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="deleteTrackModalLabel">
					Delete Track Data
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="destroyTrack">
				<div class="modal-body">
					<h4>Are You Sure.??</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
						<i class="bi bi-x-lg"></i>
					</button>
					<button type="submit" class="btn btn-primary">
						Delete changes
					</button>
					<div wire:loading>Delete...</div>
				</div>
			</form>
		</div>
	</div>
</div>
