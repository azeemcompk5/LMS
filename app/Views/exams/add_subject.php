<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .card-header h2 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }

    .form-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    .form-group input {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
    }

    .form-group input:focus {
        border-color: #059669;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .cancel-btn {
        background: #6b7280;
        color: white;
    }

    .save-btn {
        background: #059669;
        color: white;
    }

    .save-btn:hover {
        background: #047857;
    }

    @media (max-width: 650px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            justify-content: center;
        }
    }
</style>

<div class="container">

    <div class="page-header">
        <h1>Add Exam Subject</h1>
        <p>Add a subject to: <strong><?= esc($exam->name) ?></strong></p>
    </div>

    <div class="card">

        <div class="card-header">
            <h2>
                <i class="fa-solid fa-book"></i>
                Subject Information
            </h2>
        </div>

        <div class="form-body">

            <form action="<?= base_url('exams/subjects/store') ?>" method="post">

                <input type="hidden" name="exam_id" value="<?= esc($exam->id) ?>">

                <div class="form-group">
                    <label>Subject Name</label>
                    <input
                        type="text"
                        name="subject_name"
                        placeholder="e.g. Mathematics"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Total Marks</label>
                    <input
                        type="number"
                        name="total_marks"
                        value="100"
                        min="1"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Exam Date</label>
                    <input
                        type="date"
                        name="exam_date"
                    >
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>Start Time</label>
                        <input
                            type="time"
                            name="start_time"
                        >
                    </div>

                    <div class="form-group">
                        <label>End Time</label>
                        <input
                            type="time"
                            name="end_time"
                        >
                    </div>

                </div>

                <div class="actions">

                    <a
                        href="<?= base_url('exams/view/' . $exam->id) ?>"
                        class="btn cancel-btn"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn save-btn">
                        <i class="fa-solid fa-check"></i>
                        Save Subject
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>