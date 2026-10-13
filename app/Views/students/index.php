
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .students-page {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .students-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .students-title h1 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .students-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-student-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #2563eb;
        color: #ffffff;
        padding: 11px 18px;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .add-student-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
    }

    /* =========================
       TOOLBAR
    ========================= */

    .students-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .search-box {
        position: relative;
        width: 340px;
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
        box-sizing: border-box;
        padding: 11px 13px 11px 38px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        background: #ffffff;
        transition: 0.2s ease;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    /* =========================
       TABLE
    ========================= */

    .students-table-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    .students-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .students-table th,
    .students-table td {
        padding: 14px 13px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .students-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .students-table td {
        color: #374151;
        font-size: 14px;
    }

    .students-table tbody tr {
        transition: background 0.15s ease;
    }

    .students-table tbody tr:hover {
        background: #f8fafc;
    }

    .students-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================
       STUDENT INFORMATION
    ========================= */

    .student-name {
        font-weight: 600;
        color: #111827;
    }

    .father-name {
        color: #374151;
        font-weight: 500;
    }

    .admission-no {
        color: #2563eb;
        font-weight: 600;
    }

    .phone-number {
        color: #4b5563;
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
        gap: 10px;
        white-space: nowrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        text-decoration: none;
        font-size: 15px;
        padding: 0;
        border: none;
        border-radius: 7px;
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

    .empty-state {
        text-align: center;
        padding: 50px 20px !important;
        color: #6b7280 !important;
        font-size: 14px;
    }

    .empty-state i {
        display: block;
        margin-bottom: 10px;
        font-size: 28px;
        color: #9ca3af;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .students-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .add-student-btn {
            width: 100%;
        }

        .students-toolbar {
            width: 100%;
        }

        .search-box {
            width: 100%;
        }

        .students-table-card {
            padding: 12px;
        }
    }
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
</style>


<div class="students-page">

    <!-- PAGE HEADER -->

    <div class="students-header">

        <div class="students-title">

            <h1>Students</h1>

            <p>
                Manage all school students
            </p>

        </div>


        <a
            href="<?= base_url('students/create') ?>"
            class="add-student-btn"
        >
            <i class="fa-solid fa-plus"></i>
            Add Student
        </a>

    </div>


    <!-- SEARCH -->

    <div class="students-toolbar">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="studentSearch"
                placeholder="Search by admission no, student name, father name..."
            >

        </div>

    </div>
    <div class="summary-cards">

    <div class="summary-card">

        <div class="summary-icon">
            <i class="fa-solid fa-users"></i>
        </div>

        <div>
            <span>Total Students</span>
            <strong><?= esc($totalStudents) ?></strong>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">
            <i class="fa-solid fa-user-check"></i>
        </div>

        <div>
            <span>Active Students</span>
            <strong><?= esc($activeStudents) ?></strong>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">
            <i class="fa-solid fa-user-slash"></i>
        </div>

        <div>
            <span>Inactive Students</span>
            <strong><?= esc($inactiveStudents) ?></strong>
        </div>

    </div>

</div>
    

    <!-- STUDENTS TABLE -->

    <div class="students-table-card">

        <table class="students-table" id="studentsTable">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Admission No</th>

                    <th>Student Name</th>

                    <th>Father Name</th>

                    <th>Gender</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($students)): ?>

                    <?php $serial = 1; ?>
                    <?php foreach ($students as $student): ?>

                        <tr>

                            <!-- ID -->

                             <td><?= $serial++ ?></td>

                            <!-- Admission Number -->

                            <td>

                                <span class="admission-no">
                                    <?= esc($student->admission_no) ?>
                                </span>

                            </td>


                           <!-- Student Name -->

<td>
    <div style="display:flex; align-items:center; gap:10px;">

        <?php if (!empty($student->photo)): ?>

            <img
                src="<?= base_url('uploads/students/' . $student->photo) ?>"
                alt="Student Photo"
                style="
                    width:40px;
                    height:40px;
                    border-radius:50%;
                    object-fit:cover;
                    border:2px solid #e5e7eb;
                    flex-shrink:0;
                "
            >

        <?php else: ?>

            <div
                style="
                    width:40px;
                    height:40px;
                    border-radius:50%;
                    background:#f1f5f9;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#64748b;
                    font-size:16px;
                    flex-shrink:0;
                "
            >
                <i class="fa-solid fa-user"></i>
            </div>

        <?php endif; ?>

        <div>
            <div class="student-name">
                <?= esc(trim($student->first_name . ' ' . $student->last_name)) ?>
            </div>

            <div style="font-size:12px; color:#64748b; margin-top:2px;">
                <?= esc($student->class_name ?? '') ?>
                <?php if (!empty($student->section_name)): ?>
                    - <?= esc($student->section_name) ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</td>


                            <!-- Father Name -->

                            <td>

                                <span class="father-name">
                                    <?= esc($student->guardian_name ?? '-') ?>
                                </span>

                            </td>


                            <!-- Gender -->

                            <td>
                                <?= esc($student->gender ?? '-') ?>
                            </td>


                            <!-- Phone -->

                            <td>

                                <span class="phone-number">
                                    <?= esc($student->guardian_phone ?? '-') ?>
                                </span>

                            </td>


                            <!-- Status -->

                            <td>

                                <span class="status <?= esc(strtolower($student->status ?? 'inactive')) ?>">

                                    <?= esc(ucfirst($student->status ?? 'Inactive')) ?>

                                </span>

                            </td>


                            <!-- Actions -->

                            <td>

                                <div class="action-buttons">

                                    <!-- View -->

                                    <a
                                        href="<?= base_url('students/view/' . $student->id) ?>"
                                        class="action-btn view-btn"
                                        title="View Student"
                                        aria-label="View Student"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    <!-- Edit -->

                                    <a
                                        href="<?= base_url('students/edit/' . $student->id) ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Student"
                                        aria-label="Edit Student"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>


                                    <!-- Delete -->

                                    <form
                                        action="<?= base_url('students/delete/' . $student->id) ?>"
                                        method="post"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this student?');"
                                    >

                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Student"
                                            aria-label="Delete Student"
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
                            colspan="10"
                            class="empty-state"
                        >

                            <i class="fa-solid fa-user-graduate"></i>

                            No students found.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- SEARCH SCRIPT -->

<script>

    const searchInput = document.getElementById('studentSearch');

    searchInput.addEventListener('keyup', function () {

        const searchValue = this.value.toLowerCase().trim();

        const rows = document.querySelectorAll(
            '#studentsTable tbody tr'
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
```
