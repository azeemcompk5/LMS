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
        padding: 10px 18px;
        border-radius: 7px;
        font-size: 14px;
    }

    .report-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .school-header {
        text-align: center;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .school-header h2 {
        margin: 0 0 5px;
        font-size: 24px;
    }

    .school-header p {
        margin: 0;
        color: #6b7280;
    }

    .student-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .info-box {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
    }

    .info-box span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .info-box strong {
        font-size: 15px;
    }

    .section-title {
        font-size: 20px;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 13px 12px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background: #f9fafb;
        font-size: 14px;
    }

    td {
        font-size: 14px;
    }

    .grade {
        font-weight: bold;
    }

    .pass {
        color: #15803d;
        font-weight: bold;
    }

    .fail {
        color: #b91c1c;
        font-weight: bold;
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-top: 25px;
    }

    .summary-box {
        background: #f9fafb;
        padding: 18px;
        border-radius: 8px;
        text-align: center;
    }

    .summary-box span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .summary-box strong {
        font-size: 20px;
    }

    .remarks {
        margin-top: 25px;
        padding: 18px;
        background: #f9fafb;
        border-radius: 8px;
    }

    .remarks strong {
        display: block;
        margin-bottom: 7px;
    }

    .print-btn {
        margin-top: 25px;
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
    }

    .print-btn:hover {
        background: #1d4ed8;
    }

    @media (max-width: 800px) {
        .summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .student-info {
            grid-template-columns: 1fr;
        }

        .summary {
            grid-template-columns: 1fr;
        }
    }

    @media print {
        .sidebar,
        .page-header,
        .print-btn {
            display: none !important;
        }

        .main-content {
            padding: 0;
        }

        .report-card {
            box-shadow: none;
        }
    }
</style>

<div class="page-header">

    <h1>Student Report Card</h1>

    <a href="<?= base_url('results') ?>" class="back-btn">
        ← Back to Results
    </a>

</div>

<div class="report-card">

    <div class="school-header">
        <h2>MySchoolHub</h2>
        <p>Student Examination Report Card</p>
    </div>

    <div class="student-info">

        <div class="info-box">
            <span>Student Name</span>
            <strong>
                <?= esc(
                    $student->first_name . ' ' .
                    ($student->last_name ?? '')
                ) ?>
            </strong>
        </div>

        <div class="info-box">
            <span>Admission No.</span>
            <strong><?= esc($student->admission_no) ?></strong>
        </div>

        <div class="info-box">
            <span>Exam</span>
            <strong><?= esc($student->exam_name) ?></strong>
        </div>

        <div class="info-box">
            <span>Term</span>
            <strong><?= esc($student->term ?? '-') ?></strong>
        </div>

        <div class="info-box">
            <span>Exam Date</span>
            <strong>
                <?= !empty($student->exam_date)
                    ? date('d M Y', strtotime($student->exam_date))
                    : '-' ?>
            </strong>
        </div>

    </div>

    <h2 class="section-title">Subject-wise Marks</h2>

    <table>

        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Marks Obtained</th>
                <th>Total Marks</th>
                <th>Percentage</th>
                <th>Grade</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($results as $index => $result): ?>

                <?php
                    $percentage = $result->total_marks > 0
                        ? ($result->marks_obtained / $result->total_marks) * 100
                        : 0;

                    $isPass = $percentage >= 40;
                ?>

                <tr>

                    <td><?= $index + 1 ?></td>

                    <td>
                        <?= esc($result->subject_name) ?>

                        <?php if (!empty($result->subject_code)): ?>
                            (<?= esc($result->subject_code) ?>)
                        <?php endif; ?>
                    </td>

                    <td>
                        <?= number_format($result->marks_obtained, 2) ?>
                    </td>

                    <td>
                        <?= number_format($result->total_marks, 2) ?>
                    </td>

                    <td class="<?= $isPass ? 'pass' : 'fail' ?>">
                        <?= number_format($percentage, 2) ?>%
                    </td>

                    <td class="grade <?= $isPass ? 'pass' : 'fail' ?>">
                        <?= esc($result->grade ?? '-') ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <div class="summary">

        <div class="summary-box">
            <span>Total Obtained</span>
            <strong>
                <?= number_format($totalObtained, 2) ?>
            </strong>
        </div>

        <div class="summary-box">
            <span>Total Marks</span>
            <strong>
                <?= number_format($totalMarks, 2) ?>
            </strong>
        </div>

        <div class="summary-box">
            <span>Overall Percentage</span>
            <strong>
                <?= number_format($overallPercentage, 2) ?>%
            </strong>
        </div>

        <div class="summary-box">
            <span>Overall Grade</span>
            <strong class="<?= $overallStatus === 'Pass' ? 'pass' : 'fail' ?>">
                <?= esc($overallGrade) ?>
            </strong>
        </div>

    </div>

    <div class="remarks">

        <strong>Overall Result</strong>

        <span class="<?= $overallStatus === 'Pass' ? 'pass' : 'fail' ?>">
            <?= esc($overallStatus) ?>
        </span>

    </div>

    <button
        type="button"
        class="print-btn"
        onclick="window.print()"
    >
        Print Report Card
    </button>

</div>

<?= $this->endSection() ?>