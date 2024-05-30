<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Postmail</title>
	@vite(['resources/sass/app.scss', 'resources/js/app.js'])
	<link rel="stylesheet" href="/assets/css/bootstrap-print.css" media="print" />
</head>

<body>
	<div class="container">
		<div class="card p-2 mt-3 col-6">
			<div class="row d-flex">

				<div class="col-sm align-self-center">
					<p class="fw-bold">To</p>
					<div class="row">
						<p>Up : {{ $data->pic }}</p>
						<p>{{ $data->customer->name }}</p>
						<p>{{ $data->address }}</p>
						<p>{{ $data->customer->phone }}</p>
					</div>
				</div>

			</div>


		</div>

		<div class="card p-2 mt-3 col-6">
			<div class="row d-flex">

				<div class="col-sm align-self-center">
					<p class="fw-bold">From</p>
					<div class="row">

						<p>PT. GEMA CIPTA GEMILANG</p>
						<p>Serang</p>

					</div>
				</div>

			</div>


		</div>
	</div>
</body>

</html>
