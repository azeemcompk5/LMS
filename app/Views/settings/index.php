<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* =========================
       SETTINGS PAGE
    ========================= */

    .settings-page {
        max-width: 1100px;
        margin: 0 auto;
        padding: 5px 0 30px;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .settings-page .settings-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .settings-page .header-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .settings-page .header-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .settings-page .settings-header h1 {
        margin: 0 0 5px;
        font-size: 28px;
        line-height: 1.2;
        color: #111827;
        font-weight: 700;
    }

    .settings-page .settings-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .settings-page .settings-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* =========================
       CARD HEADER
    ========================= */

    .settings-page .card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 25px;
        border-bottom: 1px solid #eef0f3;
        background: #ffffff;
    }

    .settings-page .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #f3f4f6;
        color: #4b5563;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .settings-page .card-header h2 {
        margin: 0 0 4px;
        font-size: 17px;
        color: #111827;
        font-weight: 700;
    }

    .settings-page .card-header p {
        margin: 0;
        font-size: 13px;
        color: #6b7280;
    }

    /* =========================
       FORM
    ========================= */

    .settings-page .settings-form {
        padding: 26px;
    }

    .settings-page .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #374151;
        font-size: 14px;
        font-weight: 700;
    }

    .settings-page .form-section-title i {
        color: #2563eb;
        font-size: 13px;
    }

    .settings-page .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .settings-page .form-group {
        display: flex;
        flex-direction: column;
    }

    .settings-page .form-group.full-width {
        grid-column: 1 / -1;
    }

    .settings-page .form-group label {
        margin-bottom: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .settings-page .input-wrapper {
        position: relative;
    }

    .settings-page .input-wrapper > i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
        pointer-events: none;
    }

    .settings-page .form-group input,
    .settings-page .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #ffffff;
        color: #111827;
        font-size: 14px;
        font-family: Arial, sans-serif;
        outline: none;
        transition: all 0.2s ease;
    }

    .settings-page .input-wrapper input {
        padding-left: 38px;
    }

    .settings-page .form-group input:focus,
    .settings-page .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .settings-page .form-group input::placeholder,
    .settings-page .form-group textarea::placeholder {
        color: #9ca3af;
    }

    .settings-page .form-group textarea {
        min-height: 100px;
        resize: vertical;
        line-height: 1.5;
    }

    .settings-page .field-help {
        margin-top: 6px;
        color: #9ca3af;
        font-size: 11px;
    }

    /* =========================
       DIVIDER
    ========================= */

    .settings-page .section-divider {
        margin: 28px 0 24px;
        border: 0;
        border-top: 1px solid #eef0f3;
    }

    /* =========================
       SAVE AREA
    ========================= */

    .settings-page .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #eef0f3;
    }

    .settings-page .save-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6b7280;
        font-size: 12px;
    }

    .settings-page .save-info i {
        color: #059669;
    }

    .settings-page .save-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 145px;
        padding: 11px 20px;
        border: none;
        border-radius: 8px;
        background: #2563eb;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .settings-page .save-button:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.20);
    }

    .settings-page .save-button:active {
        transform: translateY(0);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .settings-page {
            padding-bottom: 20px;
        }

        .settings-page .settings-header {
            align-items: flex-start;
        }

        .settings-page .settings-header h1 {
            font-size: 24px;
        }

        .settings-page .form-grid {
            grid-template-columns: 1fr;
        }

        .settings-page .form-group.full-width {
            grid-column: auto;
        }

        .settings-page .settings-form {
            padding: 20px;
        }

        .settings-page .card-header {
            padding: 20px;
        }

        .settings-page .form-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .settings-page .save-button {
            width: 100%;
        }

    }

    @media (max-width: 480px) {

        .settings-page .header-content {
            align-items: flex-start;
        }

        .settings-page .header-icon {
            width: 42px;
            height: 42px;
            font-size: 17px;
        }

        .settings-page .settings-header h1 {
            font-size: 22px;
        }

        .settings-page .settings-header p {
            font-size: 13px;
        }

        .settings-page .settings-form {
            padding: 16px;
        }

    }
