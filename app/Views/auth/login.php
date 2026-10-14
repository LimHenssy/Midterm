<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCenter POS - Staff Access Portal</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --poke-red: #EE1515;
            --poke-red-hover: #D01111;
            --poke-yellow: #FFC72C;
            --poke-dark: #1E2229;
            --poke-bg-gradient: linear-gradient(135deg, #FF385C 0%, #EE1515 45%, #B30000 100%);
        }

        body {
            background: var(--poke-bg-gradient);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin: 0;
        }

        /* Ambient PokéBall Background Elements */
        .bg-pokeball-decor {
            position: absolute;
            width: 500px;
            height: 500px;
            border: 50px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            top: -150px;
            right: -150px;
            pointer-events: none;
        }

        .bg-pokeball-decor::after {
            content: '';
            position: absolute;
            top: 50%;
            left: -50px;
            width: 500px;
            height: 50px;
            background: rgba(255, 255, 255, 0.06);
            transform: translateY(-50%);
        }

        .bg-circle-yellow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,199,44,0.25) 0%, rgba(255,199,44,0) 70%);
            bottom: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        /* Login Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2.2rem;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
        }

        /* PokéBall Logo Header */
        .brand-icon-wrapper {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, #EE1515 0%, #C00B0B 100%);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            box-shadow: 0 10px 20px rgba(238, 21, 21, 0.35);
            border: 3px solid var(--poke-yellow);
            margin-bottom: 1.2rem;
        }

        .form-label-custom {
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: #64748B;
            margin-bottom: 0.4rem;
        }

        /* Modern Input Group */
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            color: #94A3B8;
            font-size: 1.05rem;
            z-index: 5;
            transition: color 0.2s ease;
        }

        .form-control-custom {
            background-color: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-radius: 14px;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--poke-dark);
            width: 100%;
            transition: all 0.25s ease;
        }

        .form-control-custom:focus {
            background-color: #FFFFFF;
            border-color: var(--poke-red);
            box-shadow: 0 0 0 4px rgba(238, 21, 21, 0.12);
            outline: none;
        }

        .form-control-custom:focus + .input-icon {
            color: var(--poke-red);
        }

        .toggle-password-btn {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94A3B8;
            cursor: pointer;
            z-index: 5;
            padding: 0;
        }

        .toggle-password-btn:hover {
            color: var(--poke-dark);
        }

        /* Action Button */
        .btn-login-submit {
            background: linear-gradient(135deg, #EE1515 0%, #D01111 100%);
            color: #FFFFFF;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 0.2px;
            border: none;
            border-radius: 14px;
            padding: 0.9rem;
            width: 100%;
            box-shadow: 0 8px 20px rgba(238, 21, 21, 0.35);
            transition: all 0.25s ease;
        }

        .btn-login-submit:hover {
            background: linear-gradient(135deg, #D01111 0%, #B30000 100%);
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(238, 21, 21, 0.45);
        }

        .btn-login-submit:active {
            transform: translateY(0);
        }

        .badge-system {
            background-color: #FFF9E6;
            color: #997A00;
            border: 1px solid rgba(255, 199, 44, 0.5);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
        }
    </style>
</head>
<body>

<!-- Ambient Background Effects -->
<div class="bg-pokeball-decor"></div>
<div class="bg-circle-yellow"></div>

<!-- Login Card -->
<div class="login-card">
    <div class="text-center">
        <div class="brand-icon-wrapper">
            <i class="fa-solid fa-compact-disc fs-2"></i>
        </div>
        <h3 class="fw-extrabold text-dark m-0" style="letter-spacing: -0.5px;">PokéCenter <span class="text-danger">POS</span></h3>
        <p class="text-muted small mt-1 mb-3">Staff Management Portal</p>
        <span class="badge-system mb-4 d-inline-block"><i class="fa-solid fa-shield-halved me-1"></i> Authorized Personnel Only</span>
    </div>

    <!-- Error Alert -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 rounded-3 py-2 px-3 mb-3 small d-flex align-items-center" style="background-color: #FFEFEF; color: #D01111;">
            <i class="fa-solid fa-circle-exclamation me-2 fs-6"></i>
            <span><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Username Input -->
        <div class="mb-3.5 mb-3">
            <label class="form-label-custom">Staff Username</label>
            <div class="input-group-custom">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" name="username" class="form-control-custom" placeholder="e.g. admin" value="<?= old('username') ?>" required autofocus autocomplete="username">
            </div>
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label class="form-label-custom">Password</label>
            <div class="input-group-custom">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" id="passwordInput" name="password" class="form-control-custom" placeholder="••••••••" required>
                <button type="button" class="toggle-password-btn" onclick="togglePasswordVisibility()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-login-submit">
            <span>Log In to Terminal</span>
            <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
        </button>
    </form>

    <div class="text-center mt-4 pt-2 border-top">
        <small class="text-muted" style="font-size: 0.78rem;">
            PokéCenter POS &bull; Version 1.0 (Render Build)
        </small>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>
