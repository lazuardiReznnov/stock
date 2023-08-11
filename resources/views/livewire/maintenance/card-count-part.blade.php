<div>
    <?php 
    $date_now = date("Y/m/d")
   ?>
    <div class="card info-card revenue-card">
        <div class="card-body">
            <h5 class="card-title">
                Cost
                <span
                    >|
                    {{ \Carbon\Carbon::parse($date_now)->format('M Y') }}</span
                >
            </h5>

            <div class="d-flex align-items-center">
                <div
                    class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                >
                    <i class="bi bi-currency-dollar"></i>
                </div>
                @dd($parts)
                <div class="ps-3">
                    <h6>$3,264</h6>
                    <span class="text-success small pt-1 fw-bold">8%</span>
                    <span class="text-muted small pt-2 ps-1">increase</span>
                </div>
            </div>
        </div>
    </div>
</div>
