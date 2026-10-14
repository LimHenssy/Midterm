<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --poke-red: #EE1515;
        --poke-red-hover: #D01111;
        --poke-yellow: #FFC72C;
        --poke-dark: #1E2229;
        --poke-card-bg: rgba(255, 255, 255, 0.92);
    }

    /* Header & Stats Banner */
    .pos-hero-banner {
        background: linear-gradient(135deg, #EE1515 0%, #C00B0B 100%);
        border-radius: 24px;
        padding: 2rem 2.5rem;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(238, 21, 21, 0.25);
        margin-bottom: 2rem;
    }

    .pos-hero-banner::after {
        content: '';
        position: absolute;
        right: -60px;
        top: -60px;
        width: 280px;
        height: 280px;
        border: 35px solid rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    .stat-card-glass {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 18px;
        padding: 1.25rem 1.5rem;
        color: #FFFFFF;
        transition: transform 0.25s ease;
    }

    .stat-card-glass:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.22);
    }

    /* Product Grid Cards */
    .product-grid-card {
        background: var(--poke-card-bg);
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-grid-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px -10px rgba(238, 21, 21, 0.18);
        border-color: rgba(238, 21, 21, 0.4);
    }

    .product-img-wrapper {
        background: radial-gradient(circle, #F8FAFC 0%, #EDF2F7 100%);
        padding: 1.8rem;
        text-align: center;
        position: relative;
        min-height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img-wrapper img {
        max-height: 110px;
        width: auto;
        filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.15));
        transition: transform 0.3s ease;
    }

    .product-grid-card:hover .product-img-wrapper img {
        transform: scale(1.12) rotate(3deg);
    }

    .price-pill {
        background-color: var(--poke-dark);
        color: var(--poke-yellow);
        font-weight: 800;
        font-size: 0.95rem;
        padding: 0.35rem 0.85rem;
        border-radius: 30px;
        letter-spacing: 0.3px;
    }

    .stock-badge-low {
        background-color: #FFFBEB;
        color: #D97706;
        border: 1px solid #FDE68A;
    }

    .stock-badge-ok {
        background-color: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }

    .stock-badge-out {
        background-color: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
    }

    /* Action Buttons */
    .btn-poke-primary {
        background: linear-gradient(135deg, #EE1515 0%, #D01111 100%);
        color: #FFFFFF;
        font-weight: 700;
        border-radius: 12px;
        padding: 0.6rem 1.2rem;
        border: none;
        box-shadow: 0 4px 12px rgba(238, 21, 21, 0.25);
        transition: all 0.2s ease;
    }

    .btn-poke-primary:hover {
        background: linear-gradient(135deg, #D01111 0%, #B30000 100%);
        color: #FFFFFF;
        transform: translateY(-2px);
    }

    /* Filter Controls */
    .search-filter-box {
        background: #FFFFFF;
        border-radius: 18px;
        padding: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        margin-bottom: 2rem;
    }
</style>

<div class="container-fluid px-4 py-3">

    <!-- Top Hero Metrics Banner -->
    <div class="pos-hero-banner">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <span class="badge bg-white text-danger font-weight-bold px-3 py-2 mb-2 rounded-pill shadow-sm" style="font-size: 0.78rem; font-weight: 800;">
                    <i class="fa-solid fa-circle-dot text-danger me-1"></i> LIVE TERMINAL INVENTORY
                </span>
                <h2 class="fw-extrabold m-0 text-white" style="letter-spacing: -0.5px; font-size: 2.1rem;">PokéCenter Store Catalog</h2>
                <p class="text-white-50 m-0 mt-1">Manage essential trainer supplies, medicine, and Poké Balls in real time.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-4">
                        <div class="stat-card-glass text-center">
                            <span class="d-block text-white-50 small fw-bold text-uppercase">Total Items</span>
                            <span class="fs-3 fw-bold text-white"><?= count($products ?? []) ?></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card-glass text-center">
                            <span class="d-block text-white-50 small fw-bold text-uppercase">Low Stock</span>
                            <span class="fs-3 fw-bold text-warning">
                                <?php 
                                    $lowStock = array_filter($products ?? [], function($p) { return $p['stock_quantity'] <= 15; });
                                    echo count($lowStock);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card-glass text-center">
                            <span class="d-block text-white-50 small fw-bold text-uppercase">System Status</span>
                            <span class="fs-6 fw-bold text-emerald text-white d-block mt-1"><i class="fa-solid fa-signal text-warning me-1"></i> Online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="search-filter-box">
        <div class="row g-3 align-items-center">
            <div class="col-md-6 col-lg-7">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" id="productSearchInput" class="form-control bg-light border-0 py-2.5" placeholder="Search item name (e.g., Ultra Ball, Max Potion)..." onkeyup="filterProducts()">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 text-end d-flex justify-content-end gap-2">
                <a href="<?= site_url('sales/create') ?>" class="btn btn-poke-primary d-inline-flex align-items-center">
                    <i class="fa-solid fa-cart-shopping me-2"></i> Record New Sale
                </a>
                <a href="<?= site_url('products/create') ?>" class="btn btn-outline-dark rounded-3 font-weight-bold d-inline-flex align-items-center" style="border-radius: 12px !important;">
                    <i class="fa-solid fa-plus me-1.5"></i> Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row g-4" id="productGridContainer">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-12 col-sm-6 col-md-4 col-xl-3 product-item-card" data-name="<?= strtolower(esc($product['name'])) ?>">
                    <div class="product-grid-card">
                        
                        <!-- Image Area -->
                        <div class="product-img-wrapper">
                            <span class="position-absolute top-0 start-0 m-3 price-pill">
                                ₱<?= number_format($product['price'], 2) ?>
                            </span>
                            <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" onerror="this.src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png';">
                        </div>

                        <!-- Info Area -->
                        <div class="p-3.5 p-3 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;"><?= esc($product['name']) ?></h5>
                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <span class="small text-muted fw-semibold">Stock Quantity:</span>
                                    
                                    <?php 
                                        $qty = $product['stock_quantity'];
                                        $badgeClass = 'stock-badge-ok';
                                        if ($qty <= 0) $badgeClass = 'stock-badge-out';
                                        elseif ($qty <= 15) $badgeClass = 'stock-badge-low';
                                    ?>
                                    <span class="badge rounded-pill px-2.5 py-1.5 fw-bold <?= $badgeClass ?>" style="font-size: 0.8rem;">
                                        <i class="fa-solid fa-boxes-stacked me-1"></i> <?= $qty ?> units
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="border-top pt-3 mt-3 d-flex gap-2">
                                <a href="<?= site_url('sales/create?product_id=' . $product['id']) ?>" class="btn btn-sm btn-poke-primary flex-grow-1 text-center py-2">
                                    <i class="fa-solid fa-cash-register me-1"></i> Sell Item
                                </a>
                                <a href="<?= site_url('products/edit/' . $product['id']) ?>" class="btn btn-sm btn-light border py-2 px-3 text-secondary rounded-3" title="Edit Item">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-box-open text-muted fs-1 mb-3"></i>
                <h5 class="text-secondary fw-bold">No Products Found in Inventory</h5>
                <p class="text-muted small">Try seeding your database or adding a new item.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- Client-side Fast Search Script -->
<script>
    function filterProducts() {
        const query = document.getElementById('productSearchInput').value.toLowerCase();
        const cards = document.querySelectorAll('.product-item-card');
        
        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            if (name.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<?= $this->endSection() ?>
