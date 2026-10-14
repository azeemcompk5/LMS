<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.vehicle-form-page {
    max-width: 850px;
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
}

.vehicle-form-card {
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
    min-height: 95px;
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

    .vehicle-form-card {
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

<div class="container vehicle-form-page">

    <div class="form-header">
        <h1>Add Vehicle</h1>
        <p>Enter the details of a school bus, van or other vehicle.</p>
    </div>

    <div class="vehicle-form-card">

        <form action="<?= base_url('transport/vehicles/store') ?>"
              method="post">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-group">
                    <label for="vehicle_name">Vehicle Name *</label>
                    <input
                        type="text"
                        id="vehicle_name"
                        name="vehicle_name"
                        placeholder="e.g. School Bus 01"
                        maxlength="100"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="vehicle_number">Registration Number *</label>
                    <input
                        type="text"
                        id="vehicle_number"
                        name="vehicle_number"
                        placeholder="e.g. ABC-123"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="vehicle_type">Vehicle Type *</label>
                    <select id="vehicle_type" name="vehicle_type" required>
                        <option value="bus">Bus</option>
                        <option value="van">Van</option>
                        <option value="car">Car</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="capacity">Seating Capacity *</label>
                    <input
                        type="number"
                        id="capacity"
                        name="capacity"
                        min="1"
                        max="65535"
                        value="20"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="driver_id">Assign Driver</label>
                    <select id="driver_id" name="driver_id">
                        <option value="">No driver assigned</option>

                        <?php foreach ($drivers as $driver): ?>
                            <option value="<?= esc($driver->id) ?>">
                                <?= esc($driver->name) ?>
                                <?= !empty($driver->phone)
                                    ? ' — ' . esc($driver->phone)
                                    : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Vehicle Status *</label>
                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="notes">Notes</label>
                    <textarea
                        id="notes"
                        name="notes"
                        placeholder="Optional vehicle details or remarks"
                    ></textarea>
                </div>

            </div>

            <div class="form-actions">

                <a href="<?= base_url('transport/vehicles') ?>"
                   class="form-btn cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="form-btn save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Vehicle
                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>