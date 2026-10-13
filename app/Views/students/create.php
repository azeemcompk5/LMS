
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .student-form-container {
        max-width: 1050px;
        margin: 0 auto;
        padding: 10px 0 30px;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 7px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .form-box {
        background: #ffffff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef0f3;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        margin: 28px 0 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-title:first-child {
        margin-top: 0;
    }

    .section-title i {
        color: #2563eb;
        font-size: 16px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 19px;
    }

    .field {
        display: flex;
        flex-direction: column;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    .field label {
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .field input,
    .field select,
    .field textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #111827;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .field input::placeholder,
    .field textarea::placeholder {
        color: #9ca3af;
    }

    .field textarea {
        min-height: 95px;
        resize: vertical;
    }

    .actions {
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 19px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .save {
        background: #2563eb;
        color: #ffffff;
    }

    .save:hover {
        background: #1d4ed8;
    }

    .cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .cancel:hover {
        background: #e5e7eb;
    }

    @media (max-width: 700px) {
        .student-form-container {
            padding: 5px 0 20px;
        }

        .form-box {
            padding: 20px;
        }

        .grid {
            grid-template-columns: 1fr;
        }

        .field.full {
            grid-column: auto;
        }

        .actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="student-form-container">

    <div class="page-header">
        <h1>Add Student</h1>
        <p>Create a new student record</p>
    </div>

    <div class="form-box">

<form action="<?= base_url('students/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Student Information -->
            <div class="section-title">
                <i class="fas fa-user-graduate"></i>
                Student Information
            </div>

            <div class="grid">

                <div class="field">
    <label>Admission No</label>
    <input
        type="text"
        name="admission_no"
        placeholder="e.g. STU-001"
    >
</div>

<div class="field">
    <label>B-Form / Registration No</label>
    <input
        type="text"
        name="b_form_no"
        placeholder="e.g. 12345-1234567-1"
    >
</div>
<div class="field">
    <label>Student Photo</label>
    <input
        type="file"
        name="photo"
        accept="image/jpeg,image/png,image/webp"
    >
    <small style="color:#6b7280; margin-top:6px;">
        JPG, PNG or WebP. Recommended: square photo.
    </small>
</div>

                <div class="field">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="field">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="first_name"
                        placeholder="Enter first name"
                    >
                </div>

                <div class="field">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="last_name"
                        placeholder="Enter last name"
                    >
                </div>

                <div class="field">
                    <label>Date of Birth</label>
                    <input
                        type="date"
                        name="date_of_birth"
                    >
                </div>

                <div class="field">
                    <label>Class</label>
                    <select name="class_id">
                        <option value="">Select Class</option>

                        <?php foreach ($classes as $class): ?>
                            <option value="<?= esc($class->id) ?>">
                                <?= esc($class->name) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="field">
                    <label>Section</label>
                    <select name="section_id">
                        <option value="">Select Section</option>

                        <?php foreach ($sections as $section): ?>
                            <option value="<?= esc($section->id) ?>">
                                <?= esc($section->name) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="field">
                    <label>Status</label>
                    <select name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

            </div>

            <!-- Father Information -->
            <div class="section-title">
                <i class="fas fa-user-tie"></i>
                Father Information
            </div>

            <div class="grid">

                <div class="field">
                    <label>Father Name</label>
                    <input
                        type="text"
                        name="guardian_name"
                        placeholder="Enter father's name"
                    >
                </div>

                <div class="field">
                    <label>Father Phone Number</label>
                    <input
                        type="text"
                        name="guardian_phone"
                        placeholder="03XX-XXXXXXX"
                    >
                </div>
                <div class="field">
    <label>Father CNIC Number</label>
    <input
        type="text"
        name="father_cnic"
        placeholder="e.g. 12345-1234567-1"
        maxlength="15"
    >
</div>

                <div class="field full">
                    <label>Address</label>
                    <textarea
                        name="address"
                        placeholder="Enter complete address"
                    ></textarea>
                </div>

            </div>

            <!-- Actions -->
            <div class="actions">

                <button type="submit" class="btn save">
                    <i class="fas fa-save"></i>
                    Save Student
                </button>

                <a href="<?= base_url('students') ?>" class="btn cancel">
                    <i class="fas fa-arrow-left"></i>
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
```
