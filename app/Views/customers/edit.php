<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header"><i class="fa-solid fa-user-pen me-2"></i>Edit Trainer Details</div>
    <div class="card-body">
        <form action="<?= site_url('customers/update/' . $customer['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= old('full_name', $customer['full_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= old('email', $customer['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone', $customer['phone']) ?>">
            </div>
            <button type="submit" class="btn btn-poke-red">Update Trainer</button>
            <a href="<?= site_url('customers') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>