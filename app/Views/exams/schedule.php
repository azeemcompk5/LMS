<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .schedule-container {
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
        margin: 0 0 5px;
        font-size: 28px;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .back-btn {
        background: #6b7280;
        color: white;
    }

    .add-btn {
        background: #059669;
        color: white;
    }

    .card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .card-header {
        padding: 18px 22px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 13px 16px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    th {
        background: #f8fafc;
        color: #374151;
        font-size: 12px;
        text-transform: uppercase;
    }

    td {
        color: #4b5563;
    }

    .subject-name {
        font-weight: 700;
        color: #111827;
    }

    .actions {
        white-space: nowrap;
    }

    .edit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        text-decoration: none;
        border: 1px solid #dbeafe;
    }

    .edit-btn:hover {
        background: #dbeafe;
    }

    .empty-state {
        text-align: center;
        padding: 45px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 38px;
        margin-bottom: 12px;
        color: #9ca3af;
    }

    .empty-state h3 {
        margin: 8px 0;
        color: #374151;
    }
    @media print {
    .page-header .back-btn,
    .card-header .btn,
    .actions {
        display: none !important;
    }

    .schedule-container {
        max-width: 100%;
        margin: 0;
    }

    .card {
        box-shadow: none;
        border: none;
    }

    .card-header {
        background: white;
    }

    body {
        background: white !important;
    }
}

    @media (max-width: 700px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="schedule-container">

    <div class="page-header">

        <div>
            <h1>Exam Schedule</h1>

            <p>
                <?= esc($exam->name) ?> — Manage examination timetable
            </p>
        </div>

        <a
            href="<?= base_url('exams/view/' . $exam->id) ?>"
            class="btn back-btn"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Exam
        </a>

    </div>

    <div class="card-header">

    <h2>
        <i class="fa-solid fa-calendar-days"></i>
        Examination Timetable
    </h2>

    <div style="display:flex; gap:10px; align-items:center;">

        <button
            type="button"
            onclick="window.print()"
            class="btn"
            style="background:#374151; color:white; border:none; cursor:pointer;"
        >
            <i class="fa-solid fa-print"></i>
            Print
        </button>

        <a
            href="<?= base_url('exams/schedule/add/' . $exam->id) ?>"
            class="btn add-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Schedule
        </a>

    </div>

</div>

        <?php if (!empty($schedules)): ?>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($schedules as $schedule): ?>

                            <?php
                            $subjectName = 'Unknown Subject';

                            foreach ($subjects as $subject) {
                                if ($subject->id == $schedule->subject_id) {
                                    $subjectName = $subject->subject_name;
                                    break;
                                }
                            }
                            ?>

                            <tr>

                                <td class="subject-name">
                                    <?= esc($subjectName) ?>
                                </td>

                                <td>
                                    <?= !empty($schedule->schedule_date)
                                        ? date('d M Y', strtotime($schedule->schedule_date))
                                        : 'Not specified'
                                    ?>
                                </td>

                                <td>
                                    <?= !empty($schedule->start_time)
                                        ? date('h:i A', strtotime($schedule->start_time))
                                        : '--'
                                    ?>
                                </td>

                                <td>
                                    <?= !empty($schedule->end_time)
                                        ? date('h:i A', strtotime($schedule->end_time))
                                        : '--'
                                    ?>
                                </td>

                                <td>
                                    <?= !empty($schedule->room)
                                        ? esc($schedule->room)
                                        : 'Not specified'
                                    ?>
                                </td>

                                <td class="actions">

    <a
        href="<?= base_url('exams/schedule/edit/' . $schedule->id) ?>"
        class="edit-btn"
        title="Edit Schedule"
    >
        <i class="fa-solid fa-pen"></i>
    </a>

    <form action="<?= base_url('exams/schedule/delete/' . $schedule->id) ?>"
          method="post"
          style="display:inline;">

        <button
            type="submit"
            title="Delete Schedule"
            onclick="return confirm('Are you sure you want to delete this schedule?');"
            style="
                display:inline-flex;
                align-items:center;
                justify-content:center;
                width:34px;
                height:34px;
                border-radius:7px;
                background:#fef2f2;
                color:#dc2626;
                border:1px solid #fee2e2;
                cursor:pointer;
                margin-left:6px;
            "
        >
                  <i class="fa-solid fa-trash"></i>
        </button>

    </form>

</td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                <i class="fa-solid fa-calendar-xmark"></i>

                <h3>No Schedule Created</h3>

                <p>
                    No examination schedule has been created for this exam yet.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>