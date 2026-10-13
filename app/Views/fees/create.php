<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 750px;
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

        <h1>Add Fee</h1>

        <p class="subtitle">
            Create a fee record for a student.
        </p>

        <form action="<?= base_url('fees/store') ?>" method="post">

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

            <label>Fee Type *</label>

            <input
                type="text"
                name="fee_type"
                placeholder="e.g. Monthly Fee"
                required
            >

            <label>Total Amount *</label>

            <input
                type="number"
                name="amount"
                step="0.01"
                min="0"
                placeholder="e.g. 5000"
                required
            >

            <label>Paid Amount</label>

            <input
                type="number"
                name="paid_amount"
                step="0.01"
                min="0"
                value="0"
                placeholder="e.g. 5000"
            >

            <label>Due Date</label>

            <input
                type="date"
                name="due_date"
            >

            <label>Payment Date</label>

            <input
                type="date"
                name="payment_date"
            >

            <label>Payment Method</label>

            <select name="payment_method">

                <option value="">Select Method</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank Transfer</option>
                <option value="online">Online Payment</option>
                <option value="cheque">Cheque</option>

            </select>

            <label>Remarks</label>

            <textarea
                name="remarks"
                placeholder="Optional remarks"
            ></textarea>

            <div class="buttons">

                <button type="submit" class="save-btn">
                    Save Fee
                </button>

                <a href="<?= base_url('fees') ?>" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>