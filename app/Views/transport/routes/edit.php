<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.route-form-page {
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

.route-form-card {
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
    min-height: 100px;
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

    .route-form-card {
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

<div class="container route-form-page">

    <div class="form-header">
        <h1>Edit Transport Route</h1>
        <p>Update route details and monthly transport charges.</p>
    </div>

    <div class="route-form-card">

        <form action="<?= base_url('transport/routes/update/' . $route->id) ?>"
              method="post">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-group">
                    <label for="route_name">Route Name *</label>
                    <input
                        type="text"
                        id="route_name"
                        name="route_name"
                        value="<?= esc($route->route_name) ?>"
                        maxlength="150"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="monthly_fee">Monthly Transport Fee (PKR) *</label>
                    <input
                        type="number"
                        id="monthly_fee"
                        name="monthly_fee"
                        value="<?= esc($route->monthly_fee) ?>"
                        min="0"
                        max="99999999.99"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active"
                            <?= $route->status === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="inactive"
                            <?= $route->status === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Optional route details or area covered"
                    ><?= esc($route->description ?? '') ?></textarea>
                </div>

            </div>

            <div class="form-actions">

                <a href="<?= base_url('transport/routes') ?>"
                   class="form-btn cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="form-btn save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Route
                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>