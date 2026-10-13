<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 700px;
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
    }

    .subtitle {
        color: #6b7280;
        margin-bottom: 25px;
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
        padding: 11px;
        margin-bottom: 20px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        box-sizing: border-box;
        font-size: 15px;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .buttons {
        display: flex;
        gap: 10px;
    }

    .save-btn {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        padding: 11px 20px;
        border-radius: 8px;
        text-decoration: none;
    }
</style>

<div class="container">

    <div class="form-box">

        <h1>Add Subject</h1>

        <p class="subtitle">
            Add a new subject to the school system.
        </p>

        <form action="<?= base_url('subjects/store') ?>" method="post">

            <label>Subject Name *</label>

            <input
                type="text"
                name="name"
                placeholder="e.g. Mathematics"
                required
            >

            <label>Subject Code</label>

            <input
                type="text"
                name="code"
                placeholder="e.g. MATH"
            >

            <label>Description</label>

            <textarea
                name="description"
                placeholder="Enter subject description"
            ></textarea>

            <label>Status *</label>

            <select name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <div class="buttons">

                <button type="submit" class="save-btn">
                    Save Subject
                </button>

                <a href="<?= base_url('subjects') ?>" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>