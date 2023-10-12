<div>
    <div class="row">
        @include('livewire.employee.division.modal')
        <div class="col-md">
            @if(session()->has('success'))

            <!-- pesan -->

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session("success") }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="close"
                ></button>
            </div>

            <!-- endpesan -->

            @endif
        </div>
    </div>
    <section class="section dashboard">
        <div class="row my-2">
            <div class="col-md-4">
                <x-button-group>
                    <x-button-link class="btn-primary" href="/dashboard">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </x-button-link>
                    <x-button-link
                        class="btn-primary"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#divisionModal"
                    >
                        <i class="bi bi-plus-circle"></i> Division
                    </x-button-link>
                </x-button-group>
            </div>
        </div>
        <h3 class="card-title">Select Division</h3>
        <div class="row">
            @foreach($datas as $d)
            <div class="col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $d->name }}
                        </h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                            >
                                <i class="bi bi-bank"></i>
                            </div>

                            <div class="ps-3">
                                <h6>{{ $d->description }}</h6>
                                <span class="text-success small pt-1 fw-bold"
                                    ><a
                                        href="/dashboard/employee/{{
                                            $d->slug
                                        }}"
                                        >Data</a
                                    >
                                    <a
                                        href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateDivisionModal"
                                        title="Edit Division"
                                        wire:click="editDivision({{ $d->id }})"
                                        >Edit</a
                                    >
                                    <a
                                        href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteDivisionModal"
                                        title="Delete Division"
                                        wire:click="deleteDivision({{ $d->id }})"
                                        >Delete</a
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
