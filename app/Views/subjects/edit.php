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

    .form-box {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        padding: 11px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .save-btn:hover {
        opacity: 0.9;
    }
</style>

<div class="container">

    <div class="header">

        <div>
            <h1>Edit Subject</h1>
            <p>Update subject information</p>
        </div>

        <a href="<?= base_url('subjects') ?>" class="back-btn">
            ← Back to Subjects
        </a>

    </div>

    <div class="form-box">

        <form
            action="<?= base_url('subjects/update/' . $subject->id) ?>"
            method="post"
        >

            <div class="form-group">

                <label for="name">
                    Subject Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= esc($subject->name) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="code">
                    Subject Code
                </label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="<?= esc($subject->code) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                ><?= esc($subject->description) ?></textarea>

            </div>

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option
                        value="active"
                        <?= $subject->status === 'active' ? 'selected' : '' ?>
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        <?= $subject->status === 'inactive' ? 'selected' : '' ?>
                    >
                        Inactive
                    </option>

                </select>

            </div>

            <button type="submit" class="save-btn">
                Save Changes
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>