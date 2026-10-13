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

    .form-box {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .form-group {
        margin-bottom: 20px;
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
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        padding: 11px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .save-btn:hover {
        opacity: 0.9;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Edit Attendance</h1>
            <p>Update attendance information</p>
        </div>

        <a href="<?= base_url('attendance') ?>" class="back-btn">
            ← Back to Attendance
        </a>

    </div>

    <div class="form-box">

        <form
            action="<?= base_url('attendance/update/' . $attendance->id) ?>"
            method="post"
        >

            <div class="form-group">

                <label for="student_id">
                    Student
                </label>

                <select
                    id="student_id"
                    name="student_id"
                    required
                >

                    <?php foreach ($students as $student): ?>

                        <option
                            value="<?= $student->id ?>"
                            <?= $student->id == $attendance->student_id ? 'selected' : '' ?>
                        >
                            <?= esc($student->first_name) ?>
                            <?= esc($student->last_name) ?>
                            (<?= esc($student->admission_no) ?>)
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="attendance_date">
                    Date
                </label>

                <input
                    type="date"
                    id="attendance_date"
                    name="attendance_date"
                    value="<?= esc($attendance->attendance_date) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option
                        value="present"
                        <?= $attendance->status === 'present' ? 'selected' : '' ?>
                    >
                        Present
                    </option>

                    <option
                        value="absent"
                        <?= $attendance->status === 'absent' ? 'selected' : '' ?>
                    >
                        Absent
                    </option>

                    <option
                        value="late"
                        <?= $attendance->status === 'late' ? 'selected' : '' ?>
                    >
                        Late
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label for="remarks">
                    Remarks
                </label>

                <textarea
                    id="remarks"
                    name="remarks"
                ><?= esc($attendance->remarks) ?></textarea>

            </div>

            <button type="submit" class="save-btn">
                Save Changes
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>