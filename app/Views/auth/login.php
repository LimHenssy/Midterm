<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokéCenter POS - Staff Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #EE1515 50%, #FFFFFF 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 380px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            border: 4px solid #FFDE00;
        }
    </style>
</head>
<body>

<div class="card login-card p-4 bg-white">
    <div class="text-center mb-3">
        <h3 class="fw-bold text-danger">PokéCenter POS</h3>
        <p class="text-muted">Staff Access Portal</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2 small"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" name="username" class="form-control" required placeholder="admin">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-danger w-100 fw-bold border-2 border-warning">Log In</button>
    </form>
</div>

</body>
</html>