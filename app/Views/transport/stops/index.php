<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.stops-page {
    padding: 0;
}

.stops-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 24px;
}

.stops-header h1 {
    margin: 0 0 6px;
    color: #111827;
    font-size: 28px;
}

.stops-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.stop-add-btn {
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

.stop-add-btn:hover {
    background: #1d4ed8;
}

.stops-table-box {
    overflow-x: auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.stops-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
}

.stops-table th,
.stops-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

.stops-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    white-space: nowrap;
}

.stops-table td {
    color: #374151;
    font-size: 13px;
}

.stop-name {
    color: #111827;
    font-weight: 600;
}

.stop-route {
    color: #2563eb;
    font-weight: 600;
}

.stop-type,
.stop-status {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: capitalize;
    white-space: nowrap;
}

.stop-type.pickup {
    background: #dbeafe;
    color: #1d4ed8;
}

.stop-type.dropoff {
    background: #fef3c7;
    color: #92400e;
}

.stop-type.both {
    background: #f3e8ff;
    color: #7e22ce;
}

.stop-status.active {
    background: #dcfce7;
    color: #15803d;
}

.stop-status.inactive {
    background: #fee2e2;
    color: #b91c1c;
}

.stop-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.stop-action {
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

.stop-edit {
    color: #059669;
}

.stop-delete {
    color: #dc2626;
}

.stop-edit:hover {
    background: #ecfdf5;
}

.stop-delete:hover {
    background: #fef2f2;
}

.stop-empty {
    padding: 45px 20px !important;
    text-align: center !important;
    color: #6b7280 !important;
}

.stop-empty i {
    display: block;
    margin-bottom: 12px;
    color: #94a3b8;
    font-size: 32px;
}

@media (max-width: 650px) {
    .stops-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .stop-add-btn {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .stops-table-box {
        padding: 12px;
    }
}
</style>

<div class="container stops-page">

    <div class="stops-header">
        <div>
            <h1>Pickup & Drop-off Stops</h1>
            <p>Manage route stops, stop order and pickup/drop-off times.</p>
        </div>

        <a href="<?= base_url('transport/stops/create') ?>"
           class="stop-add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Stop
        </a>
    </div>

    <div class="stops-table-box">

        <table class="stops-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Route</th>
                    <th>Stop Name</th>
                    <th>Address</th>
                    <th>Stop Type</th>
                    <th>Sequence</th>
                    <th>Pickup Time</th>
                    <th>Drop-off Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($stops)): ?>

                    <?php foreach ($stops as $index => $stop): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <span class="stop-route">
                                    <?= esc($stop->route_name ?? 'Unknown Route') ?>
                                </span>
                            </td>

                            <td>
                                <span class="stop-name">
                                    <?= esc($stop->stop_name) ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($stop->stop_address ?? '-') ?>
                            </td>

                            <td>
                                <span class="stop-type <?= esc(strtolower($stop->stop_type)) ?>">
                                    <?= esc(ucfirst($stop->stop_type)) ?>
                                </span>
                            </td>

                            <td><?= esc($stop->stop_sequence) ?></td>

                            <td>
                                <?= !empty($stop->pickup_time)
                                    ? date('h:i A', strtotime($stop->pickup_time))
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($stop->dropoff_time)
                                    ? date('h:i A', strtotime($stop->dropoff_time))
                                    : '-' ?>
                            </td>

                            <td>
                                <span class="stop-status <?= esc(strtolower($stop->status)) ?>">
                                    <?= esc(ucfirst($stop->status)) ?>
                                </span>
                            </td>

                            <td>
                                <div class="stop-actions">

                                    <a
                                        href="<?= base_url('transport/stops/edit/' . $stop->id) ?>"
                                        class="stop-action stop-edit"
                                        title="Edit Stop"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form
                                        action="<?= base_url('transport/stops/delete/' . $stop->id) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this stop?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="stop-action stop-delete"
                                            title="Delete Stop"
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
                        <td colspan="10" class="stop-empty">
                            <i class="fa-solid fa-location-dot"></i>
                            <strong>No stops found</strong>
                            <p>No pickup or drop-off stops have been added yet.</p>
                        </td>
                    </tr>

                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>