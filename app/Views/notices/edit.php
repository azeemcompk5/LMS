<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* =========================
       NOTICE EDIT PAGE ONLY
    ========================= */

    .notice-edit-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .notice-edit-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .notice-edit-icon {
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

    .notice-edit-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .notice-edit-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .notice-edit-back {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f3f4f6;
        color: #374151;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .notice-edit-back:hover {
        background: #e5e7eb;
    }

    .notice-edit-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .notice-edit-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .notice-edit-card-header h2 {
        margin: 0;
        font-size: 18px;
        color: #111827;
    }

    .notice-edit-card-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .notice-edit-form {
        padding: 25px;
    }

    .notice-edit-form-group {
        margin-bottom: 20px;
    }

    .notice-edit-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .notice-edit-form label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .notice-edit-required {
        color: #dc2626;
    }

    .notice-edit-form input,
    .notice-edit-form textarea,
    .notice-edit-form select {
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

    .notice-edit-form input:focus,
    .notice-edit-form textarea:focus,
    .notice-edit-form select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .notice-edit-form textarea {
        min-height: 160px;
        resize: vertical;
        line-height: 1.6;
    }

    .notice-edit-help {
        margin-top: 6px;
        color: #6b7280;
        font-size: 12px;
    }

    .notice-edit-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        margin-top: 10px;
        border-top: 1px solid #e5e7eb;
    }

    .notice-edit-btn {
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

    .notice-edit-btn-primary {
        background: #2563eb;
        color: #ffffff;
    }

    .notice-edit-btn-primary:hover {
        background: #1d4ed8;
    }

    .notice-edit-btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .notice-edit-btn-secondary:hover {
        background: #e5e7eb;
    }

    @media (max-width: 700px) {

        .notice-edit-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .notice-edit-form {
            padding: 20px;
        }

        .notice-edit-header {
            flex-wrap: wrap;
        }

        .notice-edit-back {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }

        .notice-edit-header h1 {
            font-size: 24px;
        }

        .notice-edit-actions {
            flex-direction: column-reverse;
        }

        .notice-edit-btn {
            width: 100%;
        }
    }
</style>


<div class="notice-edit-page">

    <!-- Page Header -->
    <div class="notice-edit-header">

        <div class="notice-edit-icon">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>

        <div>
            <h1>Edit Notice</h1>
            <p>Update the information of this school notice.</p>
        </div>

        <a
            href="<?= base_url('notices') ?>"
            class="notice-edit-back"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Notices
        </a>

    </div>


    <!-- Form Card -->
    <div class="notice-edit-card">

        <div class="notice-edit-card-header">
            <h2>Notice Information</h2>
            <p>Make the required changes and save the updated notice.</p>
        </div>


        <form
            action="<?= base_url('notices/update/' . $notice->id) ?>"
            method="post"
            class="notice-edit-form"
            id="noticeEditForm"
        >

            <?= csrf_field() ?>


            <!-- Title -->
            <div class="notice-edit-form-group">

                <label for="notice_title">
                    Notice Title
                    <span class="notice-edit-required">*</span>
                </label>

                <input
                    type="text"
                    id="notice_title"
                    name="title"
                    value="<?= esc($notice->title) ?>"
                    placeholder="Enter notice title"
                    required
                >

            </div>


            <!-- Message -->
            <div class="notice-edit-form-group">

                <label for="notice_message">
                    Notice Message
                    <span class="notice-edit-required">*</span>
                </label>

                <textarea
                    id="notice_message"
                    name="message"
                    placeholder="Write the notice message here..."
                    required
                ><?= esc($notice->message) ?></textarea>

                <div class="notice-edit-help">
                    Keep the message clear and easy to understand.
                </div>

            </div>


            <!-- Audience + Status -->
            <div class="notice-edit-form-row">

                <div class="notice-edit-form-group">

                    <label for="notice_audience">
                        Target Audience
                        <span class="notice-edit-required">*</span>
                    </label>

                    <select
                        id="notice_audience"
                        name="target_audience"
                        required
                    >

                        <option value="all"
                            <?= $notice->target_audience === 'all' ? 'selected' : '' ?>>
                            Everyone
                        </option>

                        <option value="student"
                            <?= $notice->target_audience === 'student' ? 'selected' : '' ?>>
                            Students
                        </option>

                        <option value="teacher"
                            <?= $notice->target_audience === 'teacher' ? 'selected' : '' ?>>
                            Teachers
                        </option>

                        <option value="parent"
                            <?= $notice->target_audience === 'parent' ? 'selected' : '' ?>>
                            Parents
                        </option>

                        <option value="staff"
                            <?= $notice->target_audience === 'staff' ? 'selected' : '' ?>>
                            Staff
                        </option>

                    </select>

                </div>


                <div class="notice-edit-form-group">

                    <label for="notice_status">
                        Status
                        <span class="notice-edit-required">*</span>
                    </label>

                    <select
                        id="notice_status"
                        name="status"
                        required
                    >

                        <option value="active"
                            <?= $notice->status === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="inactive"
                            <?= $notice->status === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            <!-- Dates -->
            <div class="notice-edit-form-row">

                <div class="notice-edit-form-group">

                    <label for="notice_publish_date">
                        Publish Date
                        <span class="notice-edit-required">*</span>
                    </label>

                    <input
                        type="date"
                        id="notice_publish_date"
                        name="publish_date"
                        value="<?= esc($notice->publish_date) ?>"
                        required
                    >

                </div>


                <div class="notice-edit-form-group">

                    <label for="notice_expiry_date">
                        Expiry Date
                    </label>

                    <input
                        type="date"
                        id="notice_expiry_date"
                        name="expiry_date"
                        value="<?= esc($notice->expiry_date) ?>"
                    >

                    <div class="notice-edit-help">
                        Optional. Leave empty if there is no expiry date.
                    </div>

                </div>

            </div>


            <!-- Actions -->
            <div class="notice-edit-actions">

                <a
                    href="<?= base_url('notices') ?>"
                    class="notice-edit-btn notice-edit-btn-secondary"
                >
                    <i class="fa-solid fa-xmark"></i>
                    Cancel
                </a>


                <button
                    type="submit"
                    class="notice-edit-btn notice-edit-btn-primary"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Notice
                </button>

            </div>

        </form>

    </div>

</div>


<script>
    document.getElementById('noticeEditForm').addEventListener('submit', function (event) {

        const publishDate = document.getElementById('notice_publish_date').value;
        const expiryDate = document.getElementById('notice_expiry_date').value;

        if (publishDate && expiryDate && expiryDate < publishDate) {

            event.preventDefault();

            alert('Expiry Date cannot be earlier than Publish Date.');

            return false;
        }

    });
</script>


<?= $this->endSection() ?>