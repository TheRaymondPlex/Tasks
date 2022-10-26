<div class="container">
    <form action="/user/create" method="post">
        <h1 class="display-6 text-center">Create new profile</h1>
        <hr>
        <?php if (isset($data['errors'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $data['errors'] ?>
            </div>
        <?php } ?>
        <br>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value=""
                   placeholder="Enter your first and last name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value=""
                   placeholder="Enter your Email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="selectGender" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="gender">
                <?php
                foreach ($data['genders'] as $key => $val) {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="selectStatus" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="status">
                <?php
                foreach ($data['statuses'] as $key => $val) {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="buttonsMain">
            <button type="submit" class="btn btn-primary" name="create">Create</button>
        </div>

    </form>
    <br>
    <a href="/" class="btn btn-secondary">View All</a>
</div>