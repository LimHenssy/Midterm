<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header"><i class="fa-solid fa-user-pen me-2"></i>Edit Staff Member</div>
    <div class="card-body">
        <form action="<?= site_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username', $user['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= old('full_name', $user['full_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password <small class="text-muted">(Leave blank if unchanged)</small></label>
                <input type="password" name="password" class="form-control" placeholder="New password">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Avatar Image</label>
                <?php if ($user['avatar']): ?>
                    <div class="mb-2">
                        <img src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>" width="60" class="rounded border">
                    </div>
                <?php endif; ?>
                <input type="file" name="avatar" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-poke-red">Update Staff Account</button>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>