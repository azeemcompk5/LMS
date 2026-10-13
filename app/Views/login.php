<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MySchoolHub</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: #f5f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.10);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-info {
            background: #111827;
            color: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-info::before {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            background: #2563eb;
            opacity: 0.12;
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .login-info::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: #2563eb;
            opacity: 0.10;
            border-radius: 50%;
            bottom: -70px;
            left: -60px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 35px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .brand-name {
            font-size: 25px;
            font-weight: 700;
        }

        .login-info h2 {
            font-size: 32px;
            line-height: 1.25;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .login-info p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            max-width: 390px;
            position: relative;
            z-index: 1;
        }

        .features {
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            color: #e2e8f0;
            font-size: 14px;
        }

        .feature i {
            color: #60a5fa;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-section {
            padding: 55px;
            display: flex;
            align-items: center;
        }

        .login-content {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #111827;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 14px;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
            transition: 0.2s ease;
            color: #1e293b;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
            margin-top: 5px;
        }

        .login-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.20);
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .login-info {
                padding: 35px;
                min-height: 280px;
            }

            .login-info h2 {
                font-size: 26px;
            }

            .features {
                display: none;
            }

            .login-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 500px) {

            body {
                padding: 15px;
            }

            .login-info {
                padding: 30px 25px;
            }

            .login-section {
                padding: 30px 25px;
            }

            .login-info h2 {
                font-size: 24px;
            }

            .brand-name {
                font-size: 22px;
            }
        }

    </style>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->

    <div class="login-info">

        <div class="brand">

            <div class="brand-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div class="brand-name">
                MySchoolHub
            </div>

        </div>

        <h2>
            Manage Your School Smarter
        </h2>

        <p>
            A complete school management system to manage
            students, teachers, attendance, fees, exams,
            results and more from one place.
        </p>

        <div class="features">

            <div class="feature">
                <i class="fa-solid fa-circle-check"></i>
                Student & Teacher Management
            </div>

            <div class="feature">
                <i class="fa-solid fa-circle-check"></i>
                Attendance & Fee Management
            </div>

            <div class="feature">
                <i class="fa-solid fa-circle-check"></i>
                Exams, Results & Reports
            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="login-section">

        <div class="login-content">

            <div class="login-header">

                <h1>
                    Welcome Back
                </h1>

                <p>
                    Sign in to access your MySchoolHub dashboard.
                </p>

            </div>


            <?php if (session()->getFlashdata('error')): ?>

                <div class="error">

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            <?php endif; ?>


            <form
                action="<?= base_url('login/authenticate') ?>"
                method="post"
            >

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    class="login-btn"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>
                    &nbsp; Login
                </button>

            </form>


            <div class="footer">

                © <?= date('Y') ?> MySchoolHub.
                All rights reserved.

            </div>

        </div>

    </div>

</div>

</body>
</html>