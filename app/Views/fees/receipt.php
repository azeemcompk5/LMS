<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .receipt-page {
        max-width: 850px;
        margin: 0 auto;
    }

    .receipt-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .back-btn,
    .print-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .back-btn {
        background: #f1f5f9;
        color: #475569;
    }

    .back-btn:hover {
        background: #e2e8f0;
    }

    .print-btn {
        background: #2563eb;
        color: white;
    }

    .print-btn:hover {
        background: #1d4ed8;
    }

    .receipt-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .receipt-header {
        text-align: center;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 25px;
        margin-bottom: 25px;
    }

    .receipt-header h1 {
        margin: 0 0 6px;
        color: #111827;
        font-size: 30px;
    }

    .receipt-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .receipt-title {
        margin-top: 18px;
        display: inline-block;
        padding: 7px 18px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .receipt-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 25px;
        color: #64748b;
        font-size: 13px;
    }

    .receipt-meta strong {
        color: #111827;
    }

    .section-title {
        margin: 0 0 15px;
        font-size: 15px;
        color: #111827;
        font-weight: 700;
    }

    .student-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px 30px;
        margin-bottom: 30px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 8px;
    }

    .info-label {
        color: #64748b;
        font-size: 13px;
    }

    .info-value {
        color: #111827;
        font-weight: 600;
        font-size: 14px;
        text-align: right;
    }

    .fee-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .fee-table th,
    .fee-table td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    .fee-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
    }

    .fee-table td {
        color: #374151;
        font-size: 14px;
    }

    .fee-table td:last-child,
    .fee-table th:last-child {
        text-align: right;
    }

    .total-row td {
        font-weight: 700;
        color: #111827;
    }

    .paid-row td {
        color: #059669;
        font-weight: 600;
    }

    .balance-row td {
        color: #dc2626;
        font-weight: 700;
    }

    .status-paid {
        display: inline-flex;
        padding: 5px 11px;
        border-radius: 20px;
        background: #dcfce7;
        color: #15803d;
        font-size: 12px;
        font-weight: 700;
    }

    .status-partial {
        display: inline-flex;
        padding: 5px 11px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
    }

    .status-pending {
        display: inline-flex;
        padding: 5px 11px;
        border-radius: 20px;
        background: #fef3c7;
        color: #b45309;
        font-size: 12px;
        font-weight: 700;
    }

    .receipt-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        color: #64748b;
        font-size: 12px;
    }

    .signature-area {
        margin-top: 45px;
        display: flex;
        justify-content: flex-end;
    }

    .signature {
        width: 180px;
        text-align: center;
        border-top: 1px solid #94a3b8;
        padding-top: 8px;
        color: #64748b;
        font-size: 12px;
    }

    @media print {
        body {
            background: white !important;
        }

        .receipt-actions {
            display: none !important;
        }

        .receipt-card {
            box-shadow: none;
            padding: 20px;
            border-radius: 0;
        }

        .receipt-page {
            max-width: 100%;
        }
    }

    @media (max-width: 650px) {
        .receipt-card {
            padding: 20px;
        }

        .student-info {
            grid-template-columns: 1fr;
        }

        .receipt-meta {
            flex-direction: column;
            gap: 6px;
        }

        .receipt-footer {
            flex-direction: column;
            gap: 8px;
        }

        .info-item {
            flex-direction: column;
            gap: 4px;
        }

        .info-value {
            text-align: left;
        }
    }
</style>

<div class="receipt-page">

    <div class="receipt-actions">

        <a href="<?= base_url('fees') ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Fees
        </a>

        <button onclick="window.print()" class="print-btn">
            <i class="fa-solid fa-print"></i>
            Print Receipt
        </button>

    </div>

    <div class="receipt-card">

        <div class="receipt-header">
            <h1>MySchoolHub</h1>
            <p>School Fee Payment Receipt</p>

            <div class="receipt-title">
                FEE RECEIPT
            </div>
        </div>

        <div class="receipt-meta">
            <span>
                Receipt No:
                <strong>#<?= esc($fee->id ?? '-') ?></strong>
            </span>

            <span>
                Generated:
                <strong><?= date('d M Y') ?></strong>
            </span>
        </div>

        <h3 class="section-title">Student Information</h3>

        <div class="student-info">

            <div class="info-item">
                <span class="info-label">Student Name</span>
                <span class="info-value">
                    <?= esc($fee->first_name ?? '') ?>
                    <?= esc($fee->last_name ?? '') ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Admission No.</span>
                <span class="info-value">
                    <?= esc($fee->admission_no ?? '-') ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Fee Type</span>
                <span class="info-value">
                    <?= esc($fee->fee_type ?? '-') ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Due Date</span>
                <span class="info-value">
                    <?= esc($fee->due_date ?? '-') ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Payment Date</span>
                <span class="info-value">
                    <?= esc($fee->payment_date ?: '-') ?>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Payment Method</span>
                <span class="info-value">
                    <?= esc(ucfirst($fee->payment_method ?: '-')) ?>
                </span>
            </div>

        </div>

        <?php
            $amount = (float) ($fee->amount ?? 0);
            $paid = (float) ($fee->paid_amount ?? 0);
            $balance = max(0, $amount - $paid);

            if ($balance <= 0) {
                $statusClass = 'status-paid';
                $statusText = 'Paid';
            } elseif ($paid > 0) {
                $statusClass = 'status-partial';
                $statusText = 'Partial Payment';
            } else {
                $statusClass = 'status-pending';
                $statusText = 'Pending';
            }
        ?>

        <h3 class="section-title">Payment Details</h3>

        <table class="fee-table">

            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>

                <tr class="total-row">
                    <td>Total Fee</td>
                    <td>PKR <?= number_format($amount, 2) ?></td>
                </tr>

                <tr class="paid-row">
                    <td>Amount Paid</td>
                    <td>PKR <?= number_format($paid, 2) ?></td>
                </tr>

                <tr class="balance-row">
                    <td>Remaining Balance</td>
                    <td>PKR <?= number_format($balance, 2) ?></td>
                </tr>

                <tr>
                    <td><strong>Payment Status</strong></td>
                    <td>
                        <span class="<?= $statusClass ?>">
                            <?= $statusText ?>
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

        <div class="signature-area">
            <div class="signature">
                Authorized Signature
            </div>
        </div>

        <div class="receipt-footer">
            <span>Thank you for your payment.</span>
            <span>Generated by MySchoolHub</span>
        </div>

    </div>

</div>

<?= $this->endSection() ?>