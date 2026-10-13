<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header">Add New Product</div>
    <div class="card-body">
        <form action="<?= site_url('products/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required placeholder="e.g. Ultra Ball">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price (₱)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= old('price') ?>" required placeholder="1200.00">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" value="<?= old('stock_quantity') ?>" required placeholder="20">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-poke-red">Save Product</button>
            <a href="<?= site_url('products') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>