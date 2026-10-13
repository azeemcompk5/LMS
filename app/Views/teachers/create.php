```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 750px;
        margin: 0 auto;
        padding: 10px 0;
    }

    .form-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    h1 {
        margin-top: 0;
        font-size: 28px;
    }

    .subtitle {
        color: #6b7280;
        margin-bottom: 25px;
    }

    .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .field {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 15px;
    }

    textarea {
        min-height: 90px;
        resize: vertical;
    }

    .buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">

    <div class="form-box">

        <h1>Add Teacher</h1>

        <p class="subtitle">
            Add a new teacher or staff member
        </p>

<form action="<?= base_url('teachers/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">

                <div class="field">
                    <label>Employee ID</label>

                    <input
                        type="text"
                        name="employee_id"
                        placeholder="e.g. T-001"
                        required
                    >
                </div>

                <div class="field">
                    <label>First Name</label>

                    <input
                        type="text"
                        name="first_name"
                        placeholder="Enter first name"
                        required
                    >
                </div>

            </div>

            <div class="row">

                <div class="field">
                    <label>Last Name</label>

                    <input
                        type="text"
                        name="last_name"
                        placeholder="Enter last name"
                    >
                </div>

                <div class="field">
                    <label>Father Name</label>

                    <input
                        type="text"
                        name="father_name"
                        placeholder="Enter father name"
                    >
                </div>

            </div>
            <div class="form-group">
    <label>Teacher Photo</label>

    <input
        type="file"
        name="photo"
        accept="image/jpeg,image/png,image/webp"
    >

    <small style="color:#6b7280;">
        JPG, PNG or WEBP. Maximum size 2MB.
    </small>
</div>

            <div class="row">

                <div class="field">
                    <label>Designation</label>

                    <input
                        type="text"
                        name="designation"
                        placeholder="e.g. Teacher"
                    >
                </div>

                <div class="field">
                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="e.g. 0300-1234567"
                    >
                </div>

            </div>

            <div class="row">

                <div class="field">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="teacher@example.com"
                    >
                </div>

                <div class="field">
                    <label>Joining Date</label>

                    <input
                        type="date"
                        name="joining_date"
                    >
                </div>

            </div>

            <div class="field">

                <label>Status</label>

                <select name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>

            </div>

            <div class="field">

                <label>Address</label>

                <textarea
                    name="address"
                    placeholder="Enter teacher address"
                ></textarea>

            </div>

            <div class="buttons">

                <button type="submit" class="save-btn">
                    Save Teacher
                </button>

                <a href="<?= base_url('teachers') ?>" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
```
