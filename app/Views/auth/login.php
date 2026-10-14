<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCenter POS &bull; Terminal Access</title>
    <!-- Google Fonts & FontAwesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --poke-red: #EE1515;
            --poke-red-dark: #C00B0B;
            --poke-yellow: #FFC72C;
            --poke-dark: #12161A;
            --poke-text-sub: #64748B;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--poke-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        /* Modern Gradient Ambient Glows */
        .ambient-glow-1 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(238, 21, 21, 0.28) 0%, rgba(238, 21, 21, 0) 70%);
            top: -200px;
            right: -150px;
            border-radius: 50%;
            pointer-events: none;
            animation: pulseGlow 8s infinite alternate ease-in-out;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 199, 44, 0.18) 0%, rgba(255, 199, 44, 0) 70%);
            bottom: -200px;
            left: -150px;
            border-radius: 50%;
            pointer-events: none;
            animation: pulseGlow 10s infinite alternate-reverse ease-in-out;
        }

        @keyframes pulseGlow {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.2); opacity: 1; }
        }

        /* Decorative Background PokéBall Silhouette */
        .pokeball-bg-svg {
            position: absolute;
            width: 650px;
            height: 650px;
            opacity: 0.03;
            color: #FFFFFF;
            pointer-events: none;
            right: -100px;
            bottom: -100px;
        }

        /* Glassmorphism Portal Container */
        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 28px;
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.55), 
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 440px;
            padding: 2.75rem 2.5rem;
            position: relative;
            z-index: 10;
        }

        /* PokéBall Terminal Emblem */
        .emblem-wrapper {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--poke-red) 0%, var(--poke-red-dark) 100%);
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            box-shadow: 0 12px 24px rgba(238, 21, 21, 0.35);
            border: 3.5px solid var(--poke-yellow);
            position: relative;
            margin-bottom: 1.25rem;
        }

        .emblem-wrapper i {
            font-size: 2.2rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .status-pill {
            background-color: #FFF9E6;
            color: #856404;
            border: 1px solid rgba(255, 199, 44, 0.6);
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.4px;
            padding: 0.4rem 0.9rem;
            border-radius: 30px;
            text-transform: uppercase;
        }

        /* Form Control Styling */
        .field-label {
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--poke-text-sub);
            margin-bottom: 0.45rem;
            display: block;
        }

        .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-box i.input-icon {
            position: absolute;
            left: 18px;
            color: #A0AEC0;
            font-size: 1.1rem;
            transition: color 0.25s ease;
            z-index: 5;
        }

        .form-control-sleek {
            background-color: #F8FAFC;
            border: 1.8px solid #E2E8F0;
            border-radius: 16px;
            padding: 0.85rem 1rem 0.85rem 3rem;
            font-size: 0.98rem;
            font-weight: 600;
            color: #1E293B;
            width: 100%;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-sleek:focus {
            background-color: #FFFFFF;
            border-color: var(--poke-red);
            box-shadow: 0 0 0 4px rgba(238, 21, 21, 0.12);
            outline: none;
        }

        .form-control-sleek:focus + i.input-icon {
            color: var(--poke-red);
        }

        .toggle-pwd {
            position: absolute;
            right: 16px;
            background: transparent;
            border: none;
            color: #A0AEC0;
            cursor: pointer;
            z-index: 5;
            padding: 0;
            font-size: 1.05rem;
            transition: color 0.2s ease;
        }

        .toggle-pwd:hover {
            color: #1E293B;
        }

        /* Action Button */
        .btn-poke-login {
            background: linear-gradient(135deg, #EE1515 0%, #D01111 100%);
            color: #FFFFFF;
            font-weight: 800;
            font-size: 1rem;
            border: none;
            border-radius: 16px;
            padding: 0.95rem;
            width: 100%;
            box-shadow: 0 10px 22px rgba(238, 21, 21, 0.35);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .btn-poke-login:hover {
            background: linear-gradient(135deg, #D01111 0%, #B30000 100%);
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(238, 21, 21, 0.45);
        }

        .btn-poke-login:active {
            transform: translateY(0);
        }

        .alert-custom {
            background-color: #FEF2F2;
            border: 1px solid #FEE2E2;
            color: #991B1B;
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Ambient Backlights -->
<div class="ambient-glow-1"></div>
<div class="ambient-glow-2"></div>

<!-- Background PokéBall Outline -->
<svg class="pokeball-bg-svg" viewBox="0 0 100 100" fill="currentColor">
    <path d="M 50 0 A 50 50 0 0 0 2 45 L 35 45 A 16 16 0 0 1 65 45 L 98 45 A 50 50 0 0 0 50 0 Z M 50 100 A 50 50 0 0 0 98 55 L 65 55 A 16 16 0 0 1 35 55 L 2 55 A 50 50 0 0 0 50 100 Z M 50 38 A 12 12 0 1 0 50 62 A 12 12 0 1 0 50 38 Z"/>
</svg>

<!-- Main Login Glass Card -->
<div class="login-card">
    
    <!-- Branding Header -->
    <div class="text-center mb-4">
        <div class="emblem-wrapper">
            <i class="fa-solid fa-compact-disc"></i>
        </div>
        <h3 class="fw-extrabold text-dark m-0" style="letter-spacing: -0.6px; font-size: 1.75rem;">
            PokéCenter <span style="color: var(--poke-red);">POS</span>
        </h3>
        <p class="text-muted small mt-1 mb-3">Official Staff Management Terminal</p>
        <span class="status-pill">
            <i class="fa-solid fa-shield-halved me-1"></i> Staff Authentication
        </span>
    </div>

    <!-- Flash Error Alert -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-custom py-2.5 px-3 mb-4 d-flex align-items-center">
            <i class="fa-solid fa-circle-exclamation me-2 fs-6"></i>
            <span><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Username Input -->
        <div class="mb-3.5 mb-3">
            <label class="field-label">Username</label>
            <div class="input-box">
                <input type="text" name="username" class="form-control-sleek" placeholder="e.g. admin" value="<?= old('username') ?>" required autofocus autocomplete="username">
                <i class="fa-solid fa-user input-icon"></i>
            </div>
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label class="field-label">Password</label>
            <div class="input-box">
                <input type="password" id="passField" name="password" class="form-control-sleek" placeholder="••••••••" required>
                <i class="fa-solid fa-lock input-icon"></i>
                <button type="button" class="toggle-pwd" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-poke-login d-flex align-items-center justify-content-center">
            <span>Log In to Terminal</span>
            <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
        </button>
    </form>

    <!-- Footer Tagline -->
    <div class="text-center mt-4 pt-3 border-top">
        <span class="text-muted" style="font-size: 0.78rem; font-weight: 500;">
            <i class="fa-solid fa-circle text-success me-1" style="font-size: 0.5rem;"></i> PokéCenter POS System &bull; Active Node
        </span>
    </div>
</div>

<script>
    function togglePassword() {
        const passField = document.getElementById('passField');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passField.type === 'password') {
            passField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>
