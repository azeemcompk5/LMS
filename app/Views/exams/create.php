<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 8px;
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
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: bold;
        font-size: 14px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
    }

    .save-btn:hover {
        background: #1d4ed8;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        padding: 11px 20px;
        border-radius: 7px;
        font-size: 14px;
    }

    .required {
        color: #dc2626;
    }
</style>

<div class="page-header">
    <h1>Add Exam</h1>
    <p>Create a new examination.</p>
</div>

<div class="form-box">

    <form action="<?= base_url('exams/store') ?>" method="post">

        <!-- Exam Name -->
        <div class="form-group">
            <label for="name">
                Exam Name <span class="required">*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="e.g. Mid Term Examination"
                required
            >
        </div>

        <!-- Term -->
        <div class="form-group">
            <label for="term">Term</label>

            <input
                type="text"
                id="term"
                name="term"
                placeholder="e.g. First Term"
            >
        </div>

        <!-- Class -->
        <div class="form-group">
            <label for="class_id">
                Class <span class="required">*</span>
            </label>

            <select
                id="class_id"
                name="class_id"
                required
            >
                <option value="">Select Class</option>

                <?php foreach ($classes as $class): ?>

                    <option value="<?= $class->id ?>">
                        <?= esc($class->name) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <!-- Section -->
        <div class="form-group">
            <label for="section_id">
                Section <span class="required">*</span>
            </label>

            <select
                id="section_id"
                name="section_id"
                required
            >
                <option value="">Select Section</option>

                <?php foreach ($sections as $section): ?>

                    <option
                        value="<?= $section->id ?>"
                        data-class-id="<?= $section->class_id ?>"
                    >
                        <?= esc($section->name) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <!-- Exam Date -->
        <div class="form-group">
            <label for="exam_date">Exam Date</label>

            <input
                type="date"
                id="exam_date"
                name="exam_date"
            >
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>

            <select id="status" name="status">

                <option value="upcoming">Upcoming</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>

            </select>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
                placeholder="Enter exam details..."
            ></textarea>
        </div>

        <!-- Buttons -->
        <div class="form-actions">

            <button type="submit" class="save-btn">
                Save Exam
            </button>

            <a
                href="<?= base_url('exams') ?>"
                class="cancel-btn"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

<script>
    const classSelect = document.getElementById('class_id');
    const sectionSelect = document.getElementById('section_id');

    classSelect.addEventListener('change', function () {

        const selectedClassId = this.value;

        Array.from(sectionSelect.options).forEach(function (option) {

            if (option.value === '') {
                option.style.display = '';
                return;
            }

            const optionClassId = option.getAttribute('data-class-id');

            if (optionClassId === selectedClassId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }

        });

        sectionSelect.value = '';
    });
</script>

<?= $this->endSection() ?>