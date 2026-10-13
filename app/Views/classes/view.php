<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

    .container {
        max-width: 1100px;
    }

    /* =========================
       HEADER
    ========================= */

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .back-btn {
        background: #6b7280;
        color: white;
    }

    .back-btn:hover {
        background: #4b5563;
    }

    .edit-btn {
        background: #2563eb;
        color: white;
    }

    .edit-btn:hover {
        background: #1d4ed8;
    }

    /* =========================
       CLASS PROFILE
    ========================= */

    .profile-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .class-icon {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }

    .profile-info h2 {
        margin: 0 0 6px;
        font-size: 23px;
        color: #111827;
    }

    .profile-info p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .status-badge {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* =========================
       SUMMARY CARDS
    ========================= */

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 20px;
    }

    .summary-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .summary-card .icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 14px;
    }

    .summary-card span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .summary-card strong {
        display: block;
        color: #111827;
        font-size: 22px;
    }

    /* =========================
       DETAILS
    ========================= */

    .details-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .section-title {
        margin: 0 0 20px;
        font-size: 18px;
        color: #111827;
    }

    .detail-row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        width: 180px;
        color: #6b7280;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-value {
        flex: 1;
        color: #111827;
        font-size: 14px;
    }

    .description-box {
        color: #4b5563;
        line-height: 1.6;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 800px) {

        .summary-cards {
            grid-template-columns: 1fr;
        }

        .header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-actions {
            width: 100%;
        }

        .btn {
            flex: 1;
            justify-content: center;
        }

        .profile-top {
            align-items: flex-start;
        }

        .status-badge {
            margin-left: 0;
        }

        .detail-row {
            flex-direction: column;
            gap: 6px;
        }

        .detail-label {
            width: auto;
        }
    }

</style>


<div class="container">

    <!-- PAGE HEADER -->

    <div class="header">

        <div>
            <h1>Class Details</h1>
            <p>View class information and overview</p>
        </div>

        <div class="header-actions">

            <a href="<?= base_url('classes') ?>" class="btn back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <a href="<?= base_url('classes/edit/' . $class->id) ?>" class="btn edit-btn">
                <i class="fa-solid fa-pen"></i>
                Edit Class
            </a>

        </div>

    </div>


    <!-- CLASS PROFILE -->

    <div class="profile-card">

        <div class="profile-top">

            <div class="class-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div class="profile-info">

                <h2><?= esc($class->name) ?></h2>

                <p>Class Profile</p>

            </div>

            <?php if ($class->status === 'active'): ?>

                <div class="status-badge status-active">
                    <i class="fa-solid fa-circle-check"></i>
                    Active
                </div>

            <?php else: ?>

                <div class="status-badge status-inactive">
                    <i class="fa-solid fa-circle-xmark"></i>
                    Inactive
                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- SUMMARY -->

    <div class="summary-cards">

        <div class="summary-card">

            <div class="icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <span>Students</span>

            <strong><?= esc($studentCount) ?></strong>
        </div>


        <div class="summary-card">

            <div class="icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <span>Subjects</span>

            <strong><?= esc($subjectCount) ?></strong>
        </div>


        <div class="summary-card">

            <div class="icon">
                <i class="fa-solid fa-calendar-days"></i>
            </div>

            <span>Attendance</span>

            <strong>—</strong>

        </div>

    </div>


    <!-- CLASS INFORMATION -->

    <div class="details-card">

        <h3 class="section-title">
            Class Information
        </h3>


        <div class="detail-row">

            <div class="detail-label">
                Class Name
            </div>

            <div class="detail-value">
                <?= esc($class->name) ?>
            </div>

        </div>


        <div class="detail-row">

            <div class="detail-label">
                Status
            </div>

            <div class="detail-value">

                <?php if ($class->status === 'active'): ?>

                    <span class="status-badge status-active">
                        Active
                    </span>

                <?php else: ?>

                    <span class="status-badge status-inactive">
                        Inactive
                    </span>

                <?php endif; ?>

            </div>

        </div>


        <div class="detail-row">

            <div class="detail-label">
                Description
            </div>

            <div class="detail-value description-box">

                <?php if (!empty($class->description)): ?>

                    <?= esc($class->description) ?>

                <?php else: ?>

                    No description available.

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<!-- STUDENTS LIST -->

<div class="details-card" style="margin-top:25px;">

    <h3 class="section-title">
        Students
    </h3>

    <?php if (!empty($students)): ?>

        <div style="overflow-x:auto;">

            <table style="width:100%; border-collapse:collapse;">

                <thead>
                    <tr style="border-bottom:1px solid #e5e7eb;">

                        <th style="text-align:left; padding:12px 10px;">
                            Admission No
                        </th>

                        <th style="text-align:left; padding:12px 10px;">
                            Student Name
                        </th>

                        <th style="text-align:left; padding:12px 10px;">
                            Gender
                        </th>

                        <th style="text-align:left; padding:12px 10px;">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($students as $student): ?>

                        <tr style="border-bottom:1px solid #f1f5f9;">

                            <td style="padding:14px 10px;">
                                <?= esc($student->admission_no) ?>
                            </td>

                            <td style="padding:14px 10px; font-weight:600;">
                                <?= esc($student->first_name . ' ' . $student->last_name) ?>
                            </td>

                            <td style="padding:14px 10px;">
                                <?= esc($student->gender) ?>
                            </td>

                            <td style="padding:14px 10px;">
                                <?= esc($student->status) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else: ?>

        <div style="padding:30px; text-align:center; color:#6b7280;">
            No students are assigned to this class yet.
        </div>

    <?php endif; ?>

</div>


</div>


<?= $this->endSection() ?>