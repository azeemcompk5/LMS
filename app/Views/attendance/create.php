<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 700px;
        margin: 0 auto;
        padding: 10px 0;
    }

    .form-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    h1 {
        margin-top: 0;
    }

    .subtitle {
        color: #6b7280;
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 11px;
        margin-bottom: 20px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        box-sizing: border-box;
        font-size: 15px;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .buttons {
        display: flex;
        gap: 10px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        padding: 11px 20px;
        border-radius: 8px;
        text-decoration: none;
    }
</style>

<div class="container">

    <div class="form-box">

        <h1>Mark Attendance</h1>

        <p class="subtitle">
            Record attendance for a student.
        </p>

        <form action="<?= base_url('attendance/store') ?>" method="post">

            <label>Student *</label>

            <select name="student_id" required>

                <option value="">Select Student</option>

                <?php foreach ($students as $student): ?>

                    <option value="<?= $student->id ?>">
                        <?= esc($student->first_name) ?>
                        <?= esc($student->last_name) ?>
                        — <?= esc($student->admission_no) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <label>Attendance Date *</label>

            <input
                type="date"
                name="attendance_date"
                value="<?= date('Y-m-d') ?>"
                required
            >

            <label>Status *</label>

            <select name="status" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
            </select>

            <label>Remarks</label>

            <textarea
                name="remarks"
                placeholder="Optional remarks"
            ></textarea>

            <div class="buttons">

                <button type="submit" class="save-btn">
                    Save Attendance
                </button>

                <a href="<?= base_url('attendance') ?>" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>