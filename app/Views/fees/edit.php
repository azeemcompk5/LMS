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
            <h1>Edit Fee</h1>
            <p>Update fee and payment information</p>
        </div>

        <a href="<?= base_url('fees') ?>" class="back-btn">
            ← Back to Fees
        </a>

    </div>

    <div class="card">

        <form action="<?= base_url('fees/update/' . $fee->id) ?>" method="post">

            <div class="form-group">
                <label>Student</label>

                <select name="student_id" required>

                    <option value="">Select Student</option>

                    <?php foreach ($students as $student): ?>

                        <option
                            value="<?= $student->id ?>"
                            <?= $fee->student_id == $student->id ? 'selected' : '' ?>
                        >
                            <?= esc($student->first_name . ' ' . $student->last_name) ?>
                            (<?= esc($student->admission_no) ?>)
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <label>Fee Type</label>

                <input
                    type="text"
                    name="fee_type"
                    value="<?= esc($fee->fee_type) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Amount</label>

                <input
                    type="number"
                    name="amount"
                    step="0.01"
                    min="0"
                    value="<?= esc($fee->amount) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Due Date</label>

                <input
                    type="date"
                    name="due_date"
                    value="<?= esc($fee->due_date) ?>"
                >
            </div>

            <div class="form-group">
                <label>Paid Amount</label>

                <input
                    type="number"
                    name="paid_amount"
                    step="0.01"
                    min="0"
                    value="<?= esc($fee->paid_amount) ?>"
                >
            </div>

            <div class="form-group">
                <label>Payment Date</label>

                <input
                    type="date"
                    name="payment_date"
                    value="<?= esc($fee->payment_date) ?>"
                >
            </div>

            <div class="form-group">
                <label>Payment Method</label>

                <select name="payment_method">

                    <option value="">Select Method</option>

                    <option value="Cash" <?= $fee->payment_method == 'Cash' ? 'selected' : '' ?>>
                        Cash
                    </option>

                    <option value="Bank Transfer" <?= $fee->payment_method == 'Bank Transfer' ? 'selected' : '' ?>>
                        Bank Transfer
                    </option>

                    <option value="Online" <?= $fee->payment_method == 'Online' ? 'selected' : '' ?>>
                        Online
                    </option>

                    <option value="Cheque" <?= $fee->payment_method == 'Cheque' ? 'selected' : '' ?>>
                        Cheque
                    </option>

                </select>

            </div>

            <div class="form-group">
                <label>Remarks</label>

                <textarea name="remarks"><?= esc($fee->remarks) ?></textarea>
            </div>

            <button type="submit" class="save-btn">
                Update Fee
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>