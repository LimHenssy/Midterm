<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header"><i class="fa-solid fa-user-plus me-2"></i>Register Trainer</div>
    <div class="card-body">
        <form action="<?= site_url('customers/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= old('full_name') ?>" required placeholder="e.g. Ash Ketchum">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="ash@pallettown.org">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" placeholder="e.g. +639123456789">
            </div>
            <button type="submit" class="btn btn-poke-red">Save Trainer</button>
            <a href="<?= site_url('customers') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>