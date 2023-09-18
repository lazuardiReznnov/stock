<div>
    <x-card>
        <x-card-header>
            <div class="row my-3 justify-content-between">
                <div class="col-md-6">
                    <div class="search-bar">
                        <input
                            type="month"
                            class="form-control"
                            name="search"
                            placeholder="Search"
                            title="Enter search keyword"
                            wire:model="search"
                        />
                    </div>
                </div>
            </div>
        </x-card-header>
        <x-card-body>
            <table class="table table-striped my-3 table-sm fs-6">
                <thead>
                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">Date</th>
                        <th scope="col">No. Reg</th>

                        <th scope="col">Descrption</th>

                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($datas->count()) @foreach($datas as $data)
                    <tr>
                        <th scope="row">
                            {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                        </th>
                        <td width="90px">
                            {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                        </td>
                        <td width="50px">{{ $data->name }}</td>

                        <td width="300px">{!! $data->description !!}</td>

                        <td>
                            <div class="progress">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: {{ $data->progress }}%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                >
                                    {{ $data->progress }}%
                                </div>
                            </div>
                        </td>

                        <td>
                            <a
                                href="/dashboard/maintenance/{{ $data->slug }}"
                                class="badge bg-success"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Detail maintenance"
                                ><i class="bi bi-eye"></i
                            ></a>
                        </td>
                        <!-- Modal Image -->
                    </tr>
                    @endforeach
                    <!-- Modal -->

                    <!-- End Modal Image -->
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Data Not Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-8">
                    {{ $datas->links() }}
                </div>
            </div>
        </x-card-body>
    </x-card>
</div>
