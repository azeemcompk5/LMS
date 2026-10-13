```php
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

.container {
    padding: 0;
}

.header {
    margin-bottom: 25px;
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

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    color: #2563eb;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.attendance-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filters {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.form-group select,
.form-group input {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    background: white;
}

.info-box {
    padding: 15px;
    background: #eff6ff;
    border-radius: 8px;
    color: #1e40af;
    font-size: 14px;
    margin-bottom: 20px;
}

.student-section {
    display: none;
    margin-top: 25px;
}

.student-section h3 {
    margin: 0 0 15px;
    color: #111827;
}

.student-table {
    width: 100%;
    border-collapse: collapse;
}

.student-table th,
.student-table td {
    padding: 13px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.student-table th {
    background: #f8fafc;
    font-size: 12px;
    color: #475569;
    text-transform: uppercase;
}

.status-select {
    padding: 8px 10px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    background: white;
}

@media (max-width: 700px) {

    .filters {
        grid-template-columns: 1fr;
    }

    .student-table {
        min-width: 650px;
    }

    .student-table-wrapper {
        overflow-x: auto;
    }
    .save-btn {
    margin-top: 20px;
    padding: 11px 20px;
    border: none;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.save-btn:hover {
    background: #1d4ed8;
}

.save-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

}

</style>


<div class="container">

    <a href="<?= base_url('attendance') ?>" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Attendance
    </a>


    <div class="header">

        <h1>
            Bulk Attendance
        </h1>

        <p>
            Mark attendance for multiple students at once.
        </p>

    </div>


    <div class="attendance-card">

        <div class="filters">

            <div class="form-group">

                <label for="class_id">
                    Select Class
                </label>

                <select id="class_id">

                    <option value="">
                        Select Class
                    </option>

                    <?php foreach ($classes as $class): ?>

                        <option value="<?= esc($class->id) ?>">
                            <?= esc($class->name) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="form-group">

                <label for="attendance_date">
                    Attendance Date
                </label>

                <input
                    type="date"
                    id="attendance_date"
                    value="<?= date('Y-m-d') ?>"
                >

            </div>

        </div>


        <div class="info-box" id="infoBox">

            <i class="fa-solid fa-circle-info"></i>

            Select a class to load students.

        </div>


        <div class="student-section" id="studentSection">

            <h3>
                Students
            </h3>

            <div class="student-table-wrapper">

                <table class="student-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Admission No.</th>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody id="studentList"></tbody>

                </table>
                </table>

<button type="button" id="saveAttendanceBtn" class="save-btn">
    <i class="fa-solid fa-floppy-disk"></i>
    Save Attendance
</button>

            </div>

        </div>

    </div>

</div>


<script>

const classSelect = document.getElementById('class_id');
const dateSelect = document.getElementById('attendance_date');
const studentSection = document.getElementById('studentSection');
const studentList = document.getElementById('studentList');
const infoBox = document.getElementById('infoBox');

let loadedStudents = [];


classSelect.addEventListener('change', function () {

    const classId = this.value;

    studentList.innerHTML = '';
    studentSection.style.display = 'none';
    loadedStudents = [];

    if (!classId) {

        infoBox.innerHTML =
            '<i class="fa-solid fa-circle-info"></i> Select a class to load students.';

        return;
    }

    infoBox.innerHTML =
        '<i class="fa-solid fa-spinner"></i> Loading students...';


    fetch('<?= base_url('attendance/students') ?>/' + classId)

        .then(response => response.json())

        .then(students => {

            if (!students.length) {

                infoBox.innerHTML =
                    '<i class="fa-solid fa-circle-info"></i> No active students found in this class.';

                return;
            }

            loadedStudents = students;


            students.forEach((student, index) => {

                const row = document.createElement('tr');

                row.innerHTML = `

                    <td>${index + 1}</td>

                    <td>${student.admission_no ?? '-'}</td>

                    <td>
                        ${student.first_name ?? ''}
                        ${student.last_name ?? ''}
                    </td>

                    <td>

                        <select class="status-select"
                                data-student-id="${student.id}">

                            <option value="present">
                                Present
                            </option>

                            <option value="absent">
                                Absent
                            </option>

                            <option value="late">
                                Late
                            </option>

                        </select>

                    </td>

                `;

                studentList.appendChild(row);

            });


            infoBox.innerHTML =
                '<i class="fa-solid fa-circle-check"></i> Students loaded successfully.';

            studentSection.style.display = 'block';

        })

        .catch(error => {

            infoBox.innerHTML =
                '<i class="fa-solid fa-circle-exclamation"></i> Unable to load students.';

            console.error(error);

        });

});
const saveAttendanceBtn = document.getElementById('saveAttendanceBtn');

saveAttendanceBtn.addEventListener('click', function () {

    const classId = classSelect.value;
    const attendanceDate = dateSelect.value;

    if (!classId) {
        alert('Please select a class.');
        return;
    }

    if (!attendanceDate) {
        alert('Please select attendance date.');
        return;
    }

    const statusSelects = document.querySelectorAll('.status-select');

    if (!statusSelects.length) {
        alert('No students found.');
        return;
    }

    const students = [];

    statusSelects.forEach(select => {

        students.push({
            student_id: select.dataset.studentId,
            status: select.value,
            remarks: ''
        });

    });


    saveAttendanceBtn.disabled = true;

    saveAttendanceBtn.innerHTML =
        '<i class="fa-solid fa-spinner"></i> Saving...';


    const formData = new FormData();

    formData.append('class_id', classId);
    formData.append('attendance_date', attendanceDate);

    students.forEach((student, index) => {

        formData.append(
            `students[${index}][student_id]`,
            student.student_id
        );

        formData.append(
            `students[${index}][status]`,
            student.status
        );

        formData.append(
            `students[${index}][remarks]`,
            student.remarks
        );

    });


    fetch('<?= base_url('attendance/bulk/store') ?>', {

        method: 'POST',
        body: formData

    })

    .then(response => {

        if (!response.ok) {
            throw new Error('Failed to save attendance.');
        }

        window.location.href = '<?= base_url('attendance') ?>';

    })

    .catch(error => {

        console.error(error);

        alert('Unable to save attendance.');

        saveAttendanceBtn.disabled = false;

        saveAttendanceBtn.innerHTML =
            '<i class="fa-solid fa-floppy-disk"></i> Save Attendance';

    });

});

</script>

<?= $this->endSection() ?>
```
