<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
.transport-page {
    padding: 0;
}

/* PAGE HEADER */
.transport-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.transport-header h1 {
    margin: 0 0 6px;
    color: #111827;
    font-size: 28px;
    font-weight: 700;
}

.transport-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.6;
}

.transport-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border-radius: 8px;
    background: #eff6ff;
    color: #1d4ed8;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
}

/* SUMMARY CARDS */
.transport-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 28px;
}

.transport-card {
    min-width: 0;
    padding: 21px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.transport-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 18px;
}

.transport-icon {
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 20px;
}

.icon-drivers {
    color: #2563eb;
    background: #eff6ff;
}

.icon-vehicles {
    color: #059669;
    background: #ecfdf5;
}

.icon-routes {
    color: #7c3aed;
    background: #f5f3ff;
}

.icon-students {
    color: #d97706;
    background: #fffbeb;
}

.transport-count {
    margin: 0 0 6px;
    color: #111827;
    font-size: 29px;
    font-weight: 700;
    line-height: 1.2;
}

.transport-card h3 {
    margin: 0;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
}

.transport-card p {
    margin: 8px 0 0;
    color: #9ca3af;
    font-size: 12px;
    line-height: 1.5;
}

/* MANAGEMENT SHORTCUTS */
.transport-shortcuts {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 28px;
}

.transport-shortcut {
    display: flex;
    align-items: center;
    gap: 15px;
    min-width: 0;
    padding: 20px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    color: #111827;
    text-decoration: none !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.transport-shortcut:hover {
    border-color: #93c5fd;
    box-shadow: 0 5px 14px rgba(37, 99, 235, 0.09);
}

.shortcut-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 21px;
}

.transport-shortcut strong {
    display: block;
    margin-bottom: 6px;
    color: #111827;
    font-size: 14px;
    font-weight: 700;
}

.transport-shortcut span {
    display: block;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.5;
}

/* OVERVIEW */
.transport-section {
    padding: 24px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.transport-section h2 {
    margin: 0 0 9px;
    color: #111827;
    font-size: 19px;
    font-weight: 700;
}

.transport-section > p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.7;
}

.transport-note {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-top: 20px;
    padding: 16px;
    border: 1px solid #dbeafe;
    border-radius: 9px;
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    line-height: 1.7;
}

.transport-note > i {
    margin-top: 3px;
    color: #2563eb;
    font-size: 17px;
    flex-shrink: 0;
}

.transport-note strong {
    color: #1f2937;
}

/* RESPONSIVE DESIGN */
@media (max-width: 1100px) {
    .transport-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 850px) {
    .transport-shortcuts {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .transport-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .transport-label {
        white-space: normal;
    }

    .transport-grid {
        grid-template-columns: 1fr;
    }

    .transport-card {
        padding: 18px;
    }

    .transport-shortcut {
        padding: 17px;
    }

    .transport-section {
        padding: 18px;
    }
}
</style>

<div class="container transport-page">

    <!-- PAGE HEADER -->
    <div class="transport-header">
        <div>
            <h1>Transport Management</h1>
            <p>
                Manage school vehicles, drivers, routes and student transport.
            </p>
        </div>

        <div class="transport-label">
            <i class="fa-solid fa-bus"></i>
            School Transport
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="transport-grid">

        <div class="transport-card">
            <div class="transport-card-top">
                <div class="transport-icon icon-drivers">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <i class="fa-solid fa-users" style="color:#9ca3af;"></i>
            </div>

            <div class="transport-count">
                <?= esc($totalDrivers) ?>
            </div>

            <h3>Total Drivers</h3>
            <p>Registered transport drivers</p>
        </div>

        <div class="transport-card">
            <div class="transport-card-top">
                <div class="transport-icon icon-vehicles">
                    <i class="fa-solid fa-bus"></i>
                </div>
                <i class="fa-solid fa-road" style="color:#9ca3af;"></i>
            </div>

            <div class="transport-count">
                <?= esc($totalVehicles) ?>
            </div>

            <h3>Total Vehicles</h3>
            <p>Registered buses and vans</p>
        </div>

        <div class="transport-card">
            <div class="transport-card-top">
                <div class="transport-icon icon-routes">
                    <i class="fa-solid fa-route"></i>
                </div>
                <i class="fa-solid fa-location-dot" style="color:#9ca3af;"></i>
            </div>

            <div class="transport-count">
                <?= esc($totalRoutes) ?>
            </div>

            <h3>Total Routes</h3>
            <p>Configured school transport routes</p>
        </div>

        <div class="transport-card">
            <div class="transport-card-top">
                <div class="transport-icon icon-students">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <i class="fa-solid fa-clipboard-check" style="color:#9ca3af;"></i>
            </div>

            <div class="transport-count">
                <?= esc($totalAssignments) ?>
            </div>

            <h3>Student Assignments</h3>
            <p>Students assigned to transport</p>
        </div>

    </div>

    <!-- MANAGEMENT SHORTCUTS -->
    <div class="transport-shortcuts">

        <a href="<?= base_url('transport/drivers') ?>"
           class="transport-shortcut">

            <div class="shortcut-icon">
                <i class="fa-solid fa-id-card"></i>
            </div>

            <div>
                <strong>Drivers Management</strong>
                <span>Add and manage school drivers</span>
            </div>

        </a>

        <a href="<?= base_url('transport/vehicles') ?>"
           class="transport-shortcut">

            <div class="shortcut-icon">
                <i class="fa-solid fa-bus"></i>
            </div>

            <div>
                <strong>Vehicles Management</strong>
                <span>Manage school buses and vans</span>
            </div>

        </a>

        <a href="<?= base_url('transport/routes') ?>"
           class="transport-shortcut">

            <div class="shortcut-icon">
                <i class="fa-solid fa-route"></i>
            </div>

            <div>
                <strong>Routes Management</strong>
                <span>Manage routes and transport charges</span>
            </div>

        </a>
        <a href="<?= base_url('transport/stops') ?>"
   class="transport-shortcut">
    <div class="shortcut-icon">
        <i class="fa-solid fa-location-dot"></i>
    </div>
    <div>
        <strong>Pickup & Drop-off Stops</strong>
        <span>Manage stop locations and timings</span>
    </div>
</a>

<a href="<?= base_url('transport/assignments') ?>"
   class="transport-shortcut">
    <div class="shortcut-icon">
        <i class="fa-solid fa-user-graduate"></i>
    </div>
    <div>
        <strong>Student Assignments</strong>
        <span>Manage student transport allocations</span>
    </div>
</a>

    </div>

    <!-- TRANSPORT OVERVIEW -->
    <div class="transport-section">

        <h2>Transport Overview</h2>

        <p>
            Manage school drivers, vehicles, transport routes, pickup and
            drop-off stops, and student assignments from one place.
        </p>

        <div class="transport-note">
            <i class="fa-solid fa-circle-info"></i>

            <div>
                <strong>Transport Management</strong><br>
                Drivers, vehicles and routes management pages are available.
                Pickup/drop-off stops and student transport assignments
                are the next features to complete.
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>