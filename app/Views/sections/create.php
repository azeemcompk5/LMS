<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>

    .container {
        max-width: 700px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .page-header p {
        margin: 6px 0 0;
        color: #6b7280;
    }

    .form-box {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
    }

    .field {
        margin-bottom: 20px;
    }

    .field label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        color: #374151;
    }

    .field input,
    .field select {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 15px;
        background: #ffffff;
    }

    .field input:focus,
    .field select:focus {
        outline: none;
        border-color: #2563eb;
    }

    .buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .save-btn {
        background: #2563eb;
        color: #ffffff;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
    }

    .save-btn:hover {
        background: #1d4ed8;
    }

    .cancel-btn {
        background: #e5e7eb;
        color: #374151;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
    }

    .cancel-btn:hover {
        background: #d1d5db;
    }

</style>


<div class="container">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <h1>Add Section</h1>

        <p>
            Create a new section for a class
        </p>

    </div>


    <!-- FORM -->

    <div class="form-box">

        <form action="<?= base_url('sections/store') ?>" method="post">


            <!-- CLASS -->

            <div class="field">

                <label>Class</label>

                <select name="class_id" required>

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


            <!-- SECTION NAME -->

            <div class="field">

                <label>Section Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="e.g. A"
                    required
                >

            </div>


            <!-- CAPACITY -->

            <div class="field">

                <label>Capacity</label>

                <input
                    type="number"
                    name="capacity"
                    placeholder="e.g. 40"
                    min="1"
                    required
                >

            </div>


            <!-- STATUS -->

            <div class="field">

                <label>Status</label>

                <select name="status" required>

                    <option value="active">
                        Active
                    </option>

                    <option value="inactive">
                        Inactive
                    </option>

                </select>

            </div>


            <!-- BUTTONS -->

            <div class="buttons">

                <button type="submit" class="save-btn">

                    <i class="fa-solid fa-check"></i>
                    Save Section

                </button>


                <a
                    href="<?= base_url('sections') ?>"
                    class="cancel-btn"
                >

                    <i class="fa-solid fa-arrow-left"></i>
                    Cancel

                </a>

            </div>


        </form>

    </div>

</div>


<?= $this->endSection() ?>