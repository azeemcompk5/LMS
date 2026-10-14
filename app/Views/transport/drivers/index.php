<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.drivers-page {
    padding: 0;
}

.drivers-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 24px;
}

.drivers-header h1 {
    margin: 0 0 6px;
    font-size: 28px;
    color: #111827;
}

.drivers-header p {
    margin: 0;
    font-size: 14px;
    color: #6b7280;
}

.drivers-add-btn {
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

.drivers-add-btn:hover {
    background: #1d4ed8;
}

.drivers-table-box {
    overflow-x: auto;
    padding: 20px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.drivers-table {
    width: 100%;
    min-width: 700px;
    border-collapse: collapse;
}

.drivers-table th,
.drivers-table td {
    padding: 14px 12px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.drivers-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
}

.drivers-table td {
    color: #374151;
    font-size: 14px;
}

.driver-name {
    color: #111827;
    font-weight: 600;
}

.driver-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.driver-status.active {
    color: #15803d;
    background: #dcfce7;
}

.driver-status.inactive {
    color: #b91c1c;
    background: #fee2e2;
}

.driver-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.driver-action {
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

.driver-edit {
    color: #059669;
}

.driver-delete {
    color: #dc2626;
}

.driver-edit:hover {
    background: #ecfdf5;
}

.driver-delete:hover {
    background: #fef2f2;
}

.driver-empty {
    padding: 45px 20px !important;
    text-align: center !important;
    color: #6b7280 !important;
}

.driver-empty i {
    display: block;
    margin-bottom: 12px;
    color: #94a3b8;
    font-size: 32px;
}

@media (max-width: 650px) {
    .drivers-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .drivers-add-btn {
        justify-content: center;
        width: 100%;
    }

    .drivers-table-box {
        padding: 12px;
    }
}
</style>

<div class="container drivers-page">

    <div class="drivers-header">
        <div>
            <h1>Drivers Management</h1>
            <p>Manage school transport drivers and their details.</p>
        </div>

        <a href="<?= base_url('transport/drivers/create') ?>"
           class="drivers-add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Driver
        </a>
    </div>

    <div class="drivers-table-box">

        <table class="drivers-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Driver Name</th>
                    <th>Phone</th>
                    <th>License Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($drivers)): ?>

                    <?php foreach ($drivers as $index => $driver): ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <span class="driver-name">
                                    <?= esc($driver->name) ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($driver->phone ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($driver->license_number ?? '-') ?>
                            </td>

                            <td>
                                <span class="driver-status <?= esc(strtolower($driver->status)) ?>">
                                    <?= esc(ucfirst($driver->status)) ?>
                                </span>
                            </td>

                            <td>
                                <div class="driver-actions">

                                    <a href="<?= base_url('transport/drivers/edit/' . $driver->id) ?>"
                                       class="driver-action driver-edit"
                                       title="Edit Driver">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="<?= base_url('transport/drivers/delete/' . $driver->id) ?>"
                                          method="post"
                                          onsubmit="return confirm('Are you sure you want to delete this driver?');">

                                        <?= csrf_field() ?>

                                        <button type="submit"
                                                class="driver-action driver-delete"
                                                title="Delete Driver">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="driver-empty">
                            <i class="fa-solid fa-id-card"></i>
                            <strong>No drivers found</strong>
                            <p>No transport drivers have been added yet.</p>
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>