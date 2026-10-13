<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-poke col-md-8 mx-auto">
    <div class="card-header card-poke-header"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Product</div>
    <div class="card-body">
        <form action="<?= site_url('products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?= old('name', $product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price (₱)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= old('price', $product['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" value="<?= old('stock_quantity', $product['stock_quantity']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Product Image</label>
                <?php if ($product['image']): ?>
                    <div class="mb-2">
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" width="80" class="rounded border">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-poke-red">Update Product</button>
            <a href="<?= site_url('products') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>