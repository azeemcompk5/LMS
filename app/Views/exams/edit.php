<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 800px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    h1 {
        margin: 0;
        font-size: 28px;
    }

    .header p {
        color: #6b7280;
    }

    .back-btn {
        background: #6b7280;
        color: white;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 8px;
    }

    .card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        color: #374151;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 15px;
        box-sizing: border-box;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 15px;
    }

    .save-btn:hover {
        background: #1d4ed8;
    }

    .required {
        color: #dc2626;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Edit Exam</h1>
            <p>Update examination information</p>
        </div>

        <a href="<?= base_url('exams') ?>" class="back-btn">
            ← Back to Exams
        </a>

    </div>

    <div class="card">

        <form action="<?= base_url('exams/update/' . $exam->id) ?>" method="post">

            <!-- Exam Name -->
            <div class="form-group">

                <label>
                    Exam Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="<?= esc($exam->name) ?>"
                    required
                >

            </div>

            <!-- Term -->
            <div class="form-group">

                <label>Term</label>

                <input
                    type="text"
                    name="term"
                    value="<?= esc($exam->term) ?>"
                >

            </div>

            <!-- Class -->
            <div class="form-group">

                <label>
                    Class <span class="required">*</span>
                </label>

                <select
                    name="class_id"
                    id="class_id"
                    required
                >

                    <option value="">Select Class</option>

                    <?php foreach ($classes as $class): ?>

                        <option
                            value="<?= $class->id ?>"
                            <?= $exam->class_id == $class->id ? 'selected' : '' ?>
                        >
                            <?= esc($class->name) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Section -->
            <div class="form-group">

                <label>
                    Section <span class="required">*</span>
                </label>

                <select
                    name="section_id"
                    id="section_id"
                    required
                >

                    <option value="">Select Section</option>

                    <?php foreach ($sections as $section): ?>

                        <option
                            value="<?= $section->id ?>"
                            data-class-id="<?= $section->class_id ?>"
                            <?= $exam->section_id == $section->id ? 'selected' : '' ?>
                        >
                            <?= esc($section->name) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Exam Date -->
            <div class="form-group">

                <label>Exam Date</label>

                <input
                    type="date"
                    name="exam_date"
                    value="<?= esc($exam->exam_date) ?>"
                >

            </div>

            <!-- Status -->
            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option
                        value="upcoming"
                        <?= $exam->status === 'upcoming' ? 'selected' : '' ?>
                    >
                        Upcoming
                    </option>

                    <option
                        value="completed"
                        <?= $exam->status === 'completed' ? 'selected' : '' ?>
                    >
                        Completed
                    </option>

                    <option
                        value="cancelled"
                        <?= $exam->status === 'cancelled' ? 'selected' : '' ?>
                    >
                        Cancelled
                    </option>

                </select>

            </div>

            <!-- Description -->
            <div class="form-group">

                <label>Description</label>

                <textarea name="description"><?= esc($exam->description) ?></textarea>

            </div>

            <button type="submit" class="save-btn">
                Update Exam
            </button>

        </form>

    </div>

</div>

<script>
    const classSelect = document.getElementById('class_id');
    const sectionSelect = document.getElementById('section_id');

    const currentSectionId = "<?= esc($exam->section_id ?? '') ?>";

    function filterSections() {

        const selectedClassId = classSelect.value;

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

    }

    filterSections();

    classSelect.addEventListener('change', function () {

        filterSections();

        if (sectionSelect.querySelector(
            'option[value="' + currentSectionId + '"]'
        )?.style.display === 'none') {

            sectionSelect.value = '';

        }

    });
</script>

<?= $this->endSection() ?>