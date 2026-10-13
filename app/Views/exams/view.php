```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .exam-page {
        max-width: 1100px;
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

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-add {
        background: #2563eb;
        color: #ffffff;
    }

    .card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .card-header h2 {
        margin: 0;
        font-size: 18px;
        color: #111827;
    }

    .exam-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 25px;
    }

    .info-item span {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-item strong {
        color: #111827;
        font-size: 15px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .subjects-table {
        width: 100%;
        border-collapse: collapse;
    }

    .subjects-table th {
        background: #f3f4f6;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        padding: 13px 15px;
        border-bottom: 1px solid #e5e7eb;
    }

    .subjects-table td {
        padding: 13px 15px;
        border-bottom: 1px solid #f0f0f0;
        color: #374151;
        font-size: 14px;
    }

    .subjects-table tr:last-child td {
        border-bottom: none;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 7px;
        text-decoration: none;
        margin-right: 6px;
        transition: 0.2s ease;
    }

    .marks-btn {
        background: #ecfdf5;
        color: #059669;
    }

    .marks-btn:hover {
        background: #d1fae5;
        transform: translateY(-1px);
    }

    .edit-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-btn:hover {
        background: #dbeafe;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 35px;
        margin-bottom: 12px;
        color: #9ca3af;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .exam-info {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 500px) {
        .exam-info {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="exam-page">

    <!-- Page Header -->
    <div class="page-header">

        <div>
            <h1>Exam Details</h1>
            <p>View examination information and subjects</p>
        </div>

        <div class="header-actions">

            <a href="<?= base_url('exams') ?>" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <a
                href="<?= base_url('exams/subjects/add/' . $exam->id) ?>"
                class="btn btn-add"
            >
                <i class="fa-solid fa-plus"></i>
                Add Subject
            </a>

        </div>

    </div>


    <!-- Exam Information -->
    <div class="card">

        <div class="card-header">
            <h2>Exam Information</h2>
        </div>

        <div class="exam-info">

            <div class="info-item">
                <span>Exam Name</span>
                <strong><?= esc($exam->name) ?></strong>
            </div>

            <div class="info-item">
                <span>Term</span>
                <strong><?= esc($exam->term ?: '-') ?></strong>
            </div>

            <div class="info-item">
                <span>Exam Date</span>
                <strong>
                    <?= !empty($exam->exam_date)
                        ? date('d M Y', strtotime($exam->exam_date))
                        : '-' ?>
                </strong>
            </div>

            <div class="info-item">
                <span>Class</span>
                <strong>
                    <?= !empty($exam->class_id)
                        ? esc($exam->class_id)
                        : '-' ?>
                </strong>
            </div>

            <div class="info-item">
                <span>Section</span>
                <strong>
                    <?= !empty($exam->section_id)
                        ? esc($exam->section_id)
                        : '-' ?>
                </strong>
            </div>

            <div class="info-item">
                <span>Status</span>
                <strong><?= esc(ucfirst($exam->status ?: 'upcoming')) ?></strong>
            </div>

        </div>

    </div>


    <!-- Exam Subjects -->
    <div class="card">

        <div class="card-header">
            <h2>Exam Subjects</h2>
        </div>

        <div class="table-wrapper">

            <?php if (!empty($subjects)): ?>

                <table class="subjects-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Total Marks</th>
                            <th>Exam Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($subjects as $index => $subject): ?>

                            <tr>

                                <td>
                                    <?= $index + 1 ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= esc($subject->subject_name) ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= esc($subject->total_marks) ?>
                                </td>

                                <td>
                                    <?= !empty($subject->exam_date)
                                        ? date('d M Y', strtotime($subject->exam_date))
                                        : '-' ?>
                                </td>

                                <td>
                                    <?= !empty($subject->start_time)
                                        ? date('h:i A', strtotime($subject->start_time))
                                        : '-' ?>
                                </td>

                                <td>
                                    <?= !empty($subject->end_time)
                                        ? date('h:i A', strtotime($subject->end_time))
                                        : '-' ?>
                                </td>

                                <td style="white-space: nowrap;">

                                    <!-- Marks Entry -->
                                    <a
                                        href="<?= base_url('exams/marks/' . $exam->id . '/' . $subject->id) ?>"
                                        class="action-btn marks-btn"
                                        title="Enter Marks"
                                        aria-label="Enter Marks"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Edit Subject -->
                                    <a
                                        href="<?= base_url('exams/subjects/edit/' . $subject->id) ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Subject"
                                        aria-label="Edit Subject"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty-state">

                    <i class="fa-solid fa-book-open"></i>

                    <div>
                        No subjects have been added to this exam yet.
                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
```
