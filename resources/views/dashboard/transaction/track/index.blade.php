<x-dashboard title="{{ $title }}">
	@push('csslivewire')
		@livewireStyles
	@endpush
	<x-pagetitle title="{{ $title }}">
		<x-breadcrumb>
			<x-breadcrumb-item link="/dashboard" name="Dashboard" />
			<x-breadcrumb-item link="/dashboard/transaction" name="Transaction" />

			<x-breadcrumb-item link="" name="Track" />
		</x-breadcrumb>
	</x-pagetitle>
	<livewire:transaction.track.index />
	@push('jslivewire')
		@livewireScripts
		<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
		<script>
			window.addEventListener("close-modal", (event) => {
				$("#trackModal").modal("hide");
				$("#updateTrackModal").modal("hide");
				$("#editTransactionModal").modal("hide");
				$("#deleteTrackModal").modal("hide");
			});
		</script>
	@endpush
</x-dashboard>
