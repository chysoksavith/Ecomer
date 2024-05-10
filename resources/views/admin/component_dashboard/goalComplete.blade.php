<div class="col-md-3">

    <div class="info-box mb-3 bg-warning">
        <span class="info-box-icon"><i class="fas fa-tag"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Inventory</span>
            <span class="info-box-number">{{ $totalInventory }}</span>
        </div>

    </div>

</div>
<div class="col-md-6">
    <p class="text-center">
        <strong>Goal Completion</strong>
    </p>
    <div class="progress-group">
        Visit Page
        <span class="float-right"><b>{{ $visitData['page_visits_count'] ?? 0 }}</b>/100000</span>
        <div class="progress progress-sm">
            <div class="progress-bar bg-success"
                style="width: {{ (($visitData['page_visits_count'] ?? 0) / 100000) * 100 }}%"></div>
        </div>
    </div>

    <div class="progress-group">
        User Goal
        <span class="float-right"><b>{{ $userCount }}</b>/1000</span>
        <div class="progress progress-sm">
            <div class="progress-bar bg-success" style="width: {{ ($userCount / 1000) * 100 }}%"></div>
        </div>
    </div>
    <div class="progress-group">
        Add Products to Cart
        <span class="float-right"><b>{{ $goalAddToCart }}</b>/200</span>
        <div class="progress progress-sm">
            <div class="progress-bar bg-primary" style="width: {{ ($goalAddToCart / 200) * 100 }}%"></div>
        </div>
    </div>
    <div class="progress-group">
        Complete Purchase
        <span class="float-right"><b>{{ $completePurchase }}</b>/200</span>
        <div class="progress progress-sm">
            <div class="progress-bar bg-danger" style="width: {{ ($completePurchase / 200) * 100 }}%"></div>
        </div>
    </div>

</div>
