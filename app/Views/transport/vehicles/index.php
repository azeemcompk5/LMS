<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.vehicles-page {
    padding: 0;
}

.vehicles-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 24px;
}

.vehicles-header h1 {
    margin: 0 0 6px;
    font-size: 28px;
    color: #111827;
}

.vehicles-header p {
    margin: 0;
    font-size: 14px;
    color: #6b7280;
}

.vehicle-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 17px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.vehicle-add-btn:hover {
    background: #1d4ed8;
}

.vehicles-table-box {
    overflow-x: auto;
    padding: 20px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.vehicles-table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}

.vehicles-table th,
.vehicles-table td {
    padding: 14px 12px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.vehicles-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
}

.vehicles-table td {
    color: #374151;
    font-size: 14px;
}

.vehicle-name {
    color: #111827;
    font-weight: 600;
}

.vehicle-number {
    color: #2563eb;
    font-weight: 600;
}

.vehicle-type {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 6px;
    background: #eff6ff;
    color: #1d4ed8;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.vehicle-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.vehicle-status.active {
    color: #15803d;
    background: #dcfce7;
}

.vehicle-status.inactive {
    color: #b91c1c;
    background: #fee2e2;
}

.vehicle-status.maintenance {
    color: #b45309;
    background: #fef3c7;
}

.vehicle-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.vehicle-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 6px;
    background: transparent;
    font-size: 15px;
    text-decoration: none;
    cursor: pointer;
}

.vehicle-edit {
    color: #059669;
}

.vehicle-delete {
    color: #dc2626;
}

.vehicle-edit:hover {
    background: #ecfdf5;
}

.vehicle-delete:hover {
    background: #fef2f2;
}

.vehicle-empty {
    padding: 45px 20px !important;
    text-align: center !important;
    color: #6b7280 !important;
}

.vehicle-empty i {
    display: block;
    margin-bottom: 12px;
    color: #94a3b8;
    font-size: 32px;
}

@media (max-width: 650px) {
    .vehicles-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .vehicle-add-btn {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .vehicles-table-box {
        padding: 12px;
    }
}
</style>

<div class="container vehicles-page">

    <div class="vehicles-header">
        <div>
            <h1>Vehicles Management</h1>
            <p>Manage school buses, vans and assigned drivers.</p>
        </div>

        <a href="<?= base_url('transport/vehicles/create') ?>"
           class="vehicle-add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Vehicle
        </a>
    </div>

    <div class="vehicles-table-box">

        <table class="vehicles-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($vehicles)): ?>

                    <?php foreach ($vehicles as $index => $vehicle): ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <span class="vehicle-name">
                                    <?= esc($vehicle->vehicle_name) ?>
                                </span>
                            </td>

                            <td>
                                <span class="vehicle-number">
                                    <?= esc($vehicle->vehicle_number) ?>
                                </span>
                            </td>

                            <td>
                                <span class="vehicle-type">
                                    <?= esc(ucfirst($vehicle->vehicle_type)) ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($vehicle->capacity) ?> seats
                            </td>

                            <td>
                                <?= esc($vehicle->driver_name ?? 'Not assigned') ?>
                            </td>

                            <td>
                                <span class="vehicle-status <?= esc(strtolower($vehicle->status)) ?>">
                                    <?= esc(ucfirst($vehicle->status)) ?>
                                </span>
                            </td>

                            <td>
                                <div class="vehicle-actions">

                                    <a
                                        href="<?= base_url('transport/vehicles/edit/' . $vehicle->id) ?>"
                                        class="vehicle-action vehicle-edit"
                                        title="Edit Vehicle"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form
                                        action="<?= base_url('transport/vehicles/delete/' . $vehicle->id) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this vehicle?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="vehicle-action vehicle-delete"
                                            title="Delete Vehicle"
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
                        <td colspan="8" class="vehicle-empty">
                            <i class="fa-solid fa-bus"></i>
                            <strong>No vehicles found</strong>
                            <p>No school vehicles have been added yet.</p>
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>