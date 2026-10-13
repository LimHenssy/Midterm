<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header"><i class="fa-solid fa-user-plus me-2"></i>Add Staff Member</div>
    <div class="card-body">
        <form action="<?= site_url('users/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required placeholder="e.g. nurse_joy">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= old('full_name') ?>" required placeholder="e.g. Nurse Joy (Viridian)">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimum 6 characters">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Avatar Image</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-poke-red">Save Staff Account</button>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>