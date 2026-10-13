
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .dashboard-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .dashboard-title h1 {
        margin: 0 0 6px;
        font-size: 30px;
        font-weight: 700;
        color: #111827;
    }

    .dashboard-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .admin-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        color: #374151;
        font-size: 14px;
        font-weight: 600;
    }

    .admin-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
    }

    /* Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        transition: 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .stat-title {
        color: #6b7280;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 18px;
    }

    .students-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .teachers-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .classes-icon {
        background: #fff7ed;
        color: #ea580c;
    }

    .fees-icon {
        background: #fef2f2;
        color: #dc2626;
    }

    .stat-number {
        margin: 0;
        color: #111827;
        font-size: 28px;
        font-weight: 700;
    }

    /* Main Content */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .dashboard-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        color: #111827;
    }

    .card-header i {
        color: #9ca3af;
        font-size: 18px;
    }

    .welcome-text {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
    }

    /* System Overview */
    .overview-list {
        display: grid;
        gap: 12px;
    }

    .overview-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 14px;
        background: #f9fafb;
        border-radius: 9px;
    }

    .overview-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #374151;
        font-size: 14px;
        font-weight: 500;
    }

    .overview-label i {
        width: 20px;
        text-align: center;
        color: #2563eb;
    }

    .overview-value {
        color: #111827;
        font-size: 14px;
        font-weight: 700;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        gap: 10px;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border: 1px solid #eef0f4;
        border-radius: 9px;
        background: #f9fafb;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s ease;
    }

    .quick-action:hover {
        background: #eff6ff;
        border-color: #dbeafe;
        color: #2563eb;
        transform: translateX(2px);
    }

    .quick-action-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #ffffff;
        color: #2563eb;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    /* Fee Alert */
    .fee-alert {
        margin-top: 20px;
        padding: 16px;
        border-radius: 10px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .fee-alert-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #ffedd5;
        color: #ea580c;
    }

    .fee-alert-text strong {
        display: block;
        color: #9a3412;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .fee-alert-text span {
        color: #c2410c;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-title h1 {
            font-size: 25px;
        }
    }
</style>

<div class="dashboard-page">

    <!-- Header -->
    <div class="dashboard-header">

        <div class="dashboard-title">
            <h1>Dashboard</h1>
            <p>Welcome back! Here's an overview of your school.</p>
        </div>

        <div class="admin-badge">
            <div class="admin-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <span>Administrator</span>
        </div>

    </div>


    <!-- Statistics -->
    <div class="stats-grid">

        <!-- Students -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-title">Total Students</div>

                <div class="stat-icon students-icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>

            <p class="stat-number">
                <?= $totalStudents ?>
            </p>
        </div>


        <!-- Teachers -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-title">Total Teachers</div>

                <div class="stat-icon teachers-icon">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>

            <p class="stat-number">
                <?= $totalTeachers ?>
            </p>
        </div>


        <!-- Classes -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-title">Total Classes</div>

                <div class="stat-icon classes-icon">
                    <i class="fa-solid fa-school"></i>
                </div>
            </div>

            <p class="stat-number">
                <?= $totalClasses ?>
            </p>
        </div>


        <!-- Pending Fees -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-title">Pending Fees</div>

                <div class="stat-icon fees-icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>

            <p class="stat-number">
                PKR <?= number_format($pendingFees, 2) ?>
            </p>
        </div>

    </div>


    <!-- Dashboard Main Grid -->
    <div class="dashboard-grid">

        <!-- System Overview -->
        <div class="dashboard-card">

            <div class="card-header">
                <h2>School Overview</h2>
                <i class="fa-solid fa-chart-simple"></i>
            </div>

            <div class="overview-list">

                <div class="overview-item">
                    <div class="overview-label">
                        <i class="fa-solid fa-user-graduate"></i>
                        Students
                    </div>

                    <div class="overview-value">
                        <?= $totalStudents ?>
                    </div>
                </div>


                <div class="overview-item">
                    <div class="overview-label">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        Teachers
                    </div>

                    <div class="overview-value">
                        <?= $totalTeachers ?>
                    </div>
                </div>


                <div class="overview-item">
                    <div class="overview-label">
                        <i class="fa-solid fa-school"></i>
                        Classes
                    </div>

                    <div class="overview-value">
                        <?= $totalClasses ?>
                    </div>
                </div>


                <div class="overview-item">
                    <div class="overview-label">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Pending Fees
                    </div>

                    <div class="overview-value">
                        PKR <?= number_format($pendingFees, 2) ?>
                    </div>
                </div>

            </div>


            <?php if ($pendingFees > 0): ?>

                <div class="fee-alert">

                    <div class="fee-alert-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                    <div class="fee-alert-text">
                        <strong>Pending Fee Alert</strong>

                        <span>
                            PKR <?= number_format($pendingFees, 2) ?>
                            in fees are currently pending.
                        </span>
                    </div>

                </div>

            <?php endif; ?>

        </div>


        <!-- Quick Actions -->
        <div class="dashboard-card">

            <div class="card-header">
                <h2>Quick Actions</h2>
                <i class="fa-solid fa-bolt"></i>
            </div>

            <div class="quick-actions">

                <a href="<?= base_url('students/create') ?>" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>

                    <span>Add Student</span>
                </a>


                <a href="<?= base_url('teachers/create') ?>" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <span>Add Teacher</span>
                </a>


                <a href="<?= base_url('attendance/create') ?>" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <span>Add Attendance</span>
                </a>


                <a href="<?= base_url('fees/create') ?>" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>

                    <span>Add Fee</span>
                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
```
