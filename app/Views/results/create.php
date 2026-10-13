<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .form-box {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: bold;
        font-size: 14px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
    }

    .save-btn:hover {
        background: #1d4ed8;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        padding: 11px 20px;
        border-radius: 7px;
        font-size: 14px;
    }
</style>

<div class="page-header">
    <h1>Add Result</h1>
    <p>Enter student examination marks.</p>
</div>

<div class="form-box">

    <form action="<?= base_url('results/store') ?>" method="post">

        <div class="form-group">
            <label for="student_id">Student</label>

            <select id="student_id" name="student_id" required>

                <option value="">Select Student</option>

                <?php foreach ($students as $student): ?>

                    <option value="<?= $student->id ?>">
                        <?= esc(
                            $student->first_name . ' ' .
                            ($student->last_name ?? '') .
                            ' (' . $student->admission_no . ')'
                        ) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <div class="form-group">
            <label for="exam_id">Exam</label>

            <select id="exam_id" name="exam_id" required>

                <option value="">Select Exam</option>

                <?php foreach ($exams as $exam): ?>

                    <option value="<?= $exam->id ?>">
                        <?= esc($exam->name) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <div class="form-group">
            <label for="subject_id">Subject</label>

            <select id="subject_id" name="subject_id" required>

                <option value="">Select Subject</option>

                <?php foreach ($subjects as $subject): ?>

                    <option value="<?= $subject->id ?>">
                        <?= esc($subject->name) ?>
                        <?php if (!empty($subject->code)): ?>
                            (<?= esc($subject->code) ?>)
                        <?php endif; ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <div class="form-group">
            <label for="marks_obtained">Marks Obtained</label>

            <input
                type="number"
                id="marks_obtained"
                name="marks_obtained"
                min="0"
                step="0.01"
                placeholder="e.g. 85"
                required
            >
        </div>

        <div class="form-group">
            <label for="total_marks">Total Marks</label>

            <input
                type="number"
                id="total_marks"
                name="total_marks"
                min="1"
                step="0.01"
                value="100"
                required
            >
        </div>

        <div class="form-group">
            <label for="remarks">Remarks</label>

            <textarea
                id="remarks"
                name="remarks"
                placeholder="Optional remarks..."
            ></textarea>
        </div>

        <div class="form-actions">

            <button type="submit" class="save-btn">
                Save Result
            </button>

            <a href="<?= base_url('results') ?>" class="cancel-btn">
                Cancel
            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>