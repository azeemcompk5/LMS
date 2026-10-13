<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 700px;
        margin: 0 auto;
        padding: 10px 0;
    }

    .header {
        margin-bottom: 25px;
    }

    .header h1 {
        margin-bottom: 8px;
    }

    .header p {
        color: #6b7280;
    }

    .form-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .field {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    label {
        margin-bottom: 7px;
        font-weight: 600;
        font-size: 14px;
    }

    input,
    select,
    textarea {
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .actions {
        margin-top: 25px;
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .save {
        background: #2563eb;
        color: white;
    }

    .cancel {
        background: #e5e7eb;
        color: #374151;
    }
</style>

<div class="container">

    <div class="header">
        <h1>Add Class</h1>
        <p>Create a new school class</p>
    </div>

    <div class="form-box">

        <form action="<?= base_url('classes/store') ?>" method="post">

            <div class="field">
                <label>Class Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="e.g. Class 1"
                    required
                >
            </div>

            <div class="field">
                <label>Description</label>

                <textarea
                    name="description"
                    placeholder="Enter class description"
                ></textarea>
            </div>

            <div class="field">
                <label>Status</label>

                <select name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="actions">

                <button type="submit" class="btn save">
                    Save Class
                </button>

                <a href="<?= base_url('classes') ?>" class="btn cancel">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>