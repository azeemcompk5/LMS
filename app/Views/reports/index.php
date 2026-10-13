<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

    .reports-container {
        padding: 0;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* =========================
       REPORT GRID
    ========================= */

    .report-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    /* =========================
       REPORT CARD
    ========================= */

    .report-card {
        position: relative;
        background: white;
        padding: 22px;
        border-radius: 12px;
        border: 1px solid #eef0f3;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: 0.2s ease;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .card-label {
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
    }

    .card-value {
        margin: 8px 0 0;
        color: #111827;
        font-size: 30px;
        line-height: 1;
        font-weight: 700;
    }

    /* =========================
       ICONS
    ========================= */

    .card-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .green {
        background: #ecfdf5;
        color: #059669;
    }

    .purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .red {
        background: #fef2f2;
        color: #dc2626;
    }

    .cyan {
        background: #ecfeff;
        color: #0891b2;
    }

    /* =========================
       BOTTOM ACCENT
    ========================= */

    .card-accent {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 3px;
        background: #2563eb;
    }

    .accent-green {
        background: #059669;
    }

    .accent-purple {
        background: #7c3aed;
    }

    .accent-orange {
        background: #ea580c;
    }

    .accent-red {
        background: #dc2626;
    }

    .accent-cyan {
        background: #0891b2;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1000px) {

        .report-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 600px) {

        .report-grid {
            grid-template-columns: 1fr;
        }

        .card-value {
            font-size: 26px;
        }

    }

</style>


<div class="reports-container">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <h1>
            Reports
        </h1>

        <p>
            Overview of your school's key records and activities
        </p>

    </div>


    <!-- REPORT CARDS -->

    <div class="report-grid">

        <!-- STUDENTS -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Students
                    </div>

                    <div class="card-value">
                        <?= esc($totalStudents) ?>
                    </div>
                </div>

                <div class="card-icon blue">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>

            </div>

            <div class="card-accent"></div>

        </div>


        <!-- TEACHERS -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Teachers
                    </div>

                    <div class="card-value">
                        <?= esc($totalTeachers) ?>
                    </div>
                </div>

                <div class="card-icon green">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>

            </div>

            <div class="card-accent accent-green"></div>

        </div>


        <!-- CLASSES -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Classes
                    </div>

                    <div class="card-value">
                        <?= esc($totalClasses) ?>
                    </div>
                </div>

                <div class="card-icon purple">
                    <i class="fa-solid fa-school"></i>
                </div>

            </div>

            <div class="card-accent accent-purple"></div>

        </div>


        <!-- SUBJECTS -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Subjects
                    </div>

                    <div class="card-value">
                        <?= esc($totalSubjects) ?>
                    </div>
                </div>

                <div class="card-icon orange">
                    <i class="fa-solid fa-book"></i>
                </div>

            </div>

            <div class="card-accent accent-orange"></div>

        </div>


        <!-- ATTENDANCE -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Attendance Records
                    </div>

                    <div class="card-value">
                        <?= esc($totalAttendance) ?>
                    </div>
                </div>

                <div class="card-icon cyan">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

            </div>

            <div class="card-accent accent-cyan"></div>

        </div>


        <!-- FEES -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Fee Records
                    </div>

                    <div class="card-value">
                        <?= esc($totalFees) ?>
                    </div>
                </div>

                <div class="card-icon green">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

            </div>

            <div class="card-accent accent-green"></div>

        </div>


        <!-- EXAMS -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Exams
                    </div>

                    <div class="card-value">
                        <?= esc($totalExams) ?>
                    </div>
                </div>

                <div class="card-icon red">
                    <i class="fa-solid fa-file-pen"></i>
                </div>

            </div>

            <div class="card-accent accent-red"></div>

        </div>


        <!-- RESULTS -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Results
                    </div>

                    <div class="card-value">
                        <?= esc($totalResults) ?>
                    </div>
                </div>

                <div class="card-icon blue">
                    <i class="fa-solid fa-chart-column"></i>
                </div>

            </div>

            <div class="card-accent"></div>

        </div>


        <!-- NOTICES -->

        <div class="report-card">

            <div class="card-top">

                <div>
                    <div class="card-label">
                        Total Notices
                    </div>

                    <div class="card-value">
                        <?= esc($totalNotices) ?>
                    </div>
                </div>

                <div class="card-icon orange">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>

            </div>

            <div class="card-accent accent-orange"></div>

        </div>

    </div>

</div>


<?= $this->endSection() ?>