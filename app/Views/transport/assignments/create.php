<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.assignment-form-page {
    max-width: 950px;
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

.assignment-form-card {
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

.form-section-title {
    grid-column: 1 / -1;
    margin: 8px 0 0;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    color: #111827;
    font-size: 15px;
    font-weight: 700;
}

.form-notice {
    margin-bottom: 20px;
    padding: 14px 16px;
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

    .assignment-form-card {
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

<div class="container assignment-form-page">

    <div class="form-header">
        <h1>Assign Student to Transport</h1>
        <p>Select a student, transport route, vehicle and pickup/drop-off stops.</p>
    </div>

    <div class="assignment-form-card">

        <?php if (empty($students) || empty($routes)): ?>
            <div class="form-notice">
                <strong>Setup required.</strong><br>
                <?php if (empty($students)): ?>
                    Students table mein pehle student record add karein.
                    <br>
                <?php endif; ?>

                <?php if (empty($routes)): ?>
                    Pehle Transport Routes mein ek active route add karein.
                    <br>
                <?php endif; ?>

                <a href="<?= base_url('transport/routes') ?>">
                    Go to Routes Management
                </a>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transport/assignments/store') ?>"
              method="post">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-section-title">
                    Student & Route Details
                </div>

                <div class="form-group full-width">
                    <label for="student_id">Student *</label>

                    <select id="student_id" name="student_id" required>
                        <option value="">Select a student</option>

                        <?php foreach ($students as $student): ?>
                            <option value="<?= esc($student->id) ?>">
                                <?= esc(trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? ''))) ?>
                                <?= !empty($student->admission_no)
                                    ? ' — ' . esc($student->admission_no)
                                    : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="route_id">Transport Route *</label>

                    <select id="route_id" name="route_id" required>
                        <option value="">Select a route</option>

                        <?php foreach ($routes as $route): ?>
                            <option value="<?= esc($route->id) ?>">
                                <?= esc($route->route_name) ?>
                                — PKR <?= number_format((float) $route->monthly_fee, 2) ?>/month
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vehicle_id">Vehicle</label>

                    <select id="vehicle_id" name="vehicle_id">
                        <option value="">No vehicle assigned</option>

                        <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?= esc($vehicle->id) ?>">
                                <?= esc($vehicle->vehicle_name) ?>
                                — <?= esc($vehicle->vehicle_number) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <span class="form-help">
                        Sirf active vehicles dropdown mein nazar aayengi.
                    </span>
                </div>

                <div class="form-section-title">
                    Pickup & Drop-off Details
                </div>

                <div class="form-group">
                    <label for="pickup_stop_id">Pickup Stop</label>

                    <select id="pickup_stop_id" name="pickup_stop_id" disabled>
                        <option value="">Select a route first</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dropoff_stop_id">Drop-off Stop</label>

                    <select id="dropoff_stop_id" name="dropoff_stop_id" disabled>
                        <option value="">Select a route first</option>
                    </select>
                </div>

                <div class="form-section-title">
                    Assignment Details
                </div>

                <div class="form-group">
                    <label for="monthly_fee">Monthly Transport Fee (PKR) *</label>

                    <input
                        type="number"
                        id="monthly_fee"
                        name="monthly_fee"
                        min="0"
                        max="99999999.99"
                        step="0.01"
                        value=""
                        placeholder="Enter monthly fee"
                        required
                    >

                    <span class="form-help">
                        Route select karne par route ki fee automatically fill hogi.
                        Aap zaroorat ke mutabiq change kar sakti hain.
                    </span>
                </div>

                <div class="form-group">
                    <label for="status">Assignment Status *</label>

                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                    >
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>

                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                    >
                </div>

                <div class="form-group full-width">
                    <label for="notes">Notes</label>

                    <textarea
                        id="notes"
                        name="notes"
                        placeholder="Optional transport instructions"
                    ></textarea>
                </div>

            </div>

            <div class="form-actions">

                <a href="<?= base_url('transport/assignments') ?>"
                   class="form-btn cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="form-btn save-btn"
                    <?= (empty($students) || empty($routes)) ? 'disabled' : '' ?>
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Assignment
                </button>

            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const routeSelect = document.getElementById('route_id');
    const pickupSelect = document.getElementById('pickup_stop_id');
    const dropoffSelect = document.getElementById('dropoff_stop_id');
    const feeInput = document.getElementById('monthly_fee');

    const stops = <?= json_encode(array_map(static function ($stop) {
        return [
            'id' => (int) $stop->id,
            'route_id' => (int) $stop->route_id,
            'name' => $stop->stop_name,
            'type' => $stop->stop_type,
            'status' => $stop->status
        ];
    }, $stops), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

    const routeFees = <?= json_encode(array_column(
        array_map(static function ($route) {
            return [
                'id' => (string) $route->id,
                'fee' => (float) $route->monthly_fee
            ];
        }, $routes),
        'fee',
        'id'
    ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

    function fillStops(select, routeId, purpose) {
        select.innerHTML = '';

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = routeId
            ? 'Select a stop'
            : 'Select a route first';

        select.appendChild(placeholder);

        const matches = stops.filter(function (stop) {
            if (
                String(stop.route_id) !== String(routeId) ||
                stop.status !== 'active'
            ) {
                return false;
            }

            if (purpose === 'pickup') {
                return stop.type === 'pickup' || stop.type === 'both';
            }

            return stop.type === 'dropoff' || stop.type === 'both';
        });

        matches.forEach(function (stop) {
            const option = document.createElement('option');
            option.value = stop.id;
            option.textContent = stop.name;
            select.appendChild(option);
        });

        select.disabled = !routeId || matches.length === 0;

        if (routeId && matches.length === 0) {
            placeholder.textContent = 'No active stops available';
        }
    }

    function updateRouteFields() {
        const routeId = routeSelect.value;

        fillStops(pickupSelect, routeId, 'pickup');
        fillStops(dropoffSelect, routeId, 'dropoff');

        if (
            routeId &&
            Object.prototype.hasOwnProperty.call(routeFees, String(routeId))
        ) {
            feeInput.value = routeFees[String(routeId)].toFixed(2);
        } else {
            feeInput.value = '';
        }
    }

    routeSelect.addEventListener('change', updateRouteFields);
    updateRouteFields();
});
</script>

<?= $this->endSection() ?>