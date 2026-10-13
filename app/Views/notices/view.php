<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* =========================
       NOTICE VIEW PAGE ONLY
    ========================= */

    .notice-view-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .notice-view-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .notice-view-icon {
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

    .notice-view-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .notice-view-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .notice-view-back {
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

    .notice-view-back:hover {
        background: #e5e7eb;
    }

    .notice-view-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .notice-view-card-header {
        padding: 22px 25px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .notice-view-title {
        margin: 0;
        font-size: 22px;
        color: #111827;
        line-height: 1.4;
    }

    .notice-view-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    .notice-view-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .notice-view-badge-audience {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .notice-view-badge-active {
        background: #ecfdf5;
        color: #15803d;
    }

    .notice-view-badge-inactive {
        background: #fef2f2;
        color: #b91c1c;
    }

    .notice-view-body {
        padding: 25px;
    }

    .notice-view-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .notice-view-info-box {
        padding: 16px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .notice-view-info-label {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .notice-view-info-label i {
        color: #2563eb;
    }

    .notice-view-info-value {
        color: #111827;
        font-size: 14px;
        font-weight: 600;
    }

    .notice-view-message-box {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .notice-view-message-header {
        padding: 14px 16px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
        font-size: 14px;
        font-weight: 700;
    }

    .notice-view-message {
        padding: 20px;
        color: #4b5563;
        line-height: 1.7;
        font-size: 14px;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .notice-view-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 20px 25px;
        border-top: 1px solid #e5e7eb;
        background: #fafafa;
    }

    .notice-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .notice-view-btn-edit {
        background: #2563eb;
        color: #ffffff;
    }

    .notice-view-btn-edit:hover {
        background: #1d4ed8;
    }

    .notice-view-btn-back {
        background: #f3f4f6;
        color: #374151;
    }

    .notice-view-btn-back:hover {
        background: #e5e7eb;
    }

    @media (max-width: 700px) {

        .notice-view-header {
            flex-wrap: wrap;
        }

        .notice-view-back {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }

        .notice-view-header h1 {
            font-size: 24px;
        }

        .notice-view-info-grid {
            grid-template-columns: 1fr;
        }

        .notice-view-body {
            padding: 20px;
        }

        .notice-view-actions {
            flex-direction: column;
            padding: 20px;
        }

        .notice-view-btn {
            width: 100%;
        }
    }
</style>


<div class="notice-view-page">

    <!-- Page Header -->
    <div class="notice-view-header">

        <div class="notice-view-icon">
            <i class="fa-solid fa-eye"></i>
        </div>

        <div>
            <h1>Notice Details</h1>
            <p>View complete information about this notice.</p>
        </div>

        <a
            href="<?= base_url('notices') ?>"
            class="notice-view-back"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Notices
        </a>

    </div>


    <!-- Notice Card -->
    <div class="notice-view-card">

        <!-- Card Header -->
        <div class="notice-view-card-header">

            <h2 class="notice-view-title">
                <?= esc($notice->title) ?>
            </h2>


            <div class="notice-view-meta">

                <span class="notice-view-badge notice-view-badge-audience">
                    <i class="fa-solid fa-users"></i>

                    <?= esc(ucfirst($notice->target_audience)) ?>
                </span>


                <?php if ($notice->status === 'active'): ?>

                    <span class="notice-view-badge notice-view-badge-active">
                        <i class="fa-solid fa-circle-check"></i>
                        Active
                    </span>

                <?php else: ?>

                    <span class="notice-view-badge notice-view-badge-inactive">
                        <i class="fa-solid fa-circle-xmark"></i>
                        Inactive
                    </span>

                <?php endif; ?>

            </div>

        </div>


        <!-- Card Body -->
        <div class="notice-view-body">

            <!-- Information Grid -->
            <div class="notice-view-info-grid">

                <div class="notice-view-info-box">

                    <div class="notice-view-info-label">
                        <i class="fa-solid fa-users"></i>
                        Target Audience
                    </div>

                    <div class="notice-view-info-value">
                        <?= esc(ucfirst($notice->target_audience)) ?>
                    </div>

                </div>


                <div class="notice-view-info-box">

                    <div class="notice-view-info-label">
                        <i class="fa-solid fa-circle-info"></i>
                        Status
                    </div>

                    <div class="notice-view-info-value">
                        <?= esc(ucfirst($notice->status)) ?>
                    </div>

                </div>


                <div class="notice-view-info-box">

                    <div class="notice-view-info-label">
                        <i class="fa-solid fa-calendar-plus"></i>
                        Publish Date
                    </div>

                    <div class="notice-view-info-value">

                        <?= !empty($notice->publish_date)
                            ? date('d M Y', strtotime($notice->publish_date))
                            : '-' ?>

                    </div>

                </div>


                <div class="notice-view-info-box">

                    <div class="notice-view-info-label">
                        <i class="fa-solid fa-calendar-xmark"></i>
                        Expiry Date
                    </div>

                    <div class="notice-view-info-value">

                        <?= !empty($notice->expiry_date)
                            ? date('d M Y', strtotime($notice->expiry_date))
                            : 'No expiry date' ?>

                    </div>

                </div>

            </div>


            <!-- Message -->
            <div class="notice-view-message-box">

                <div class="notice-view-message-header">
                    <i class="fa-solid fa-message"></i>
                    Notice Message
                </div>

                <div class="notice-view-message">
                    <?= esc($notice->message) ?>
                </div>

            </div>

        </div>


        <!-- Actions -->
        <div class="notice-view-actions">

            <a
                href="<?= base_url('notices') ?>"
                class="notice-view-btn notice-view-btn-back"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>


            <a
                href="<?= base_url('notices/edit/' . $notice->id) ?>"
                class="notice-view-btn notice-view-btn-edit"
            >
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Notice
            </a>

        </div>

    </div>

</div>


<?= $this->endSection() ?>