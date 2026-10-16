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

.form-help {
    display: block;
    margin-top: 6px;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.5;
}

.form-notice {
    margin-bottom: 20px;
    padding: 13px 15px;
    border: 1px solid #fde68a;
    border-radius: 8px;
    background: #fffbeb;
    color: #92400e;
    font-size: 13px;
    line-height: 1.6;
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

.save-btn:disabled {
    background: #9ca3af;
    cursor: not-allowed;
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
        <h1>Add Pickup & Drop-off Stop</h1>
        <p>
            Add a stop to an existing school transport route
            and set its schedule.
        </p>
    </div>

    <div class="stop-form-card">

        <?php if (empty($routes)): ?>
            <div class="form-notice">
                <strong>No active routes available.</strong><br>
                Pehle Transport Routes page par ek route add karein
                aur uska status Active rakhein. Phir yahan stop add kar sakengi.
                <br><br>
                <a href="<?= base_url('transport/routes') ?>">
                    Go to Routes Management
                </a>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transport/stops/store') ?>"
              method="post">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-group full-width">
                    <label for="route_id">Transport Route *</label>

                    <select id="route_id" name="route_id" required>
                        <option value="">Select a route</option>

                        <?php foreach ($routes as $route): ?>
                            <option value="<?= esc($route->id) ?>">
                                <?= esc($route->route_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <span class="form-help">
                        Select the route where this stop belongs.
                    </span>
                </div>

                <div class="form-group">
                    <label for="stop_name">Stop Name *</label>

                    <input
                        type="text"
                        id="stop_name"
                        name="stop_name"
                        placeholder="e.g. Hayatabad Phase 3"
                        maxlength="150"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="stop_type">Stop Type *</label>

                    <select id="stop_type" name="stop_type" required>
                        <option value="both">Pickup & Drop-off</option>
                        <option value="pickup">Pickup Only</option>
                        <option value="dropoff">Drop-off Only</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="stop_address">Stop Address</label>

                    <textarea
                        id="stop_address"
                        name="stop_address"
                        placeholder="Enter the stop address or landmark"
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="stop_sequence">Stop Order *</label>

                    <input
                        type="number"
                        id="stop_sequence"
                        name="stop_sequence"
                        min="1"
                        max="65535"
                        value="1"
                        required
                    >

                    <span class="form-help">
                        Enter 1 for the first stop, 2 for the second, and so on.
                    </span>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>

                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup_time">Pickup Time</label>

                    <input
                        type="time"
                        id="pickup_time"
                        name="pickup_time"
                    >
                </div>

                <div class="form-group">
                    <label for="dropoff_time">Drop-off Time</label>

                    <input
                        type="time"
                        id="dropoff_time"
                        name="dropoff_time"
                    >
                </div>

            </div>

            <div class="form-actions">

                <a href="<?= base_url('transport/stops') ?>"
                   class="form-btn cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="form-btn save-btn"
                    <?= empty($routes) ? 'disabled' : '' ?>
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Stop
                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>