<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Premium Aesthetic Custom Enhancements */
    .inventory-header-icon {
        background: linear-gradient(135deg, #EE1515 0%, #C00B0B 100%);
        box-shadow: 0 6px 15px rgba(238, 21, 21, 0.3);
    }

    .poke-card-modern {
        background: #FFFFFF;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .poke-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px -8px rgba(238, 21, 21, 0.15);
        border-color: rgba(238, 21, 21, 0.25);
    }

    .img-box-wrapper {
        background: radial-gradient(circle at center, #FFFFFF 0%, #FFF5F5 100%);
        border-radius: 18px;
        height: 200px;
        width: 100%;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(238, 21, 21, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .product-img-fit {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.08));
        transition: transform 0.4s ease;
    }

    .poke-card-modern:hover .product-img-fit {
        transform: scale(1.12) rotate(2deg);
    }

    .price-tag {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #EE1515 0%, #990000 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stock-pill-success {
        background-color: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
        font-weight: 700;
    }

    .stock-pill-danger {
        background-color: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        font-weight: 700;
    }

    .btn-action-edit {
        background-color: #FFFBEB;
        color: #D97706;
        border: 1px solid #FDE68A;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-action-edit:hover {
        background-color: #FFC72C;
        color: #1E2229;
        border-color: #FFC72C;
        transform: translateY(-1px);
    }

    .btn-action-delete {
        background-color: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #EE1515;
        color: #FFFFFF;
        border-color: #EE1515;
        transform: translateY(-1px);
    }
</style>

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="inventory-header-icon text-white rounded-4 d-flex align-items-center justify-content-center p-3" style="width: 52px; height: 52px;">
            <i class="fa-solid fa-boxes-stacked fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold text-dark m-0">Inventory Management</h3>
            <p class="text-muted small m-0">Browse, edit, and organize Pokémon Center supplies</p>
        </div>
    </div>
    <a href="<?= site_url('products/create') ?>" class="btn btn-poke-red px-4 py-2 d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus fs-6"></i>
        <span>Add New Item</span>
    </a>
</div>

<!-- Product Cards Grid -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $p): ?>
        <div class="col">
            <div class="poke-card-modern h-100 d-flex flex-column p-3">
                
                <!-- Auto-Adjusting Responsive Image Container -->
                <div class="img-box-wrapper mb-3">
                    <!-- Floating ID Badge -->
                    <span class="position-absolute top-0 start-0 m-2 px-2.5 py-1 badge bg-white text-dark shadow-sm rounded-pill fw-bold border" style="font-size: 0.75rem; z-index: 2;">
                        #<?= sprintf('%03d', $p['id']) ?>
                    </span>

                    <?php if ($p['image']): ?>
                        <img src="<?= base_url('uploads/products/' . $p['image']) ?>" 
                             alt="<?= esc($p['name']) ?>" 
                             class="product-img-fit">
                    <?php else: ?>
                        <div class="text-center text-danger opacity-40">
                            <i class="fa-solid fa-box-open fa-3x mb-2"></i>
                            <div class="small fw-bold">No Image</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Content -->
                <div class="d-flex flex-column flex-grow-1 justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-1 text-truncate" title="<?= esc($p['name']) ?>">
                            <?= esc($p['name']) ?>
                        </h5>
                        <div class="price-tag fs-3 mb-3">
                            ₱<?= number_format($p['price'], 2) ?>
                        </div>
                    </div>

                    <div>
                        <!-- Stock Status Bar -->
                        <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded-3 bg-light">
                            <span class="small text-muted fw-bold">Stock Status</span>
                            <span class="badge rounded-pill px-3 py-1.5 <?= $p['stock_quantity'] > 0 ? 'stock-pill-success' : 'stock-pill-danger' ?>">
                                <i class="fa-solid <?= $p['stock_quantity'] > 0 ? 'fa-check' : 'fa-xmark' ?> me-1"></i>
                                <?= $p['stock_quantity'] ?> left
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('products/edit/' . $p['id']) ?>" class="btn btn-action-edit btn-sm w-100 py-2">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                            </a>
                            <a href="<?= site_url('products/delete/' . $p['id']) ?>" class="btn btn-action-delete btn-sm w-100 py-2" onclick="return confirm('Delete <?= esc($p['name']) ?> from inventory?')">
                                <i class="fa-solid fa-trash-can me-1"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="poke-card-modern text-center py-5 px-4">
                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3 text-danger">
                    <i class="fa-solid fa-box-open fa-3x"></i>
                </div>
                <h4 class="fw-bold text-dark">No Products Found</h4>
                <p class="text-muted mb-4">Your store inventory is currently empty.</p>
                <a href="<?= site_url('products/create') ?>" class="btn btn-poke-red px-4 py-2">
                    <i class="fa-solid fa-plus me-1"></i> Add First Item
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>