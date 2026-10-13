<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 5px;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .form-box {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        max-width: 900px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #2563eb;
    }

    textarea {
        min-height: 90px;
        resize: vertical;
    }

    .form-actions {
        margin-top: 25px;
        display: flex;
        gap: 10px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: 600;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 7px;
        font-weight: 600;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }
    }
</style>

<div class="page-header">

    <h1>Edit Teacher</h1>

    <p>Update teacher information</p>

</div>

<div class="form-box">

    <form action="<?= base_url('teachers/update/' . $teacher->id) ?>" method="post" enctype="multipart/form-data">

        <div class="form-grid">

            <div class="form-group">
                <label>Employee ID</label>
                <input
                    type="text"
                    name="employee_id"
                    value="<?= esc($teacher->employee_id) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>First Name</label>
                <input
                    type="text"
                    name="first_name"
                    value="<?= esc($teacher->first_name) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    value="<?= esc($teacher->last_name) ?>"
                >
            </div>
            <div class="form-group">
    <label>Father Name</label>
    <input
        type="text"
        name="father_name"
        value="<?= esc($teacher->father_name) ?>"
        placeholder="Enter father name"
    >
</div>
<div class="form-group">

    <label>Teacher Photo</label>

    <?php if (!empty($teacher->photo)): ?>

        <div style="margin-bottom:12px;">
            <img
                src="<?= base_url('uploads/teachers/' . $teacher->photo) ?>"
                alt="Teacher Photo"
                style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #f3f4f6;"
            >
        </div>

    <?php endif; ?>

    <input
        type="file"
        name="photo"
        accept="image/jpeg,image/png,image/webp"
    >

    <small style="color:#6b7280;">
        Leave empty to keep the current photo. JPG, PNG or WEBP. Maximum size 2MB.
    </small>

</div>

            <div class="form-group">
                <label>Designation</label>
                <input
                    type="text"
                    name="designation"
                    value="<?= esc($teacher->designation) ?>"
                >
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input
                    type="text"
                    name="phone"
                    value="<?= esc($teacher->phone) ?>"
                >
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    value="<?= esc($teacher->email) ?>"
                >
            </div>

            <div class="form-group">
                <label>Joining Date</label>
                <input
                    type="date"
                    name="joining_date"
                    value="<?= esc($teacher->joining_date) ?>"
                >
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">

                    <option
                        value="active"
                        <?= $teacher->status === 'active' ? 'selected' : '' ?>
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        <?= $teacher->status === 'inactive' ? 'selected' : '' ?>
                    >
                        Inactive
                    </option>

                </select>
            </div>

            <div class="form-group full">
                <label>Address</label>

                <textarea name="address"><?= esc($teacher->address) ?></textarea>
            </div>

        </div>

        <div class="form-actions">

            <button type="submit" class="save-btn">
                Update Teacher
            </button>

            <a
                href="<?= base_url('teachers') ?>"
                class="cancel-btn"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>