```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .notices-page {
        padding: 0;
    }

    /* =========================
       PAGE HEADER
    ========================= */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .page-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .page-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 20px;
    }

    .page-header h1 {
        margin: 0 0 5px;
        font-size: 27px;
        font-weight: 700;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        padding: 11px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .add-btn:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
    }

    /* =========================
       SUMMARY CARDS
    ========================= */
    .notice-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 17px 18px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .summary-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .summary-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .summary-icon.green {
        background: #ecfdf5;
        color: #059669;
    }

    .summary-icon.gray {
        background: #f3f4f6;
        color: #6b7280;
    }

    .summary-info span {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .summary-info strong {
        display: block;
        color: #111827;
        font-size: 20px;
        line-height: 1;
    }

    /* =========================
       TOOLBAR
    ========================= */
    .toolbar-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 250px;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }

    .search-box input,
    .filter-select {
        width: 100%;
        height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        background: #fff;
        color: #374151;
        transition: 0.2s ease;
    }

    .search-box input {
        padding: 10px 13px 10px 38px;
    }

    .search-box input:focus,
    .filter-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .filter-wrap {
        width: 180px;
    }

    .filter-select {
        padding: 0 12px;
        cursor: pointer;
    }

    /* =========================
       TABLE
    ========================= */
    .table-box {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-scroll {
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 14px 15px;
        text-align: left;
        border-bottom: 1px solid #eef0f3;
        white-space: nowrap;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    td {
        color: #374151;
        font-size: 14px;
    }

    tbody tr {
        transition: background 0.15s ease;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================
       NOTICE TITLE
    ========================= */
    .title-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notice-small-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
    }

    .notice-title {
        color: #111827;
        font-weight: 600;
    }

    .notice-subtitle {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 3px;
    }

    .audience {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #475569;
        font-weight: 500;
    }

    .audience i {
        color: #94a3b8;
        font-size: 12px;
    }

    .notice-date {
        color: #64748b;
        font-size: 13px;
    }

    /* =========================
       STATUS
    ========================= */
    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status.active {
        background: #dcfce7;
        color: #15803d;
    }

    .status.inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status.draft {
        background: #fef3c7;
        color: #b45309;
    }

    .status.expired {
        background: #f3f4f6;
        color: #6b7280;
    }

    /* =========================
       ACTION BUTTONS
    ========================= */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        text-decoration: none;
        font-size: 14px;
        border: none;
        border-radius: 7px;
        background: transparent;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .view-btn {
        color: #2563eb;
    }

    .edit-btn {
        color: #059669;
    }

    .delete-btn {
        color: #dc2626 !important;
    }

    .view-btn:hover {
        background: #eff6ff;
    }

    .edit-btn:hover {
        background: #ecfdf5;
    }

    .delete-btn:hover {
        background: #fef2f2;
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .empty {
        text-align: center;
        padding: 55px 20px !important;
        color: #6b7280;
    }

    .empty-icon {
        width: 55px;
        height: 55px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .empty strong {
        display: block;
        color: #374151;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .empty span {
        font-size: 13px;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 850px) {
        .notice-summary {
            grid-template-columns: 1fr;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .add-btn {
            width: 100%;
        }
    }

    @media (max-width: 650px) {
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box,
        .filter-wrap {
            width: 100%;
            min-width: 100%;
        }
    }
</style>

<div class="notices-page">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="page-title-wrap">

            <div class="page-icon">
                <i class="fa-solid fa-bullhorn"></i>
            </div>

            <div>
                <h1>Notices</h1>
                <p>Manage school announcements and notices</p>
            </div>

        </div>

        <a href="<?= base_url('notices/create') ?>" class="add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Notice
        </a>

    </div>


    <!-- SUMMARY -->
    <?php
        $totalNotices = !empty($notices) ? count($notices) : 0;

        $activeNotices = 0;
        $draftNotices = 0;

        if (!empty($notices)) {
            foreach ($notices as $noticeItem) {
                $noticeStatus = strtolower($noticeItem->status ?? '');

                if ($noticeStatus === 'active') {
                    $activeNotices++;
                }

                if ($noticeStatus === 'draft') {
                    $draftNotices++;
                }
            }
        }
    ?>

    <div class="notice-summary">

        <div class="summary-card">
            <div class="summary-icon blue">
                <i class="fa-solid fa-bullhorn"></i>
            </div>

            <div class="summary-info">
                <span>Total Notices</span>
                <strong><?= $totalNotices ?></strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="summary-info">
                <span>Active Notices</span>
                <strong><?= $activeNotices ?></strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon gray">
                <i class="fa-solid fa-file-pen"></i>
            </div>

            <div class="summary-info">
                <span>Draft Notices</span>
                <strong><?= $draftNotices ?></strong>
            </div>
        </div>

    </div>


    <!-- TOOLBAR -->
    <div class="toolbar-card">

        <div class="toolbar">

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="noticeSearch"
                    placeholder="Search by notice title or audience..."
                >
            </div>

            <div class="filter-wrap">
                <select id="audienceFilter" class="filter-select">
                    <option value="">All Audiences</option>
                    <option value="students">Students</option>
                    <option value="parents">Parents</option>
                    <option value="teachers">Teachers</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            <div class="filter-wrap">
                <select id="statusFilter" class="filter-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="draft">Draft</option>
                    <option value="inactive">Inactive</option>
                    <option value="expired">Expired</option>
                </select>
            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="table-box">

        <div class="table-scroll">

            <table id="noticesTable">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Notice</th>
                        <th>Audience</th>
                        <th>Publish Date</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($notices)): ?>

                        <?php foreach ($notices as $index => $notice): ?>

                            <?php
                                $noticeStatus = strtolower($notice->status ?? '');
                                $noticeAudience = strtolower($notice->target_audience ?? '');

                                $statusClass = $noticeStatus;

                                if (!in_array($statusClass, ['active', 'inactive', 'draft', 'expired'])) {
                                    $statusClass = 'inactive';
                                }
                            ?>

                            <tr
                                data-audience="<?= esc($noticeAudience) ?>"
                                data-status="<?= esc($noticeStatus) ?>"
                            >

                                <td>
                                    <?= $index + 1 ?>
                                </td>


                                <!-- NOTICE -->
                                <td>

                                    <div class="title-cell">

                                        <div class="notice-small-icon">
                                            <i class="fa-regular fa-file-lines"></i>
                                        </div>

                                        <div>
                                            <div class="notice-title">
                                                <?= esc($notice->title) ?>
                                            </div>

                                            <div class="notice-subtitle">
                                                School Announcement
                                            </div>
                                        </div>

                                    </div>

                                </td>


                                <!-- AUDIENCE -->
                                <td>

                                    <span class="audience">

                                        <i class="fa-solid fa-users"></i>

                                        <?= esc(
                                            ucfirst($notice->target_audience)
                                        ) ?>

                                    </span>

                                </td>


                                <!-- PUBLISH DATE -->
                                <td>

                                    <span class="notice-date">

                                        <i class="fa-regular fa-calendar"></i>

                                        <?= date(
                                            'd M Y',
                                            strtotime($notice->publish_date)
                                        ) ?>

                                    </span>

                                </td>


                                <!-- EXPIRY DATE -->
                                <td>

                                    <span class="notice-date">

                                        <?php if (!empty($notice->expiry_date)): ?>

                                            <i class="fa-regular fa-calendar-xmark"></i>

                                            <?= date(
                                                'd M Y',
                                                strtotime($notice->expiry_date)
                                            ) ?>

                                        <?php else: ?>

                                            —

                                        <?php endif; ?>

                                    </span>

                                </td>


                                <!-- STATUS -->
                                <td>

                                    <span class="status <?= esc($statusClass) ?>">

                                        <span class="status-dot"></span>

                                        <?= esc(
                                            ucfirst($notice->status)
                                        ) ?>

                                    </span>

                                </td>


                                <!-- ACTIONS -->
                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="<?= base_url('notices/view/' . $notice->id) ?>"
                                            class="action-btn view-btn"
                                            title="View Notice"
                                            aria-label="View Notice"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>


                                        <a
                                            href="<?= base_url('notices/edit/' . $notice->id) ?>"
                                            class="action-btn edit-btn"
                                            title="Edit Notice"
                                            aria-label="Edit Notice"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        <form
                                            action="<?= base_url('notices/delete/' . $notice->id) ?>"
                                            method="post"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this notice?');"
                                        >

                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Delete Notice"
                                                aria-label="Delete Notice"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="empty">

                                <div class="empty-icon">
                                    <i class="fa-regular fa-bell-slash"></i>
                                </div>

                                <strong>No notices found</strong>

                                <span>
                                    Create your first school notice using the Add Notice button.
                                </span>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- SEARCH + FILTER SCRIPT -->
<script>

    const searchInput = document.getElementById('noticeSearch');
    const audienceFilter = document.getElementById('audienceFilter');
    const statusFilter = document.getElementById('statusFilter');

    function filterNotices() {

        const searchValue = searchInput.value.toLowerCase().trim();
        const audienceValue = audienceFilter.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#noticesTable tbody tr[data-audience]'
        );

        rows.forEach(function (row) {

            const rowText = row.innerText.toLowerCase();

            const rowAudience =
                row.getAttribute('data-audience') || '';

            const rowStatus =
                row.getAttribute('data-status') || '';

            const matchesSearch =
                rowText.includes(searchValue);

            const matchesAudience =
                audienceValue === '' ||
                rowAudience === audienceValue;

            const matchesStatus =
                statusValue === '' ||
                rowStatus === statusValue;

            row.style.display =
                matchesSearch &&
                matchesAudience &&
                matchesStatus
                    ? ''
                    : 'none';

        });

    }

    searchInput.addEventListener('input', filterNotices);
    audienceFilter.addEventListener('change', filterNotices);
    statusFilter.addEventListener('change', filterNotices);

</script>

<?= $this->endSection() ?>
```
