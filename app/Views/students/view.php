<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
    }

    .back-btn {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        padding: 9px 15px;
        border-radius: 7px;
        font-size: 13px;
    }

    .student-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .student-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 25px;
    }

    .avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: bold;
    }

    .student-header h2 {
        margin: 0 0 5px;
        font-size: 22px;
    }

    .student-header p {
        margin: 0;
        color: #6b7280;
    }

    .details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .detail-box {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
    }

    .detail-box span {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .detail-box strong {
        font-size: 14px;
    }

    .status {
        color: #059669;
        font-weight: 600;
    }

    .edit-btn {
        display: inline-block;
        margin-top: 25px;
        background: #ecfdf5;
        color: #059669;
        text-decoration: none;
        padding: 9px 15px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 600px) {
        .details {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">

    <h1>Student Details</h1>

    <a href="<?= base_url('students') ?>" class="back-btn">
        ← Back to Students
    </a>

</div>

<div class="student-card">

    <div class="student-header">

        <div class="avatar">
            <?= esc(strtoupper(substr($student->first_name, 0, 1))) ?>
        </div>

        <div>
            <h2>
                <?= esc($student->first_name . ' ' . $student->last_name) ?>
            </h2>
            <?php if (!empty($student->photo)): ?>
    <div style="margin-bottom: 20px;">
        <img
            src="<?= base_url('uploads/students/' . $student->photo) ?>"
            alt="Student Photo"
            style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid #e5e7eb;"
        >
    </div>
<?php endif; ?>

            <p>
                Admission No: <?= esc($student->admission_no) ?>
            </p>
            <p>
    B-Form / Registration No:
    <?= esc($student->b_form_no ?? 'Not provided') ?>
</p>
        </div>

    </div>

    <div class="details">

        <div class="detail-box">
            <span>Gender</span>
            <strong><?= esc($student->gender) ?></strong>
        </div>

        <div class="detail-box">
            <span>Date of Birth</span>
            <strong>
                <?= !empty($student->date_of_birth)
                    ? date('d M Y', strtotime($student->date_of_birth))
                    : '-' ?>
            </strong>
        </div>

        <div class="detail-box">
            <span>Class</span>
            <strong><?= esc($student->class_name ?? '-') ?></strong>
        </div>

        <div class="detail-box">
            <span>Section</span>
            <strong><?= esc($student->section_name ?? '-') ?></strong>
        </div>

        <div class="detail-box">
            <span>Guardian</span>
            <strong><?= esc($student->guardian_name ?? '-') ?></strong>
        </div>

        <div class="detail-box">
            <span>Guardian Phone</span>
            <strong><?= esc($student->guardian_phone ?? '-') ?></strong>
        </div>

        <div class="detail-box">
            <span>Address</span>
            <strong><?= esc($student->address ?? '-') ?></strong>
        </div>

        <div class="detail-box">
            <span>Status</span>
            <strong class="status">
                <?= esc(ucfirst($student->status)) ?>
            </strong>
        </div>

    </div>

    <a
        href="<?= base_url('students/edit/' . $student->id) ?>"
        class="edit-btn"
    >
        ✏ Edit Student
    </a>

</div>

<?= $this->endSection() ?>