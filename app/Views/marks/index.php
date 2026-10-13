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
        margin: 0 0 6px;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .back-btn {
        background: #6b7280;
        color: white;
        text-decoration: none;
        padding: 10px 16px;
        border-radius: 7px;
        font-size: 14px;
    }

    .info-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .info-item span {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .info-item strong {
        font-size: 16px;
        color: #111827;
    }

    .marks-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        margin: 0;
        font-size: 18px;
    }

    .total-info {
        color: #6b7280;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f9fafb;
        padding: 13px 15px;
        text-align: left;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    td {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }

    tr:last-child td {
        border-bottom: none;
    }

    .marks-input {
        width: 110px;
        padding: 9px 10px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .marks-input:focus {
        outline: none;
        border-color: #2563eb;
    }

    .save-area {
        padding: 18px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
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

    .empty-state {
        padding: 40px;
        text-align: center;
        color: #6b7280;
    }

    @media (max-width: 700px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>

<div class="page-header">

    <div>
        <h1>
            <i class="fa-solid fa-pen-to-square"></i>
            Marks Entry
        </h1>

        <p>Enter marks for students.</p>
    </div>

    <a
        href="<?= base_url('exams/view/' . $exam->id) ?>"
        class="back-btn"
    >
        ← Back to Exam
    </a>

</div>

<div class="info-card">

    <div class="info-grid">

        <div class="info-item">
            <span>Examination</span>
            <strong><?= esc($exam->name) ?></strong>
        </div>

        <div class="info-item">
            <span>Subject</span>
            <strong><?= esc($subject->subject_name) ?></strong>
        </div>

        <div class="info-item">
            <span>Total Marks</span>
            <strong><?= esc($subject->total_marks) ?></strong>
        </div>

    </div>

</div>

<div class="marks-card">

    <div class="card-header">

        <h2>
            <i class="fa-solid fa-users"></i>
            Student Marks
        </h2>

        <div class="total-info">
            <?= count($students) ?> Students
        </div>

    </div>

    <?php if (!empty($students)): ?>

        <form
            action="<?= base_url('exams/marks/save') ?>"
            method="post"
        >

            <input
                type="hidden"
                name="exam_id"
                value="<?= $exam->id ?>"
            >

            <input
                type="hidden"
                name="subject_id"
                value="<?= $subject->id ?>"
            >

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Admission No.</th>
                        <th>Student Name</th>
                        <th>Marks Obtained</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($students as $index => $student): ?>

                        <?php
                            $existingMark =
                                $marksByStudent[$student->id]->obtained_marks
                                ?? '';
                        ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= esc($student->admission_no) ?>
                            </td>

                            <td>
                                <strong>
                                    <?= esc(
                                        trim(
                                            $student->first_name . ' ' .
                                            ($student->last_name ?? '')
                                        )
                                    ) ?>
                                </strong>
                            </td>

                            <td>

                                <input
                                    type="number"
                                    name="marks[<?= $student->id ?>]"
                                    value="<?= esc($existingMark) ?>"
                                    class="marks-input"
                                    min="0"
                                    max="<?= $subject->total_marks ?>"
                                    step="0.01"
                                    placeholder="0"
                                >

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

            <div class="save-area">

                <button
                    type="submit"
                    class="save-btn"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Marks
                </button>

            </div>

        </form>

    <?php else: ?>

        <div class="empty-state">

            <i class="fa-solid fa-users-slash"></i>

            <p>
                No active students found for this class and section.
            </p>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>