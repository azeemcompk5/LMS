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

    .row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .row:last-child {
        border-bottom: none;
    }

    .label {
        width: 190px;
        font-weight: 600;
        color: #374151;
    }

    .value {
        flex: 1;
        color: #6b7280;
    }

    .paid {
        color: #15803d;
        font-weight: 600;
    }

    .pending {
        color: #d97706;
        font-weight: 600;
    }

    .partial {
        color: #2563eb;
        font-weight: 600;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Fee Details</h1>
            <p>View fee and payment information</p>
        </div>

        <a href="<?= base_url('fees') ?>" class="back-btn">
            ← Back to Fees
        </a>

    </div>

    <div class="card">

        <div class="row">
            <div class="label">Admission No.</div>
            <div class="value">
                <?= esc($fee->admission_no) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Student Name</div>
            <div class="value">
                <?= esc($fee->first_name) ?>
                <?= esc($fee->last_name) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Fee Type</div>
            <div class="value">
                <?= esc($fee->fee_type) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Amount</div>
            <div class="value">
                PKR <?= number_format($fee->amount, 2) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Paid Amount</div>
            <div class="value">
                PKR <?= number_format($fee->paid_amount, 2) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Due Date</div>
            <div class="value">
                <?= esc($fee->due_date) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Payment Date</div>
            <div class="value">
                <?= esc($fee->payment_date) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Payment Method</div>
            <div class="value">
                <?= esc($fee->payment_method) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Status</div>
            <div class="value <?= strtolower($fee->status) ?>">
                <?= esc(ucfirst($fee->status)) ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Remarks</div>
            <div class="value">
                <?= esc($fee->remarks) ?>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>