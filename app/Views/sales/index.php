<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-extrabold text-danger m-0"><i class="fa-solid fa-receipt me-2"></i>Sales History</h3>
        <p class="text-muted small m-0">View all past transactions and cashier logs</p>
    </div>
    <a href="<?= site_url('sales/record') ?>" class="btn btn-poke-red"><i class="fa-solid fa-plus me-1"></i> Record Sale</a>
</div>

<div class="poke-card">
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Product Item</th>
                    <th>Customer (Trainer)</th>
                    <th>Qty</th>
                    <th>Total Amount</th>
                    <th>Processed By</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sales)): ?>
                    <?php foreach ($sales as $s): ?>
                    <tr>
                        <td class="text-muted small fw-semibold">
                            <?= date('M d, Y • h:i A', strtotime($s['created_at'])) ?>
                        </td>
                        <td class="fw-bold text-dark"><?= esc($s['product_name']) ?></td>
                        <td><?= esc($s['customer_name'] ?? 'Guest Trainer') ?></td>
                        <td><span class="badge bg-light text-dark border px-3 py-2"><?= $s['quantity'] ?></span></td>
                        <td class="fw-extrabold text-danger fs-6">₱<?= number_format($s['total_price'], 2) ?></td>
                        <td><span class="badge badge-poke-yellow"><i class="fa-solid fa-user-check me-1"></i><?= esc($s['staff_name']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No transaction logs available yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>