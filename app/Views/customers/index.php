<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fa-solid fa-users text-danger"></i> Registered Trainers</h2>
    <a href="<?= site_url('customers/create') ?>" class="btn btn-poke-red"><i class="fa-solid fa-user-plus"></i> Register New Trainer</a>
</div>

<div class="card card-poke">
    <div class="card-body p-0">
        <table class="table table-hover table-poke mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $c): ?>
                    <tr>
                        <td>#<?= $c['id'] ?></td>
                        <td class="fw-bold"><?= esc($c['full_name']) ?></td>
                        <td><?= esc($c['email']) ?></td>
                        <td><?= esc($c['phone'] ?? 'N/A') ?></td>
                        <td><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
                        <td>
                            <a href="<?= site_url('customers/edit/' . $c['id']) ?>" class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pen"></i></a>
                            <a href="<?= site_url('customers/delete/' . $c['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove this trainer record?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No trainers registered yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>