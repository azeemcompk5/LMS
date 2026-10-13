```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

.container {
    padding: 0;
}

/* PAGE HEADER */

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

.header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
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
}

/* SEARCH */

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
}

.search-box input:focus {
    border-color: #2563eb;
}
/* ALERT MESSAGES */

.alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    margin-bottom: 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
}

.alert-success {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
}

.alert-error {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}

/* TABLE */

.table-box {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 950px;
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
}

td {
    color: #374151;
    font-size: 14px;
}

/* STUDENT DATA */

.admission-no {
    color: #2563eb;
    font-weight: 600;
}

.student-name {
    color: #111827;
    font-weight: 600;
}

.remarks {
    color: #64748b;
}

/* ATTENDANCE STATUS */

.attendance-status {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.attendance-status.present {
    background: #dcfce7;
    color: #15803d;
}

.attendance-status.absent {
    background: #fee2e2;
    color: #b91c1c;
}

.attendance-status.late {
    background: #fef3c7;
    color: #b45309;
}

/* ACTION BUTTONS */

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
}

.view-btn {
    color: #2563eb;
}

.edit-btn {
    color: #059669;
}

.delete-btn {
    color: #dc2626 !important;
    font-size: 16px;
}

.view-btn:hover {
    background: #eff6ff;
}

.edit-btn:hover {
    background: #ecfdf5;
}

.delete-btn:hover {
    background: #fef2f2;
}

/* EMPTY */
.empty {
    text-align: center;
    padding: 55px 20px;
    color: #6b7280;
}

.empty-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    font-size: 22px;
}

.empty-title {
    color: #111827;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 6px;
}

.empty-text {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 18px;
}

.empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 16px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.empty-btn:hover {
    background: #1d4ed8;
}

/* RESPONSIVE */

@media (max-width: 700px) {

    .header {
        align-items: flex-start;
        flex-direction: column;
    }

    .header-actions {
        width: 100%;
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

</style>

<?php
$successMessage = session()->getFlashdata('success');
$errorMessage   = session()->getFlashdata('error');
?>

<?php if ($successMessage): ?>

    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check"></i>
        <?= esc($successMessage) ?>
    </div>

<?php endif; ?>


<?php if ($errorMessage): ?>

    <div class="alert alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        <?= esc($errorMessage) ?>
    </div>

<?php endif; ?>

<div class="container">

    <!-- PAGE HEADER -->

    <div class="header">

        <div>

            <h1>
                Attendance
            </h1>

            <p>
                Manage student attendance records
            </p>

        </div>


        <div class="header-actions">

            <a
                href="<?= base_url('attendance/create') ?>"
                class="add-btn"
            >
                <i class="fa-solid fa-plus"></i>
                Mark Attendance
            </a>


            <a
                href="<?= base_url('attendance/bulk') ?>"
                class="add-btn"
                style="background:#059669;"
            >
                <i class="fa-solid fa-users"></i>
                Bulk Attendance
            </a>

        </div>

    </div>


    <!-- SEARCH -->

    <div class="toolbar">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="attendanceSearch"
                placeholder="Search attendance..."
            >

        </div>

    </div>


    <!-- TABLE -->

    <div class="table-box">

        <table id="attendanceTable">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Admission No.</th>
                    <th>Student Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                            <?php if (!empty($attendance)): ?>
                        <?php foreach ($attendance as $index => $record): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <span class="admission-no">
                                    <?= esc($record->admission_no ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="student-name">
                                    <?= esc($record->first_name ?? '-') ?>
                                    <?= esc($record->last_name ?? '') ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($record->attendance_date ?? '-') ?>
                            </td>

                            <td>

                                <span class="attendance-status <?= strtolower(esc($record->status ?? '')) ?>">
                                    <?= esc(ucfirst($record->status ?? '-')) ?>
                                </span>

                            </td>

                            <td>
                                <span class="remarks">
                                    <?= esc($record->remarks ?: '-') ?>
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="<?= base_url('attendance/view/' . $record->id) ?>"
                                        class="action-btn view-btn"
                                        title="View Attendance"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    <a
                                        href="<?= base_url('attendance/edit/' . $record->id) ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Attendance"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>


                                    <form
                                        action="<?= base_url('attendance/delete/' . $record->id) ?>"
                                        method="post"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this attendance record?');"
                                    >

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Attendance"
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
    <td colspan="7" class="empty">

        <div class="empty-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>

        <div class="empty-title">
            No Attendance Records
        </div>

        <div class="empty-text">
            No attendance records have been added yet.
        </div>

        <a href="<?= base_url('attendance/create') ?>" class="empty-btn">
            <i class="fa-solid fa-plus"></i>
            Mark Attendance
        </a>

    </td>
</tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- SEARCH SCRIPT -->

<script>

const searchInput = document.getElementById('attendanceSearch');
const attendanceTable = document.getElementById('attendanceTable');

if (searchInput && attendanceTable) {

    searchInput.addEventListener('input', function () {

        const searchValue = this.value.trim().toLowerCase();

        const rows = attendanceTable.querySelectorAll('tbody tr');

        rows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();

            if (rowText.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

}

</script>
<?= $this->endSection() ?>
```
