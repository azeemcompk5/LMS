<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 800px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    h1 {
        margin: 0;
        font-size: 28px;
    }

    .header p {
        color: #6b7280;
    }

    .back-btn {
        background: #6b7280;
        color: white;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 8px;
    }

    .card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .row:last-child {
        border-bottom: none;
    }

    .label {
        width: 180px;
        font-weight: 600;
        color: #374151;
    }

    .value {
        flex: 1;
        color: #6b7280;
    }

    .present {
        color: #15803d;
        font-weight: 600;
    }

    .absent {
        color: #dc2626;
        font-weight: 600;
    }

    .late {
        color: #d97706;
        font-weight: 600;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Attendance Details</h1>
            <p>View attendance information</p>
        </div>

        <a href="<?= base_url('attendance') ?>" class="back-btn">
            ← Back to Attendance
        </a>

    </div>

    <div class="card">

        <div class="row">
            <div class="label">Admission No.</div>
            <div class="value">
                <?= esc($attendance->admission_no) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Student Name</div>
            <div class="value">
                <?= esc($attendance->first_name) ?>
                <?= esc($attendance->last_name) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Date</div>
            <div class="value">
                <?= esc($attendance->attendance_date) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Status</div>
            <div class="value <?= strtolower($attendance->status) ?>">
                <?= esc(ucfirst($attendance->status)) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Remarks</div>
            <div class="value">
                <?= esc($attendance->remarks) ?>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>