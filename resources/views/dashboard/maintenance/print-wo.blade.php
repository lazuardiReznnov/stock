<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link
            rel="stylesheet"
            href="/assets/css/bootstrap-print.css"
            media="print"
        />
    </head>
    <body>
        <div class="container">
            <div class="card p-2 mt-3">
                <div class="row d-flex">
                    <div class="col-sm-3">
                        <img
                            class="rounded-circle mx-auto d-block shadow my-3"
                            src="/assets/img/logo.jpg"
                            alt=""
                            width="185"
                        />
                    </div>
                    <div class="col-sm-6 align-self-center">
                        <h2 class="text-center display-6 text-uppercase">
                            Work Order Letter
                        </h2>
                    </div>
                    <div class="col-sm-3 align-self-center">
                        <div class="row">
                            <small class="col-sm-5 fw-bold"> No </small>
                            <small class="col-sm-7">
                                : {{ $data->slug }}
                            </small>
                        </div>
                        <div class="row">
                            <small class="col-sm-5 fw-bold"> Date </small>
                            <small class="col-sm-7">
                                :
                                {{ \Carbon\Carbon::parse($data->tgl)->format('d F Y') }}
                            </small>
                        </div>
                        <div class="row">
                            <small class="col-sm-5 fw-bold"> Estimate </small>
                            <small class="col-sm-7">
                                :
                                {{ $data->estimate }}
                                Days
                            </small>
                        </div>
                        <div class="row">
                            <small class="col-sm-5 fw-bold"> Mechanic </small>
                            <small class="col-sm-7">
                                : {{ $data->mechanic }}
                            </small>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row justify-content-center p-3">
                    <div class="col-sm-12">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <small class="col-sm-4 fw-bold fs-6">
                                            Unit Name
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {{ $data->unit->name }}
                                        </small>
                                    </div>
                                    <div class="row">
                                        <small class="col-sm-4 fw-bold fs-6">
                                            Brand/Type
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {{ $data->unit->type->brand->name }}
                                            {{ $data->unit->type->name }}
                                        </small>
                                    </div>
                                    <div class="row">
                                        <small class="col-sm-4 fw-bold fs-6">
                                            VIN
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {{ $data->unit->spesification->vin }}
                                        </small>
                                    </div>
                                    <div class="row">
                                        <small class="col-sm-4 fw-bold fs-6">
                                            Engine Number
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {!!
                                            $data->unit->spesification->en!!}
                                        </small>
                                    </div>
                                    <div class="row">
                                        <small class="col-sm-4 fw-bold fs-6">
                                            Year
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {!!
                                            $data->unit->spesification->year!!}
                                        </small>
                                    </div>
                                    <div class="row">
                                        <small class="col-sm-4 fs-6 fw-bold">
                                            Group
                                        </small>
                                        <small class="col-sm-8 fs-6 text-end">
                                            {{ $data->unit->group->name }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center p-3">
                    <div class="col-sm-12">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <small class="col-sm-3 fw-bold fs-6">
                                            Repaird Request
                                        </small>
                                        <small class="col-sm-9 fs-6">
                                            : {!! $data->description !!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center p-3">
                    <div class="col-sm-12">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <small class="col-sm-3 fs-6 fw-bold">
                                            Instruction
                                        </small>
                                        <small class="col-sm-9 fs-6">
                                            : {!! $data->instruction !!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center p-3">
                    <div class="col-sm-12">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5 class="mb-5">Repair Report</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        Tangerang,
                        {{ \Carbon\Carbon::parse($data->tgl)->format('d F Y') }}
                        <br />
                        <p class="fw-bold">PT. Name</p>
                        <br />
                        <br />
                        <br />
                        <br />
                        (----------------------------) <br />
                        <p class="ms-4">Service advisor</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
