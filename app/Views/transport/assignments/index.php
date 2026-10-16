<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.assignments-page {
    padding: 0;
}

.assignments-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 24px;
}

.assignments-header h1 {
    margin: 0 0 6px;
    color: #111827;
    font-size: 28px;
}

.assignments-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.6;
}

.assignment-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 17px;
    background: #2563eb;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.assignment-add-btn:hover {
    background: #1d4ed8;
}

.assignments-table-box {
    overflow-x: auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.assignments-table {
    width: 100%;
    min-width: 1250px;
    border-collapse: collapse;
}

.assignments-table th,
.assignments-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
    vertical-align: middle;
}

.assignments-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    white-space: nowrap;
}

.assignments-table td {
    color: #374151;
    font-size: 13px;
}

.assignment-student {
    color: #111827;
    font-weight: 600;
}

.assignment-admission {
    display: block;
    margin-top: 5px;
    color: #6b7280;
    font-size: 12px;
}

.assignment-route {
    color: #2563eb;
    font-weight: 600;
}

.assignment-fee {
    color: #047857;
    font-weight: 700;
    white-space: nowrap;
}

.assignment-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: capitalize;
    white-space: nowrap;
}

.assignment-status.active {
    background: #dcfce7;
    color: #15803d;
}

.assignment-status.inactive {
    background: #fee2e2;
    color: #b91c1c;
}

.assignment-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.assignment-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 6px;
    background: transparent;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
}

.assignment-edit {
    color: #059669;
}

.assignment-delete {
    color: #dc2626;
}

.assignment-edit:hover {
    background: #ecfdf5;
}

.assignment-delete:hover {
    background: #fef2f2;
}

.assignment-empty {
    padding: 45px 20px !important;
    text-align: center !important;
    color: #6b7280 !important;
}

.assignment-empty i {
    display: block;
    margin-bottom: 12px;
    color: #94a3b8;
    font-size: 32px;
}

@media (max-width: 650px) {
    .assignments-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .assignment-add-btn {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .assignments-table-box {
        padding: 12px;
    }
}
</style>

<div class="container assignments-page">

    <div class="assignments-header">
        <div>
            <h1>Student Transport Assignments</h1>
            <p>
                Assign students to routes, vehicles and pickup/drop-off stops.
            </p>
        </div>

        <a href="<?= base_url('transport/assignments/create') ?>"
           class="assignment-add-btn">
            <i class="fa-solid fa-plus"></i>
            Assign Student
        </a>
    </div>

    <div class="assignments-table-box">

        <table class="assignments-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Route</th>
                    <th>Vehicle</th>
                    <th>Pickup Stop</th>
                    <th>Drop-off Stop</th>
                    <th>Monthly Fee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($assignments)): ?>

                    <?php foreach ($assignments as $index => $assignment): ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <span class="assignment-student">
                                    <?= esc(trim(($assignment->first_name ?? '') . ' ' . ($assignment->last_name ?? ''))) ?>
                                </span>

                                <span class="assignment-admission">
                                    <?= esc($assignment->admission_no ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="assignment-route">
                                    <?= esc($assignment->route_name ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <?php if (!empty($assignment->vehicle_id)): ?>
                                    <?= esc($assignment->vehicle_name ?? '-') ?>
                                    <span class="assignment-admission">
                                        <?= esc($assignment->vehicle_number ?? '') ?>
                                    </span>
                                <?php else: ?>
                                    Not assigned
                                <?php endif; ?>
                            </td>

                            <td>
                                <?= esc($assignment->pickup_stop_name ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($assignment->dropoff_stop_name ?? '-') ?>
                            </td>

                            <td>
                                <span class="assignment-fee">
                                    PKR <?= number_format((float) $assignment->monthly_fee, 2) ?>
                                </span>
                            </td>

                            <td>
                                <?= !empty($assignment->start_date)
                                    ? esc(date('d M Y', strtotime($assignment->start_date)))
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($assignment->end_date)
                                    ? esc(date('d M Y', strtotime($assignment->end_date)))
                                    : '-' ?>
                            </td>

                            <td>
                                <span class="assignment-status <?= esc(strtolower($assignment->status)) ?>">
                                    <?= esc(ucfirst($assignment->status)) ?>
                                </span>
                            </td>

                            <td>
                                <div class="assignment-actions">

                                    <a
                                        href="<?= base_url('transport/assignments/edit/' . $assignment->id) ?>"
                                        class="assignment-action assignment-edit"
                                        title="Edit Assignment"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form
                                        action="<?= base_url('transport/assignments/delete/' . $assignment->id) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this transport assignment?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="assignment-action assignment-delete"
                                            title="Delete Assignment"
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
                        <td colspan="11" class="assignment-empty">
                            <i class="fa-solid fa-user-graduate"></i>
                            <strong>No student assignments found</strong>
                            <p>No students have been assigned to transport yet.</p>
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>