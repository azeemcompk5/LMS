
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .history-container { padding: 0; }

    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .history-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .history-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: #f1f5f9;
        color: #334155;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    }

    .back-btn:hover { background: #e2e8f0; }

    .student-card, .summary-card, .table-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .student-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .student-info h2 {
        margin: 0 0 5px;
        font-size: 20px;
        color: #111827;
    }

    .student-info p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 20px;
    }

    .summary-card { margin-bottom: 0; }

    .summary-card span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .summary-card strong {
        color: #111827;
        font-size: 20px;
    }

    .table-box { overflow-x: auto; }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    th, td {
        padding: 14px 13px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    td { color: #374151; font-size: 14px; }

    .amount { font-weight: 600; color: #111827; }
    .paid { color: #059669; font-weight: 600; }
    .balance { color: #dc2626; font-weight: 600; }

    .status {
        display: inline-flex;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status.paid { background: #dcfce7; color: #15803d; }
    .status.pending { background: #fef3c7; color: #b45309; }
    .status.partial { background: #dbeafe; color: #1d4ed8; }

    .history-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        color: #7c3aed;
        background: #f5f3ff;
        text-decoration: none;
        border-radius: 6px;
        font-size: 15px;
        transition: 0.2s ease;
    }

    .history-action-btn:hover {
        background: #ede9fe;
        transform: translateY(-1px);
    }

    .empty {
        text-align: center;
        padding: 40px;
        color: #6b7280;
    }

    @media (max-width: 700px) {
        .history-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 15px;
        }

        .summary { grid-template-columns: 1fr; }
    }
</style>

<div class="history-container">

    <div class="history-header">
        <div>
            <h1>Fee History</h1>
            <p>Complete payment history of the student</p>
        </div>

        <a href="<?= base_url('fees') ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Fees
        </a>
    </div>

    <div class="student-card">
        <div class="student-info">
            <div class="student-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <h2>
                    <?= esc($student->first_name ?? '') ?>
                    <?= esc($student->last_name ?? '') ?>
                </h2>

                <p>
                    Admission No:
                    <strong><?= esc($student->admission_no ?? '-') ?></strong>
                </p>
            </div>
        </div>
    </div>

    <div class="summary">
        <div class="summary-card">
            <span>Total Fees</span>
            <strong>PKR <?= number_format($totalFees, 2) ?></strong>
        </div>

        <div class="summary-card">
            <span>Total Paid</span>
            <strong>PKR <?= number_format($totalPaid, 2) ?></strong>
        </div>

        <div class="summary-card">
            <span>Outstanding</span>
            <strong>PKR <?= number_format($totalOutstanding, 2) ?></strong>
        </div>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($fees)): ?>

                    <?php foreach ($fees as $index => $fee): ?>
                        <?php
                            $balance = max(
                                0,
                                (float) $fee->amount - (float) $fee->paid_amount
                            );
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td><?= esc($fee->fee_type ?? '-') ?></td>

                            <td class="amount">
                                PKR <?= number_format((float) $fee->amount, 2) ?>
                            </td>

                            <td class="paid">
                                PKR <?= number_format((float) $fee->paid_amount, 2) ?>
                            </td>

                            <td class="balance">
                                PKR <?= number_format($balance, 2) ?>
                            </td>

                            <td><?= esc($fee->due_date ?? '-') ?></td>

                            <td>
                                <span class="status <?= esc(strtolower($fee->status ?? 'pending')) ?>">
                                    <?= esc(ucfirst($fee->status ?? 'Pending')) ?>
                                </span>
                            </td>

                            <td>
                                <a
                                    href="<?= base_url('fees/receipt/' . $fee->id) ?>"
                                    class="history-action-btn"
                                    title="Print Receipt"
                                    aria-label="Print Receipt"
                                >
                                    <i class="fa-solid fa-receipt"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="empty">
                            No fee history found for this student.
                        </td>
                    </tr>

                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>