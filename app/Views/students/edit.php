```php
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
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0,0,0,.06);
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
    }

    .field textarea {
        min-height: 95px;
        resize: vertical;
    }

    .current-photo {
        margin-bottom: 12px;
    }

    .current-photo img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .photo-note {
        color: #6b7280;
        display: block;
        margin-top: 6px;
        font-size: 12px;
    }

    .actions {
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
        display: flex;
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
    }

    .update {
        background: #2563eb;
        color: #fff;
    }

    .cancel {
        background: #f3f4f6;
        color: #374151;
    }

    @media (max-width: 700px) {
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
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="student-form-container">

    <div class="page-header">
        <h1>Edit Student</h1>
        <p>Update student information</p>
    </div>

    <div class="form-box">

        <form
            action="<?= base_url('students/update/' . $student->id) ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <!-- Student Information -->
            <div class="section-title">
                <i class="fas fa-user-graduate"></i>
                Student Information
            </div>

            <div class="grid">

                <!-- Admission No -->
                <div class="field">
                    <label>Admission No</label>
                    <input
                        type="text"
                        name="admission_no"
                        value="<?= esc($student->admission_no ?? '') ?>"
                        required
                    >
                </div>

                <!-- B-Form -->
                <div class="field">
                    <label>B-Form / Registration No</label>
                    <input
                        type="text"
                        name="b_form_no"
                        value="<?= esc($student->b_form_no ?? '') ?>"
                        placeholder="e.g. 12345-1234567-1"
                    >
                </div>

                <!-- Student Photo -->
                <div class="field">
                    <label>Student Photo</label>

                    <?php if (!empty($student->photo)): ?>
                        <div class="current-photo">
                            <img
                                src="<?= base_url('uploads/students/' . $student->photo) ?>"
                                alt="Student Photo"
                            >
                        </div>
                    <?php endif; ?>

                    <input
                        type="file"
                        name="photo"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small class="photo-note">
                        Select a new photo only if you want to replace the current photo.
                    </small>
                </div>

                <!-- Gender -->
                <div class="field">
                    <label>Gender</label>

                    <select name="gender" required>
                        <option value="">Select Gender</option>

                        <option value="Male"
                            <?= ($student->gender ?? '') === 'Male' ? 'selected' : '' ?>>
                            Male
                        </option>

                        <option value="Female"
                            <?= ($student->gender ?? '') === 'Female' ? 'selected' : '' ?>>
                            Female
                        </option>
                    </select>
                </div>

                <!-- First Name -->
                <div class="field">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="first_name"
                        value="<?= esc($student->first_name ?? '') ?>"
                        required
                    >
                </div>

                <!-- Last Name -->
                <div class="field">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="last_name"
                        value="<?= esc($student->last_name ?? '') ?>"
                    >
                </div>

                <!-- Date of Birth -->
                <div class="field">
                    <label>Date of Birth</label>
                    <input
                        type="date"
                        name="date_of_birth"
                        value="<?= esc($student->date_of_birth ?? '') ?>"
                    >
                </div>

                <!-- Class -->
                <div class="field">
                    <label>Class</label>

                    <select name="class_id" required>
                        <option value="">Select Class</option>

                        <?php foreach ($classes as $class): ?>
                            <option
                                value="<?= esc($class->id) ?>"
                                <?= ($student->class_id ?? '') == $class->id ? 'selected' : '' ?>
                            >
                                <?= esc($class->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Section -->
                <div class="field">
                    <label>Section</label>

                    <select name="section_id" required>
                        <option value="">Select Section</option>

                        <?php foreach ($sections as $section): ?>
                            <option
                                value="<?= esc($section->id) ?>"
                                <?= ($student->section_id ?? '') == $section->id ? 'selected' : '' ?>
                            >
                                <?= esc($section->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Status -->
                <div class="field">
                    <label>Status</label>

                    <select name="status" required>
                        <option value="Active"
                            <?= strtolower($student->status ?? '') === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="Inactive"
                            <?= strtolower($student->status ?? '') === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>
                    </select>
                </div>

            </div>

            <!-- Contact Information -->
            <div class="section-title">
                <i class="fas fa-address-book"></i>
                Contact Information
            </div>

            <div class="grid">

                <div class="field full">
                    <label>Address</label>

                    <textarea name="address"><?= esc($student->address ?? '') ?></textarea>
                </div>

            </div>

            <div class="section-title">Father Information</div>

<div class="field">
    <label>Father Name</label>
    <input
        type="text"
        name="guardian_name"
        value="<?= esc($student->guardian_name ?? '') ?>"
        placeholder="Enter father name"
    >
</div>

<div class="field">
    <label>Father Phone Number</label>
    <input
        type="text"
        name="guardian_phone"
        value="<?= esc($student->guardian_phone ?? '') ?>"
        placeholder="e.g. 03001234567"
    >
</div>

<div class="field">
    <label>Father CNIC Number</label>
    <input
        type="text"
        name="father_cnic"
        value="<?= esc($student->father_cnic ?? '') ?>"
        placeholder="e.g. 12345-1234567-1"
        maxlength="15"
    >
</div>

            </div>

            <!-- Actions -->
            <div class="actions">

                <button type="submit" class="btn update">
                    <i class="fas fa-save"></i>
                    Update Student
                </button>

                <a
                    href="<?= base_url('students') ?>"
                    class="btn cancel"
                >
                    <i class="fas fa-times"></i>
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
```
