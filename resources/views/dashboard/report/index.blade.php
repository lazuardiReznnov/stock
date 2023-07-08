<x-dashboard>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="home" />
            <x-breadcrumb-item link="" name="Report" />
        </x-breadcrumb>
    </x-pagetitle>

    <!-- End Page Title -->
    <x-section>
        <div class="row">
            <div class="col-lg-6">
                <x-card>
                    <x-card-title> Letter </x-card-title>

                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Ullam, ut?
                    </p>
                    <x-button-group>
                        <x-button-link
                            class="btn-primary"
                            href="/dashboard/report/letter/vrc"
                        >
                            Vehicle Registration Certificate
                        </x-button-link>
                        <x-button-link
                            class="btn-primary"
                            href="/dashboard/report/letter/vpic"
                        >
                            VEHICLE PER'ODICAL IN SPECII ON CARD
                        </x-button-link>
                    </x-button-group>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card>
                    <x-card-title> Unit </x-card-title>

                    <p>Unit</p>
                </x-card>
            </div>
        </div>
    </x-section>
</x-dashboard>