</style>


<div class="settings-page">

    <!-- =========================
         PAGE HEADER
    ========================== -->

    <div class="settings-header">

        <div class="header-content">

            <div class="header-icon">
                <i class="fa-solid fa-gear"></i>
            </div>

            <div>

                <h1>
                    School Settings
                </h1>

                <p>
                    Manage your school's basic information and system preferences
                </p>

            </div>

        </div>

    </div>


    <!-- =========================
         SETTINGS CARD
    ========================== -->

    <div class="settings-card">

        <!-- CARD HEADER -->

        <div class="card-header">

            <div class="section-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div>

                <h2>
                    General Information
                </h2>

                <p>
                    Keep your school's basic information up to date.
                </p>

            </div>

        </div>


        <!-- FORM -->

        <form
            action="<?= base_url('settings/save') ?>"
            method="post"
            class="settings-form"
        >

            <?= csrf_field() ?>


            <!-- SCHOOL INFORMATION -->

            <div class="form-section-title">

                <i class="fa-solid fa-building"></i>

                <span>
                    School Information
                </span>

            </div>


            <div class="form-grid">


                <!-- SCHOOL NAME -->

                <div class="form-group">

                    <label for="school_name">
                        School Name
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-school"></i>

                        <input
                            type="text"
                            id="school_name"
                            name="school_name"
                            value="<?= esc($settings->school_name ?? '') ?>"
                            placeholder="Enter school name"
                            required
                        >

                    </div>

                </div>


                <!-- SCHOOL CODE -->

                <div class="form-group">

                    <label for="school_code">
                        School Code
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-hashtag"></i>

                        <input
                            type="text"
                            id="school_code"
                            name="school_code"
                            value="<?= esc($settings->school_code ?? '') ?>"
                            placeholder="Enter school code"
                        >

                    </div>

                    <div class="field-help">
                        Optional internal school identification code.
                    </div>

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= esc($settings->email ?? '') ?>"
                            placeholder="school@example.com"
                        >

                    </div>

                </div>


                <!-- PHONE -->

                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-phone"></i>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="<?= esc($settings->phone ?? '') ?>"
                            placeholder="Enter phone number"
                        >

                    </div>

                </div>


                <!-- ADDRESS -->

                <div class="form-group full-width">

                    <label for="address">
                        School Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter complete school address"
                    ><?= esc($settings->address ?? '') ?></textarea>

                </div>


                <!-- WEBSITE -->

                <div class="form-group">

                    <label for="website">
                        Website
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-globe"></i>

                        <input
                            type="text"
                            id="website"
                            name="website"
                            value="<?= esc($settings->website ?? '') ?>"
                            placeholder="https://example.com"
                        >

                    </div>

                </div>

            </div>


            <hr class="section-divider">


            <!-- ACADEMIC SETTINGS -->

            <div class="form-section-title">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    Academic & Financial Settings
                </span>

            </div>


            <div class="form-grid">


                <!-- ACADEMIC YEAR -->

                <div class="form-group">

                    <label for="academic_year">
                        Academic Year
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-calendar-days"></i>

                        <input
                            type="text"
                            id="academic_year"
                            name="academic_year"
                            value="<?= esc($settings->academic_year ?? '') ?>"
                            placeholder="2026-2027"
                        >

                    </div>

                </div>


                <!-- CURRENCY -->

                <div class="form-group">

                    <label for="currency">
                        Currency
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-money-bill-wave"></i>

                        <input
                            type="text"
                            id="currency"
                            name="currency"
                            value="<?= esc($settings->currency ?? 'PKR') ?>"
                            placeholder="PKR"
                        >

                    </div>

                </div>

            </div>


            <!-- FORM FOOTER -->

            <div class="form-footer">

                <div class="save-info">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        Changes will be saved to your school settings.
                    </span>

                </div>


                <button
                    type="submit"
                    class="save-button"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Settings

                </button>

            </div>

        </form>

    </div>

</div>


<?= $this->endSection() ?>