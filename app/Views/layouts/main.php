<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCenter POS</title>
    <!-- Modern Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --poke-red: #EE1515;
            --poke-red-hover: #D01111;
            --poke-red-light: #FFF0F0;
            --poke-yellow: #FFC72C;
            --poke-yellow-light: #FFF9E6;
            --poke-dark: #1E2229;
            --poke-gray: #64748B;
            --poke-bg: #F8FAFC;
            --poke-card-bg: #FFFFFF;
        }

        body {
            background-color: var(--poke-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--poke-dark);
        }

        /* Modern Glass/Gradient Navbar */
        .navbar-pokemon {
            background: linear-gradient(135deg, #EE1515 0%, #C00B0B 100%);
            border-bottom: 4px solid var(--poke-yellow);
            box-shadow: 0 10px 25px -5px rgba(238, 21, 21, 0.25);
            padding: 0.8rem 1rem;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #FFFFFF !important;
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.88) !important;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 0.5rem 0.9rem !important;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            color: var(--poke-yellow) !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        /* Modern Floating Cards */
        .poke-card {
            background: var(--poke-card-bg);
            border: 1px solid rgba(238, 21, 21, 0.08);
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .poke-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(238, 21, 21, 0.12);
            border-color: rgba(238, 21, 21, 0.2);
        }

        /* Buttons */
        .btn-poke-red {
            background-color: var(--poke-red);
            color: #FFFFFF;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.3rem;
            box-shadow: 0 4px 12px rgba(238, 21, 21, 0.25);
            transition: all 0.2s ease;
        }

        .btn-poke-red:hover {
            background-color: var(--poke-red-hover);
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(238, 21, 21, 0.35);
        }

        .btn-poke-yellow {
            background-color: var(--poke-yellow);
            color: #1E2229;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            box-shadow: 0 4px 12px rgba(255, 199, 44, 0.3);
            transition: all 0.2s ease;
        }

        .btn-poke-yellow:hover {
            background-color: #F0B81D;
            color: #000;
            transform: translateY(-1px);
        }

        /* Modern Table Styling */
        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            background-color: var(--poke-yellow-light);
            color: #8A6D00;
            font-weight: 700;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 1rem 1.2rem;
            border-bottom: 2px solid rgba(255, 199, 44, 0.3);
        }

        .table-modern tbody td {
            padding: 1.1rem 1.2rem;
            vertical-align: middle;
            color: var(--poke-dark);
            border-bottom: 1px solid #F1F5F9;
        }

        /* Badges */
        .badge-poke-yellow {
            background-color: var(--poke-yellow-light);
            color: #997A00;
            font-weight: 700;
            border: 1px solid rgba(255, 199, 44, 0.4);
            padding: 0.4em 0.8em;
            border-radius: 8px;
        }

        .badge-poke-red {
            background-color: var(--poke-red-light);
            color: var(--poke-red);
            font-weight: 700;
            border: 1px solid rgba(238, 21, 21, 0.2);
            padding: 0.4em 0.8em;
            border-radius: 8px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 2px solid var(--poke-yellow);
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-pokemon sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand fs-4 d-flex align-items-center" href="<?= site_url('products') ?>">
            <span class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-compact-disc fs-5"></i>
            </span>
            PokéCenter<span class="text-warning ms-1">POS</span>
        </a>
        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fa-solid fa-bars fs-4"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (session()->get('isLoggedIn')): ?>
            <ul class="navbar-nav me-auto ms-lg-4 gap-1">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= site_url('products') ?>"><i class="fa-solid fa-box me-1"></i> Products</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= site_url('customers') ?>"><i class="fa-solid fa-users me-1"></i> Trainers</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= site_url('users') ?>"><i class="fa-solid fa-user-gear me-1"></i> Staff</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= site_url('sales/record') ?>"><i class="fa-solid fa-cart-shopping me-1"></i> Record Sale</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= site_url('sales') ?>"><i class="fa-solid fa-receipt me-1"></i> History</a></li>
            </ul>
            <div class="d-flex align-items-center bg-white bg-opacity-10 py-1 px-3 rounded-4 backdrop-blur">
                <?php if (session()->get('avatar')): ?>
                    <img src="<?= base_url('uploads/avatars/' . session()->get('avatar')) ?>" class="user-avatar me-2">
                <?php else: ?>
                    <div class="user-avatar bg-warning d-flex align-items-center justify-content-center me-2 text-dark fw-bold">
                        <?= strtoupper(substr(session()->get('username') ?? 'U', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div class="me-3 text-white">
                    <div class="fw-bold lh-1" style="font-size: 0.9rem;"><?= session()->get('full_name') ?></div>
                    <small class="text-warning opacity-75" style="font-size: 0.72rem;">Staff Member</small>
                </div>
                <a href="<?= site_url('logout') ?>" class="btn btn-sm btn-poke-yellow"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class="container mb-5">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center mb-4" style="background: #EAFBF1; color: #0D7A3E;">
            <i class="fa-solid fa-circle-check fs-5 me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 d-flex align-items-center mb-4" style="background: #FFEFEF; color: #D01111;">
            <i class="fa-solid fa-circle-exclamation fs-5 me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>