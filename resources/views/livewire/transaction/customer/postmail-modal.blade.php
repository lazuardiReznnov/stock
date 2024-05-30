<!-- input -->
<!-- Modal input -->
<div wire:ignore.self class="modal fade" id="customerPostmailModal" tabindex="-1"
	aria-labelledby="customerPostmailModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="customerPostmailModalLabel">
					Add Post Mail
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="saveCustomerPostmail">
				<div class="modal-body">
					<div class="col-md-8 mb-3">
						<input id="pic" type="text" class="form-control @error('pic') is-invalid @enderror" placeholder="pic"
							name="pic" value="{{ old('pic') }}" wire:model="pic" />
						@error('pic')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-8 mb-3">
						<textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
						 wire:model="address"></textarea>
						@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
						<i class="bi bi-x-lg"></i>
					</button>
					<button type="submit" class="btn btn-primary">
						Save changes
					</button>
					<div wire:loading>Processing save...</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- endinput -->

<!-- Modal input -->
<div wire:ignore.self class="modal fade" id="updateCustomerPostmailModal" tabindex="-1"
	aria-labelledby="updateCustomerPostmailModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="updateCustomerPostmailModalLabel">
					Update Postmail
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="updateCustomerPostmail">
				<div class="modal-body">
					<div class="col-md-8 mb-3">
						<input id="pic" type="text" class="form-control @error('pic') is-invalid @enderror" placeholder="pic"
							name="pic" value="{{ old('pic') }}" wire:model="pic" />
						@error('pic')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-md-8 mb-3">
						<input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
							placeholder="address" name="address" value="{{ old('address') }}" wire:model="address" />
						@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
						<i class="bi bi-x-lg"></i>
					</button>
					<button type="submit" class="btn btn-primary">
						Update changes
					</button>
					<div wire:loading>Processing Update...</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- endinput -->

<!-- delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteCustomerPostmailModal" tabindex="-1"
	aria-labelledby="deleteCustomerPostmailModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="deleteCustomerPostmailModalLabel">
					Delete Sparepart Data
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					wire:click="closeModal"></button>
			</div>
			<form wire:submit.prevent="destroyCustomerPostmail">
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
				</div>
			</form>
		</div>
	</div>
</div>
