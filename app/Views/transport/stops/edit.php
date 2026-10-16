<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.stop-form-page {
    max-width: 900px;
    margin: 0 auto;
}

.form-header {
    margin-bottom: 24px;
}

.form-header h1 {
    margin: 0 0 6px;
    color: #111827;
    font-size: 27px;
}

.form-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.6;
}

.stop-form-card {
    padding: 25px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.form-group {
    min-width: 0;
    margin-bottom: 18px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #374151;
    font-size: 13px;
    font-weight: 600;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 11px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    background: #fff;
    color: #111827;
    font-size: 14px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #2563eb;
}

.form-group textarea {
    min-height: 90px;
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 8px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.form-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 17px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.cancel-btn {
    background: #f3f4f6;
    color: #374151;
}

.save-btn {
    background: #2563eb;
    color: #fff;
}

.save-btn:hover {
    background: #1d4ed8;
}

@media (max-width: 600px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .stop-form-card {
        padding: 17px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-btn {
        width: 100%;
        box-sizing: border-box;
    }
}
</style>

<div class="container stop-form-page">

    <div class="form-header">
        <h1>Edit Pickup & Drop-off Stop</h1>
        <p>Update the stop details and transport schedule.</p>
    </div>

    <div class="stop-form-card">

        <form action="<?= base_url('transport/stops/update/' . $stop->id) ?>"
              method="post">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-group full-width">
                    <label for="route_id">Transport Route *</label>

                    <select id="route_id" name="route_id" required>
                        <option value="">Select a route</option>

                        <?php foreach ($routes as $route): ?>
                            <option
                                value="<?= esc($route->id) ?>"
                                <?= (string) $stop->route_id === (string) $route->id ? 'selected' : '' ?>
                            >
                                <?= esc($route->route_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stop_name">Stop Name *</label>

                    <input
                        type="text"
                        id="stop_name"
                        name="stop_name"
                        value="<?= esc($stop->stop_name) ?>"
                        maxlength="150"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="stop_type">Stop Type *</label>

                    <select id="stop_type" name="stop_type" required>
                        <option value="both"
                            <?= $stop->stop_type === 'both' ? 'selected' : '' ?>>
                            Pickup & Drop-off
                        </option>

                        <option value="pickup"
                            <?= $stop->stop_type === 'pickup' ? 'selected' : '' ?>>
                            Pickup Only
                        </option>

                        <option value="dropoff"
                            <?= $stop->stop_type === 'dropoff' ? 'selected' : '' ?>>
                            Drop-off Only
                        </option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="stop_address">Stop Address</label>

                    <textarea
                        id="stop_address"
                        name="stop_address"
                    ><?= esc($stop->stop_address ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="stop_sequence">Stop Order *</label>

                    <input
                        type="number"
                        id="stop_sequence"
                        name="stop_sequence"
                        min="1"
                        max="65535"
                        value="<?= esc($stop->stop_sequence) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>

                    <select id="status" name="status" required>
                        <option value="active"
                            <?= $stop->status === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="inactive"
                            <?= $stop->status === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup_time">Pickup Time</label>

                    <input
                        type="time"
                        id="pickup_time"
                        name="pickup_time"
                        value="<?= !empty($stop->pickup_time) ? esc(substr($stop->pickup_time, 0, 5)) : '' ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="dropoff_time">Drop-off Time</label>

                    <input
                        type="time"
                        id="dropoff_time"
                        name="dropoff_time"
                        value="<?= !empty($stop->dropoff_time) ? esc(substr($stop->dropoff_time, 0, 5)) : '' ?>"
                    >
                </div>

            </div>

            <div class="form-actions">

                <a href="<?= base_url('transport/stops') ?>"
                   class="form-btn cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="form-btn save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Stop
                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>