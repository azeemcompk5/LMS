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

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        color: #374151;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 15px;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 15px;
    }

    .save-btn:hover {
        background: #1d4ed8;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Edit Result</h1>
            <p>Update student examination result</p>
        </div>

        <a href="<?= base_url('results') ?>" class="back-btn">
            ← Back to Results
        </a>

    </div>

    <div class="card">

        <form action="<?= base_url('results/update/' . $result->id) ?>" method="post">

            <div class="form-group">

                <label>Student</label>

                <select name="student_id" required>

                    <option value="">Select Student</option>

                    <?php foreach ($students as $student): ?>

                        <option
                            value="<?= $student->id ?>"
                            <?= $result->student_id == $student->id ? 'selected' : '' ?>
                        >
                            <?= esc($student->first_name . ' ' . $student->last_name) ?>
                            (<?= esc($student->admission_no) ?>)
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label>Exam</label>

                <select name="exam_id" required>

                    <option value="">Select Exam</option>

                    <?php foreach ($exams as $exam): ?>

                        <option
                            value="<?= $exam->id ?>"
                            <?= $result->exam_id == $exam->id ? 'selected' : '' ?>
                        >
                            <?= esc($exam->name) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label>Subject</label>

                <select name="subject_id" required>

                    <option value="">Select Subject</option>

                    <?php foreach ($subjects as $subject): ?>

                        <option
                            value="<?= $subject->id ?>"
                            <?= $result->subject_id == $subject->id ? 'selected' : '' ?>
                        >
                            <?= esc($subject->name) ?>
                            <?= !empty($subject->code) ? '(' . esc($subject->code) . ')' : '' ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label>Marks Obtained</label>

                <input
                    type="number"
                    name="marks_obtained"
                    step="0.01"
                    min="0"
                    value="<?= esc($result->marks_obtained) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Total Marks</label>

                <input
                    type="number"
                    name="total_marks"
                    step="0.01"
                    min="1"
                    value="<?= esc($result->total_marks) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Remarks</label>

                <textarea name="remarks"><?= esc($result->remarks) ?></textarea>

            </div>

            <button type="submit" class="save-btn">
                Update Result
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>