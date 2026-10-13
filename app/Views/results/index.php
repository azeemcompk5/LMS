<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .results-page {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 15px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .page-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .table-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .results-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .results-table th {
        background: #f9fafb;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .results-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #f0f0f0;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .results-table tbody tr:hover {
        background: #fafafa;
    }

    .student-name {
        font-weight: 600;
        color: #111827;
    }

    .admission-no {
        color: #6b7280;
        font-size: 13px;
    }

    .percentage {
        font-weight: 600;
        color: #2563eb;
    }

    .grade {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        padding: 5px 9px;
        border-radius: 6px;
        background: #eff6ff;
        color: #2563eb;
        font-weight: 700;
        font-size: 13px;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
        font-size: 14px;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .view-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .view-btn:hover {
        background: #dbeafe;
    }

    .marks-btn {
        background: #ecfdf5;
        color: #059669;
    }

    .marks-btn:hover {
        background: #d1fae5;
    }

    .print-btn {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .print-btn:hover {
        background: #ede9fe;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 40px;
        margin-bottom: 15px;
        color: #9ca3af;
    }

    .empty-state h3 {
        margin: 0 0 7px;
        color: #374151;
    }

    .empty-state p {
        margin: 0;
        font-size: 14px;
    }

    @media (max-width: 768px) {

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>


<div class="results-page">

    <!-- Page Header -->
    <div class="page-header">

        <div>
            <h1>Results</h1>

            <p>
                Manage student examination results and academic performance
            </p>
        </div>

    </div>


    <!-- Results Table -->
    <div class="table-card">

        <?php if (!empty($results)): ?>

            <div class="table-wrapper">

                <table class="results-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Admission No</th>
                            <th>Exam</th>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Percentage</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($results as $index => $result): ?>

                            <?php
                                $totalMarks = (float) $result->total_marks;
                                $marksObtained = (float) $result->marks_obtained;

                                $percentage = $totalMarks > 0
                                    ? ($marksObtained / $totalMarks) * 100
                                    : 0;
                            ?>

                            <tr>

                                <!-- # -->
                                <td>
                                    <?= $index + 1 ?>
                                </td>


                                <!-- Student -->
                                <td>

                                    <div class="student-name">
                                        <?= esc(
                                            $result->first_name . ' ' . $result->last_name
                                        ) ?>
                                    </div>

                                </td>


                                <!-- Admission No -->
                                <td>

                                    <span class="admission-no">
                                        <?= esc($result->admission_no) ?>
                                    </span>

                                </td>


                                <!-- Exam -->
                                <td>
                                    <?= esc($result->exam_name ?: '-') ?>
                                </td>


                                <!-- Subject -->
                                <td>

                                    <strong>
                                        <?= esc($result->subject_name ?: '-') ?>
                                    </strong>

                                </td>


                                <!-- Marks -->
                                <td>

                                    <strong>
                                        <?= number_format($marksObtained, 2) ?>
                                    </strong>

                                    /
                                    <?= number_format($totalMarks, 2) ?>

                                </td>


                                <!-- Percentage -->
                                <td>

                                    <span class="percentage">
                                        <?= number_format($percentage, 2) ?>%
                                    </span>

                                </td>


                                <!-- Grade -->
                                <td>

                                    <span class="grade">
                                        <?= esc($result->grade) ?>
                                    </span>

                                </td>


                                <!-- Actions -->
                                <td>

                                    <div class="action-buttons">

                                        <!-- View Report -->
                                        <a
                                            href="<?= base_url('results/view/' . $result->id) ?>"
                                            class="action-btn view-btn"
                                            title="View Report"
                                            aria-label="View Report"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>


                                        <!-- Marks Entry -->
                                        <a
                                            href="<?= base_url(
                                                'exams/marks/' .
                                                $result->exam_id .
                                                '/' .
                                                $result->subject_id
                                            ) ?>"
                                            class="action-btn marks-btn"
                                            title="Marks Entry"
                                            aria-label="Marks Entry"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>


                                        <!-- Print Report -->
                                        <a
                                            href="<?= base_url('results/view/' . $result->id) ?>"
                                            class="action-btn print-btn"
                                            title="Print Report"
                                            aria-label="Print Report"
                                            target="_blank"
                                        >
                                            <i class="fa-solid fa-print"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                <i class="fa-solid fa-file-circle-xmark"></i>

                <h3>No Results Found</h3>

                <p>
                    Results will appear here after marks are entered.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>


<?= $this->endSection() ?>