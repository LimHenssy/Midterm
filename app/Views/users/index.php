<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fa-solid fa-user-gear text-danger"></i> PokéCenter Staff Management</h2>
    <a href="<?= site_url('users/create') ?>" class="btn btn-poke-red"><i class="fa-solid fa-plus"></i> Add New Staff</a>
</div>

<div class="card card-poke">
    <div class="card-body p-0">
        <table class="table table-hover table-poke mb-0 align-middle">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td>
                        <?php if ($u['avatar']): ?>
                            <img src="<?= base_url('uploads/avatars/' . $u['avatar']) ?>" class="user-avatar">
                        <?php else: ?>
                            <i class="fa-solid fa-circle-user fa-2x text-danger"></i>
                        <?php endif; ?>
                    </td>
                    <td class="fw-bold">@<?= esc($u['username']) ?></td>
                    <td><?= esc($u['full_name']) ?></td>
                    <td><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                    <td>
                        <a href="<?= site_url('users/edit/' . $u['id']) ?>" class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pen"></i></a>
                        <?php if (session()->get('user_id') != $u['id']): ?>
                            <a href="<?= site_url('users/delete/' . $u['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove staff account?')"><i class="fa-solid fa-trash"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>