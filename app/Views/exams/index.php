<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

    .container {
        padding: 0;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
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
        gap: 8px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        padding: 11px 18px;
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
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
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
       EXAM DATA
    ========================= */

    .exam-name {
        color: #111827;
        font-weight: 600;
    }

    .term {
        color: #475569;
        font-weight: 500;
    }

    .exam-date {
        color: #475569;
        white-space: nowrap;
    }

    .description {
        color: #64748b;
        max-width: 280px;
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
        white-space: nowrap;
    }

    .upcoming {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .completed {
        background: #dcfce7;
        color: #15803d;
    }

    .cancelled {
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
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .page-header {
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

    }

</style>


<div class="container">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>
                Exams
            </h1>

            <p>
                Manage school examinations and exam schedules
            </p>

        </div>

        <a
            href="<?= base_url('exams/create') ?>"
            class="add-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Exam
        </a>

    </div>


    <!-- SEARCH -->

    <div class="toolbar">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="examSearch"
                placeholder="Search exams..."
            >

        </div>

    </div>


    <!-- TABLE -->

    <div class="table-box">

        <table id="examsTable">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Exam Name</th>
                    <th>Term</th>
                    <th>Exam Date</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>

            </thead>


            <tbody>

                <?php if (!empty($exams)): ?>

                    <?php foreach ($exams as $index => $exam): ?>

                        <tr>

                            <td>
                                 <?= $index + 1 ?>
                                </td>

                            <td>
                                <span class="exam-name">
                                    <?= esc($exam->name) ?>
                                </span>
                            </td>

                            <td>
                                <span class="term">
                                    <?= esc($exam->term ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <span class="exam-date">
                                    <?= !empty($exam->exam_date)
                                        ? date('d M Y', strtotime($exam->exam_date))
                                        : '-' ?>
                                </span>
                            </td>

                            <td>

                                <span class="status <?= esc(strtolower($exam->status)) ?>">
                                    <?= esc(ucfirst($exam->status)) ?>
                                </span>

                            </td>

                            <td>
                                <span class="description">
                                    <?= esc($exam->description ?? '-') ?>
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

    <!-- View Exam -->
    <a
        href="<?= base_url('exams/view/' . $exam->id) ?>"
        class="action-btn view-btn"
        title="View Exam"
        aria-label="View Exam"
    >
        <i class="fa-solid fa-eye"></i>
    </a>

    <!-- Marks Entry -->
    <a
        href="<?= base_url('exams/view/' . $exam->id) ?>"
        class="action-btn marks-btn"
        title="Marks Entry"
        aria-label="Marks Entry"
    >
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <!-- Edit Exam -->
    <a
        href="<?= base_url('exams/edit/' . $exam->id) ?>"
        class="action-btn edit-btn"
        title="Edit Exam"
        aria-label="Edit Exam"
    >
        <i class="fa-solid fa-pen"></i>
    </a>

    <!-- Delete Exam -->
    <form
        action="<?= base_url('exams/delete/' . $exam->id) ?>"
        method="post"
        style="display:inline;"
        onsubmit="return confirm('Are you sure you want to delete this exam?');"
    >
        <button
            type="submit"
            class="action-btn delete-btn"
            title="Delete Exam"
            aria-label="Delete Exam"
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
                            colspan="7"
                            class="empty"
                        >
                            No exams found.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- SEARCH SCRIPT -->

<script>

    const searchInput = document.getElementById('examSearch');

    searchInput.addEventListener('keyup', function () {

        const searchValue = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#examsTable tbody tr'
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