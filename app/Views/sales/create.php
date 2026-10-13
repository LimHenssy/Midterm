<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="poke-card p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-danger text-white rounded-3 p-2 me-3">
                    <i class="fa-solid fa-cash-register fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold m-0 text-dark">Record New Sale</h4>
                    <small class="text-muted">Process a transaction and automatically deduct inventory stock</small>
                </div>
            </div>

            <form action="<?= site_url('sales/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary small">SELECT PRODUCT / ITEM</label>
                    <select name="product_id" class="form-select form-select-lg rounded-3 fs-6" required>
                        <option value="">-- Choose Item --</option>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>">
                                <?= esc($p['name']) ?> — ₱<?= number_format($p['price'], 2) ?> (In Stock: <?= $p['stock_quantity'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary small">TRAINER / CUSTOMER (OPTIONAL)</label>
                    <select name="customer_id" class="form-select form-select-lg rounded-3 fs-6">
                        <option value="">-- Guest Trainer --</option>
                        <?php foreach ($customers as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= esc($c['full_name']) ?> (<?= esc($c['email']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary small">QUANTITY TO PURCHASE</label>
                    <input type="number" name="quantity" class="form-control form-control-lg rounded-3 fs-6" min="1" value="1" required>
                </div>

                <button type="submit" class="btn btn-poke-red btn-lg w-100 py-3 fw-bold">
                    <i class="fa-solid fa-check-circle me-2"></i> Complete Sale
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>