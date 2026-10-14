
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'My School Hub' ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* =========================
           APP LAYOUT
        ========================= */

        .app-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 255px;
            min-width: 255px;
            height: 100vh;

            background: #111827;
            color: white;
            padding: 22px 14px;

            flex: 0 0 255px;

            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.08);

            overflow-y: auto;
            overflow-x: hidden;

            position: relative;
            z-index: 100;

            scrollbar-width: thin;
            scrollbar-color: #374151 #111827;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #111827;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* =========================
           BRAND
        ========================= */

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px 25px;
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 10px;
            background: #2563EB;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }

        .brand-text {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: 0.2px;
            color: #FFFFFF;
            white-space: nowrap;
        }

        /* =========================
           MENU
        ========================= */

        .menu-title {
            padding: 12px 12px 8px;
            color: #9CA3AF;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;

            color: #D1D5DB;
            text-decoration: none;

            padding: 11px 13px;
            margin-bottom: 4px;

            border-radius: 8px;
            font-size: 14px;

            transition: all 0.2s ease;
        }

        .menu a i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 15px;
            color: #9CA3AF;
        }

        .menu a:hover {
            background: #1F2937;
            color: #FFFFFF;
            transform: translateX(2px);
        }

        .menu a:hover i {
            color: #FFFFFF;
        }

        .menu a.active {
            background: #2563EB;
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .menu a.active i {
            color: #FFFFFF;
        }

        .logout-link {
            margin-top: 15px !important;
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 18px !important;
            border-radius: 0 !important;
        }

        .logout-link:hover {
            background: #7f1d1d !important;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            flex: 1 1 auto;
            min-width: 0;
            width: calc(100% - 255px);
            height: 100vh;

            padding: 30px;

            overflow-y: auto;
            overflow-x: hidden;

            position: relative;
            z-index: 1;

            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f5f7fb;
        }

        .main-content::-webkit-scrollbar {
            width: 7px;
        }

        .main-content::-webkit-scrollbar-track {
            background: #f5f7fb;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
                min-width: 220px;
                flex-basis: 220px;
            }

            .main-content {
                width: calc(100% - 220px);
                padding: 20px;
            }
        }

        @media (max-width: 600px) {

            .sidebar {
                width: 70px;
                min-width: 70px;
                flex-basis: 70px;
                padding: 15px 8px;
            }

            .brand {
                justify-content: center;
                padding: 5px 0 18px;
            }

            .brand-text,
            .menu-title {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 12px;
            }

            .menu a span {
                display: none;
            }

            .menu a i {
                margin: 0;
            }

            .main-content {
                width: calc(100% - 70px);
                padding: 15px;
            }
        }
    </style>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body>

<div class="app-layout">

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div class="brand-text">
                MySchoolHub
            </div>

        </div>

        <div class="menu">

            <div class="menu-title">
                Main Menu
            </div>

            <a href="<?= base_url('dashboard') ?>">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('students') ?>">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Students</span>
            </a>

            <a href="<?= base_url('teachers') ?>">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Teachers & Staff</span>
            </a>

            <a href="<?= base_url('classes') ?>">
                <i class="fa-solid fa-school"></i>
                <span>Classes</span>
            </a>

            <a href="<?= base_url('sections') ?>">
                <i class="fa-solid fa-layer-group"></i>
                <span>Sections</span>
            </a>

            <a href="<?= base_url('subjects') ?>">
                <i class="fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>

            <a href="<?= base_url('attendance') ?>">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Attendance</span>
            </a>

            <a href="<?= base_url('fees') ?>">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Fees & Payments</span>
            </a>
            
            <a href="<?= base_url('transport') ?>">
    <i class="fa-solid fa-bus"></i>
    <span>Transport Management</span>
</a>

            <a href="<?= base_url('exams') ?>">
                <i class="fa-solid fa-file-pen"></i>
                <span>Exams</span>
            </a>

            <a href="<?= base_url('results') ?>">
                <i class="fa-solid fa-chart-column"></i>
                <span>Results</span>
            </a>

            <a href="<?= base_url('notices') ?>">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Notices</span>
            </a>

            <div class="menu-title">
                Management
            </div>

            <a href="<?= base_url('reports') ?>">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Reports</span>
            </a>

            <a href="<?= base_url('settings') ?>">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>

            <a
                href="<?= base_url('logout') ?>"
                class="logout-link"
            >
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>

        </div>

    </aside>

    <main class="main-content">

        <?= $this->renderSection('content') ?>

    </main>

</div>

</body>
</html>
```
