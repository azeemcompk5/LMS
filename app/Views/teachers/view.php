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

    .teacher-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .teacher-profile {
        text-align: center;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .teacher-photo {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f3f4f6;
    }

    .photo-placeholder {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        font-weight: 700;
    }

    .teacher-profile h2 {
        margin: 15px 0 5px;
        font-size: 22px;
    }

    .teacher-profile p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
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

    <h1>Teacher Details</h1>

    <a href="<?= base_url('teachers') ?>" class="back-btn">
        ← Back to Teachers
    </a>

</div>


<div class="teacher-card">

    <!-- TEACHER PROFILE -->

    <div class="teacher-profile">

        <?php if (!empty($teacher->photo)): ?>

            <img
                src="<?= base_url('uploads/teachers/' . $teacher->photo) ?>"
                alt="Teacher Photo"
                class="teacher-photo"
            >

        <?php else: ?>

            <div class="photo-placeholder">
                <?= esc(strtoupper(substr($teacher->first_name, 0, 1))) ?>
            </div>

        <?php endif; ?>


        <h2>
            <?= esc($teacher->first_name . ' ' . $teacher->last_name) ?>
        </h2>

        <p>
            Employee ID: <?= esc($teacher->employee_id) ?>
        </p>

    </div>


    <!-- TEACHER DETAILS -->

    <div class="details">

        <div class="detail-box">
            <span>Father Name</span>
            <strong><?= esc($teacher->father_name ?? '-') ?></strong>
        </div>


        <div class="detail-box">
            <span>Designation</span>
            <strong><?= esc($teacher->designation ?? '-') ?></strong>
        </div>


        <div class="detail-box">
            <span>Phone</span>
            <strong><?= esc($teacher->phone ?? '-') ?></strong>
        </div>


        <div class="detail-box">
            <span>Email</span>
            <strong><?= esc($teacher->email ?? '-') ?></strong>
        </div>


        <div class="detail-box">
            <span>Joining Date</span>

            <strong>
                <?= !empty($teacher->joining_date)
                    ? date('d M Y', strtotime($teacher->joining_date))
                    : '-' ?>
            </strong>
        </div>


        <div class="detail-box">
            <span>Address</span>
            <strong><?= esc($teacher->address ?? '-') ?></strong>
        </div>


        <div class="detail-box">
            <span>Status</span>

            <strong class="status">
                <?= esc(ucfirst($teacher->status)) ?>
            </strong>
        </div>

    </div>


    <!-- EDIT BUTTON -->

    <a
        href="<?= base_url('teachers/edit/' . $teacher->id) ?>"
        class="edit-btn"
    >
        ✏ Edit Teacher
    </a>

</div>


<?= $this->endSection() ?>