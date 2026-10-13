<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

    .container {
        padding: 0;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563eb;
        color: white;
        padding: 11px 18px;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .add-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
    }

    /* =========================
       SEARCH
    ========================= */

    .toolbar {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .search-box {
        position: relative;
        width: 320px;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }

    .search-box input {
        width: 100%;
        padding: 11px 13px 11px 38px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        background: white;
        transition: 0.2s ease;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    /* =========================
       TABLE
    ========================= */

    .table-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    th,
    td {
        padding: 14px 13px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
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
       CLASS NAME
    ========================= */

    .class-name {
        font-weight: 600;
        color: #111827;
    }

    .description {
        color: #64748b;
    }

    /* =========================
       STATUS
    ========================= */

    .status {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status.active {
        background: #dcfce7;
        color: #15803d;
    }

    .status.inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* =========================
       ACTION BUTTONS
    ========================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 13px;
        white-space: nowrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        text-decoration: none;
        font-size: 15px;
        padding: 0;
        border: none;
        border-radius: 6px;
        background: transparent;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .view-btn {
        color: #2563eb;
    }

    .edit-btn {
        color: #059669;
    }

    .delete-btn {
        color: #dc2626 !important;
        font-size: 16px;
    }

    .view-btn:hover {
        background: #eff6ff;
        transform: translateY(-1px);
    }

    .edit-btn:hover {
        background: #ecfdf5;
        transform: translateY(-1px);
    }

    .delete-btn:hover {
        background: #fef2f2;
        transform: translateY(-1px);
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty {
        text-align: center;
        padding: 45px;
        color: #6b7280;
        font-size: 14px;
    }
    /* =========================
   SUMMARY CARDS
========================= */

.summary-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

.summary-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.summary-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #eff6ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

.summary-card span {
    display: block;
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 5px;
}

.summary-card strong {
    display: block;
    color: #111827;
    font-size: 24px;
    font-weight: 700;
}

@media (max-width: 800px) {
    .summary-cards {
        grid-template-columns: 1fr;
    }
}

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .header {
            align-items: flex-start;
            flex-direction: column;
        }

        .add-btn {
            width: 100%;
            justify-content: center;
        }

        .search-box {
            width: 100%;
        }

        .table-box {
            padding: 12px;
        }
        .summary-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

@media (max-width: 800px) {
    .summary-cards {
        grid-template-columns: 1fr;
    }
}
    }

</style>


<div class="container">

    <!-- PAGE HEADER -->

    <div class="header">

        <div>

            <h1>
                Classes
            </h1>

            <p>
                Manage school classes
            </p>

        </div>

        <a
            href="<?= base_url('classes/create') ?>"
            class="add-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Class
        </a>

    </div>


    <!-- SEARCH -->

    <div class="toolbar">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="classSearch"
                placeholder="Search classes..."
            >

        </div>

    </div>
    <div class="summary-cards">

    <div class="summary-card">
        <div class="summary-icon">
            <i class="fa-solid fa-school"></i>
        </div>

        <div>
            <span>Total Classes</span>
            <strong><?= esc($totalClasses) ?></strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div>
            <span>Active Classes</span>
            <strong><?= esc($activeClasses) ?></strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <div>
            <span>Inactive Classes</span>
            <strong><?= esc($inactiveClasses) ?></strong>
        </div>
    </div>

</div>


    <!-- TABLE -->

    <div class="table-box">

        <table id="classesTable">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Class Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($classes)): ?>

                    <?php foreach ($classes as $index => $class): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <span class="class-name">
                                    <?= esc($class->name) ?>
                                </span>
                            </td>

                            <td>
                                <span class="description">
                                    <?= esc($class->description ?: '-') ?>
                                </span>
                            </td>

                            <td>

                                <span class="status <?= esc($class->status) ?>">
                                    <?= esc(ucfirst($class->status)) ?>
                                </span>

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="<?= base_url('classes/view/' . $class->id) ?>"
                                        class="action-btn view-btn"
                                        title="View Class"
                                        aria-label="View Class"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    <a
                                        href="<?= base_url('classes/edit/' . $class->id) ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Class"
                                        aria-label="Edit Class"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>


                                    <form
                                        action="<?= base_url('classes/delete/' . $class->id) ?>"
                                        method="post"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this class?');"
                                    >

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Class"
                                            aria-label="Delete Class"
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

                        <td
                            colspan="5"
                            class="empty"
                        >
                            No classes found.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- SEARCH SCRIPT -->

<script>

    const searchInput = document.getElementById('classSearch');

    searchInput.addEventListener('keyup', function () {

        const searchValue = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#classesTable tbody tr'
        );

        rows.forEach(function (row) {

            const rowText = row.innerText.toLowerCase();

            row.style.display =
                rowText.includes(searchValue)
                    ? ''
                    : 'none';

        });

    });

</script>


<?= $this->endSection() ?>