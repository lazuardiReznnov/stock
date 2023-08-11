<div>
    <div class="card info-card sales-card">
        <div class="card-body">
            <?php 
              $date_now = date("Y/m/d")
             ?>
            <h5 class="card-title">
                Maintenance
                <span
                    >|
                    {{ \Carbon\Carbon::parse($date_now)->format('M Y') }}</span
                >
            </h5>

            <div class="d-flex align-items-center">
                <div
                    class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                >
                    <i class="bi bi-tools"></i>
                </div>
                <div class="ps-3">
                    <h6>This Month : {{ $countMounth->count() }} Unit</h6>
                    <span class="text-success small pt-1 fw-bold"
                        >Maintenance Total : {{ $counts }}</span
                    >
                </div>
            </div>
        </div>
    </div>
</div>
