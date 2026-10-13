<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* =========================
       NOTICE CREATE PAGE ONLY
    ========================= */

    .notice-create-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .notice-create-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .notice-create-icon {
        width: 52px;
        height: 52px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .notice-create-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .notice-create-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .notice-create-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .notice-create-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .notice-create-card-header h2 {
        margin: 0;
        font-size: 18px;
        color: #111827;
    }

    .notice-create-card-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .notice-create-form {
        padding: 25px;
    }

    .notice-create-form-group {
        margin-bottom: 20px;
    }

    .notice-create-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .notice-create-form label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .notice-create-required {
        color: #dc2626;
    }

    .notice-create-form input,
    .notice-create-form textarea,
    .notice-create-form select {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        color: #111827;
        background: #ffffff;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .notice-create-form input:focus,
    .notice-create-form textarea:focus,
    .notice-create-form select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .notice-create-form textarea {
        min-height: 160px;
        resize: vertical;
        line-height: 1.6;
    }

    .notice-create-help {
        margin-top: 6px;
        color: #6b7280;
        font-size: 12px;
    }

    .notice-create-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        margin-top: 10px;
        border-top: 1px solid #e5e7eb;
    }

    .notice-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .notice-create-btn-primary {
        background: #2563eb;
        color: #ffffff;
    }

    .notice-create-btn-primary:hover {
        background: #1d4ed8;
    }

    .notice-create-btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .notice-create-btn-secondary:hover {
        background: #e5e7eb;
    }

    @media (max-width: 700px) {

        .notice-create-page {
            max-width: 100%;
        }

        .notice-create-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .notice-create-form {
            padding: 20px;
        }

        .notice-create-header h1 {
            font-size: 24px;
        }

        .notice-create-actions {
            flex-direction: column-reverse;
        }

        .notice-create-btn {
            width: 100%;
        }
    }
</style>

<div class="notice-create-page">

    <!-- Page Header -->
    <div class="notice-create-header">

        <div class="notice-create-icon">
            <i class="fa-solid fa-bullhorn"></i>
        </div>

        <div>
            <h1>Add Notice</h1>
            <p>Create a new announcement for your school community.</p>
        </div>

    </div>


    <!-- Form Card -->
    <div class="notice-create-card">

        <div class="notice-create-card-header">
            <h2>Notice Information</h2>
            <p>Enter the details of the notice below.</p>
        </div>


        <form
            action="<?= base_url('notices/store') ?>"
            method="post"
            class="notice-create-form"
            id="noticeCreateForm"
        >

            <?= csrf_field() ?>


            <!-- Notice Title -->
            <div class="notice-create-form-group">

                <label for="title">
                    Notice Title
                    <span class="notice-create-required">*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Enter notice title"
                    required
                >

            </div>


            <!-- Message -->
            <div class="notice-create-form-group">

                <label for="message">
                    Notice Message
                    <span class="notice-create-required">*</span>
                </label>

                <textarea
                    id="message"
                    name="message"
                    placeholder="Write the notice message here..."
                    required
                ></textarea>

                <div class="notice-create-help">
                    Write a clear and informative message for the selected audience.
                </div>

            </div>


            <!-- Audience + Status -->
            <div class="notice-create-form-row">

                <div class="notice-create-form-group">

                    <label for="audience">
                        Target Audience
                        <span class="notice-create-required">*</span>
                    </label>

                    <select
                        id="audience"
                        name="audience"
                        required
                    >
                        <option value="all">Everyone</option>
                        <option value="students">Students</option>
                        <option value="teachers">Teachers</option>
                        <option value="parents">Parents</option>
                    </select>

                </div>


                <div class="notice-create-form-group">

                    <label for="status">
                        Status
                        <span class="notice-create-required">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                </div>

            </div>


            <!-- Dates -->
            <div class="notice-create-form-row">

                <div class="notice-create-form-group">

                    <label for="publish_date">
                        Publish Date
                        <span class="notice-create-required">*</span>
                    </label>

                    <input
                        type="date"
                        id="publish_date"
                        name="publish_date"
                        value="<?= date('Y-m-d') ?>"
                        required
                    >

                </div>


                <div class="notice-create-form-group">

                    <label for="expiry_date">
                        Expiry Date
                    </label>

                    <input
                        type="date"
                        id="expiry_date"
                        name="expiry_date"
                    >

                    <div class="notice-create-help">
                        Optional. Leave empty if the notice has no expiry date.
                    </div>

                </div>

            </div>


            <!-- Actions -->
            <div class="notice-create-actions">

                <a
                    href="<?= base_url('notices') ?>"
                    class="notice-create-btn notice-create-btn-secondary"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Cancel
                </a>


                <button
                    type="submit"
                    class="notice-create-btn notice-create-btn-primary"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Notice
                </button>

            </div>

        </form>

    </div>

</div>


<script>
    document.getElementById('noticeCreateForm').addEventListener('submit', function (event) {

        const publishDate = document.getElementById('publish_date').value;
        const expiryDate = document.getElementById('expiry_date').value;

        if (publishDate && expiryDate && expiryDate < publishDate) {
            event.preventDefault();

            alert('Expiry Date cannot be earlier than Publish Date.');

            return false;
        }

    });
</script>

<?= $this->endSection() ?>