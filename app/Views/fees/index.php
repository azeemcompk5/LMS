```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        padding: 0;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563eb;
        color: white;
        padding: 11px 18px;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .add-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
    }

    /* =========================
       FEE SUMMARY
    ========================= */

    .fee-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .summary-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .summary-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .summary-card span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .summary-card strong {
        display: block;
        color: #111827;
        font-size: 18px;
    }

    .total-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .collected-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .outstanding-icon {
        background: #fff7ed;
        color: #ea580c;
    }

    .records-icon {
        background: #f5f3ff;
        color: #7c3aed;
    }

    /* =========================
       SEARCH
    ========================= */

    .toolbar {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .search-box {
        position: relative;
        width: 320px;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }

    .search-box input {
        width: 100%;
        padding: 11px 13px 11px 38px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        background: white;
        transition: 0.2s ease;
        box-sizing: border-box;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    /* =========================
       TABLE
    ========================= */

    .table-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1150px;
    }

    th,
    td {
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
        letter-spacing: 0.3px;
    }

    td {
        color: #374151;
        font-size: 14px;
    }

    tbody tr {
        transition: background 0.15s ease;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================
       FEE DATA
    ========================= */

    .admission-no {
        color: #2563eb;
        font-weight: 600;
    }

    .student-name {
        color: #111827;
        font-weight: 600;
    }

    .fee-type {
        color: #475569;
        font-weight: 500;
    }

    .amount {
        color: #111827;
        font-weight: 600;
        white-space: nowrap;
    }

    .paid-amount {
        color: #059669;
        font-weight: 600;
        white-space: nowrap;
    }

    .due-date {
        color: #64748b;
        white-space: nowrap;
    }

    /* =========================
       STATUS
    ========================= */

    .payment-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .payment-status.paid {
        background: #dcfce7;
        color: #15803d;
    }

    .payment-status.pending {
        background: #fef3c7;
        color: #b45309;
    }

    .payment-status.partial {
        background: #dbeafe;
        color: #1d4ed8;
    }

    /* =========================
       ACTION BUTTONS
    ========================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 13px;
        white-space: nowrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        text-decoration: none;
        font-size: 15px;
        padding: 0;
        border: none;
        border-radius: 6px;
        background: transparent;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .view-btn {
        color: #2563eb;
    }

    .edit-btn {
        color: #059669;
    }

    .receipt-btn {
        color: #7c3aed;
    }

    .delete-btn {
        color: #dc2626 !important;
        font-size: 16px;
    }

    .view-btn:hover {
        background: #eff6ff;
        transform: translateY(-1px);
    }

    .edit-btn:hover {
        background: #ecfdf5;
        transform: translateY(-1px);
    }

    .receipt-btn:hover {
        background: #f5f3ff;
        transform: translateY(-1px);
    }

    .delete-btn:hover {
        background: #fef2f2;
        transform: translateY(-1px);
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty {
        text-align: center;
        padding: 45px;
        color: #6b7280;
        font-size: 14px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 900px) {
        .fee-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .header {
            align-items: flex-start;
            flex-direction: column;
        }

        .add-btn {
            width: 100%;
            justify-content: center;
        }

        .search-box {
            width: 100%;
        }

        .table-box {
            padding: 12px;
        }
    }

    @media (max-width: 600px) {
        .fee-summary {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">

    <!-- PAGE HEADER -->

    <div class="header">
        <div>
            <h1>Fees & Payments</h1>
            <p>Manage student fees and payment records</p>
        </div>

        <a href="<?= base_url('fees/create') ?>" class="add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Fee
        </a>
    </div>

    <!-- FEE SUMMARY -->

    <div class="fee-summary">

        <div class="summary-card">
            <div class="summary-icon total-icon">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>

            <div>
                <span>Total Fees</span>
                <strong>
                    PKR <?= number_format((float) $totalFees, 2) ?>
                </strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon collected-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>
                <span>Total Collected</span>
                <strong>
                    PKR <?= number_format((float) $totalCollected, 2) ?>
                </strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon outstanding-icon">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div>
                <span>Outstanding</span>
                <strong>
                    PKR <?= number_format((float) $totalOutstanding, 2) ?>
                </strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon records-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>

            <div>
                <span>Total Records</span>
                <strong>
                    <?= (int) $totalRecords ?>
                </strong>
            </div>
        </div>

    </div>

    <!-- SEARCH -->

    <div class="toolbar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="feeSearch"
                placeholder="Search fee records..."
            >
        </div>
    </div>

    <!-- TABLE -->

    <div class="table-box">

        <table id="feesTable">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Admission No.</th>
                    <th>Student Name</th>
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

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <span class="admission-no">
                                    <?= esc($fee->admission_no ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="student-name">
                                    <?= esc($fee->first_name ?? '') ?>
                                    <?= esc($fee->last_name ?? '') ?>
                                </span>
                            </td>

                            <td>
                                <span class="fee-type">
                                    <?= esc($fee->fee_type ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="amount">
                                    PKR <?= number_format((float) $fee->amount, 2) ?>
                                </span>
                            </td>

                            <td>
                                <span class="paid-amount">
                                    PKR <?= number_format((float) $fee->paid_amount, 2) ?>
                                </span>
                            </td>

                            <td>
                                <span class="amount">
                                    PKR <?= number_format(
                                        max(
                                            0,
                                            (float) $fee->amount - (float) $fee->paid_amount
                                        ),
                                        2
                                    ) ?>
                                </span>
                            </td>

                            <td>
                                <span class="due-date">
                                    <?= esc($fee->due_date ?: '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="payment-status <?= esc(strtolower($fee->status ?? 'pending')) ?>">
                                    <?= esc(ucfirst($fee->status ?? 'Pending')) ?>
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <!-- View -->

                                    <a
                                        href="<?= base_url('fees/view/' . $fee->id) ?>"
                                        class="action-btn view-btn"
                                        title="View Fee"
                                        aria-label="View Fee"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <!-- Fee History -->
<a
    href="<?= base_url('fees/history/' . $fee->student_id) ?>"
    class="action-btn history-btn"
    title="Fee History"
    aria-label="Fee History"
>
    <i class="fa-solid fa-clock-rotate-left"></i>
</a>

                                    <!-- Edit -->

                                    <a
                                        href="<?= base_url('fees/edit/' . $fee->id) ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Fee"
                                        aria-label="Edit Fee"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <!-- Receipt -->

                                    <a
                                        href="<?= base_url('fees/receipt/' . $fee->id) ?>"
                                        class="action-btn receipt-btn"
                                        title="Print Receipt"
                                        aria-label="Print Receipt"
                                    >
                                        <i class="fa-solid fa-receipt"></i>
                                    </a>

                                    <!-- Delete -->

                                    <form
                                        action="<?= base_url('fees/delete/' . $fee->id) ?>"
                                        method="post"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this fee record?');"
                                    >
                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Fee"
                                            aria-label="Delete Fee"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="10" class="empty">
                            No fee records found.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<!-- SEARCH SCRIPT -->

<script>
    const searchInput = document.getElementById('feeSearch');

    searchInput.addEventListener('keyup', function () {

        const searchValue = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#feesTable tbody tr'
        );

        rows.forEach(function (row) {

            const rowText = row.innerText.toLowerCase();

            row.style.display =
                rowText.includes(searchValue)
                    ? ''
                    : 'none';

        });

    });
</script>

<?= $this->endSection() ?>
```
