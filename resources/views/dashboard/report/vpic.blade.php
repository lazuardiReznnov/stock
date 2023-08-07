<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/report" name="report" />
            <x-breadcrumb-item link="" name="{{ $title }}" />
        </x-breadcrumb>
    </x-pagetitle>

    <?php 
        $date_now = date('dd M Y')
    ?>
    <div class="row my-4">
        <div class="col-md">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard/report">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <form
                    class="search-form d-flex align-items-center"
                    method="GET"
                    action="/dashboard/report/vpic"
                >
                    <input
                        type="month"
                        name="search"
                        placeholder="Search"
                        title="Enter search keyword"
                    />
                    <button type="submit" title="Search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php 
        $date_now = date("Y/m/d")
    
    ?>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title>
                    VPIC Data List -
                    {{ \Carbon\Carbon::parse($date_now)->format('d M Y') }}</x-card-title
                >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Model/Type</th>
                            <th scope="col">Date Registration</th>
                            <th scope="col">Region</th>
                            <th scope="col">Expire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)

                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $data->unit->name }}</td>
                            <td>
                                {{ $data->unit->type->brand->name }}
                                -{{ $data->unit->type->name }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($data->tgl_reg)->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $data->region }}
                            </td>
                            <td>
                                <a
                                    href="/dashboard/report/vpic/expire/{{ $data->unit->slug }}/edit"
                                    class="btn btn-warning"
                                >
                                    <span
                                        class="text-{{ \Lazuardicode::expire($data->expire,$date_now) }}"
                                    >
                                        {{ \Carbon\Carbon::parse($data->expire)->format('d/m/Y') }}
                                    </span>
                                </a>
                            </td>

                            <!-- Modal Image -->
                        </tr>
                        @endforeach @else
                        <tr>
                            <td
                                colspan="6"
                                class="text-center fw-bold text-uppercase"
                            >
                                Empty
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $datas->onEachside(2)->links() }}
        </div>
    </div>
</x-dashboard>
