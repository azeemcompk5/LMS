<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.routes-page {
    padding: 0;
}

.routes-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 24px;
}

.routes-header h1 {
    margin: 0 0 6px;
    color: #111827;
    font-size: 28px;
}

.routes-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.route-add-btn {
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

.route-add-btn:hover {
    background: #1d4ed8;
}

.routes-table-box {
    overflow-x: auto;
    padding: 20px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.routes-table {
    width: 100%;
    min-width: 750px;
    border-collapse: collapse;
}

.routes-table th,
.routes-table td {
    padding: 14px 12px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.routes-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
}

.routes-table td {
    color: #374151;
    font-size: 14px;
}

.route-name {
    color: #111827;
    font-weight: 600;
}

.route-fee {
    color: #047857;
    font-weight: 700;
}

.route-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.route-status.active {
    background: #dcfce7;
    color: #15803d;
}

.route-status.inactive {
    background: #fee2e2;
    color: #b91c1c;
}

.route-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.route-action {
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

.route-edit {
    color: #059669;
}

.route-delete {
    color: #dc2626;
}

.route-edit:hover {
    background: #ecfdf5;
}

.route-delete:hover {
    background: #fef2f2;
}

.route-empty {
    padding: 45px 20px !important;
    text-align: center !important;
    color: #6b7280 !important;
}

.route-empty i {
    display: block;
    margin-bottom: 12px;
    color: #94a3b8;
    font-size: 32px;
}

@media (max-width: 650px) {
    .routes-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .route-add-btn {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .routes-table-box {
        padding: 12px;
    }
}
</style>

<div class="container routes-page">

    <div class="routes-header">
        <div>
            <h1>Transport Routes</h1>
            <p>Manage school routes and monthly transport charges.</p>
        </div>

        <a href="<?= base_url('transport/routes/create') ?>"
           class="route-add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Route
        </a>
    </div>

    <div class="routes-table-box">

        <table class="routes-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Route Name</th>
                    <th>Description</th>
                    <th>Monthly Fee</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($routes)): ?>

                    <?php foreach ($routes as $index => $route): ?>

                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <span class="route-name">
                                    <?= esc($route->route_name) ?>
                                </span>
                            </td>

                            <td>
                                <?= esc($route->description ?? '-') ?>
                            </td>

                            <td>
                                <span class="route-fee">
                                    PKR <?= number_format((float) $route->monthly_fee, 2) ?>
                                </span>
                            </td>

                            <td>
                                <span class="route-status <?= esc(strtolower($route->status)) ?>">
                                    <?= esc(ucfirst($route->status)) ?>
                                </span>
                            </td>

                            <td>
                                <div class="route-actions">

                                    <a
                                        href="<?= base_url('transport/routes/edit/' . $route->id) ?>"
                                        class="route-action route-edit"
                                        title="Edit Route"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form
                                        action="<?= base_url('transport/routes/delete/' . $route->id) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this route?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="route-action route-delete"
                                            title="Delete Route"
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
                        <td colspan="6" class="route-empty">
                            <i class="fa-solid fa-route"></i>
                            <strong>No transport routes found</strong>
                            <p>Start by adding your first school transport route.</p>
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>