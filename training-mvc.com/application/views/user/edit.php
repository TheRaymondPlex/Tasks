<h1 style="text-align: center">Editing profile page</h1>
<?php foreach ($user as $usr) { ?>
<div class="container">
    <form action="/user/edit" method="post">
        <h1 class="display-6 text-center">Editing user</h1>
        <hr>
        <br>
        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="name"
                   class="form-control"
                   id="name"
                   name="name"
                   value="<?=$usr['name']?>"
            >
        </div>

        <div class="mb-3">
            <label for="InputName" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="<?=$usr['email']?>"
            >
        </div>


        <div class="mb-3">
            <label for="Select" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="selectGender">
                <option value="Male" <?php if ($usr['gender'] == 'Male') { echo ' selected="selected"'; }?>>Male</option>
                <option value="Female" <?php if ($usr['gender'] == 'Female') { echo ' selected="selected"'; }?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Select" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="selectStatus">
                <option value="Active" <?php if ($usr['status'] == 'Active') { echo ' selected="selected"'; }?>>Active</option>
                <option value="Inactive" <?php if ($usr['status'] == 'Inactive') { echo ' selected="selected"'; }?>>Inactive</option>
            </select>
        </div>

        <input type="text" name="emailOld" value="<?=$usr['email']?>">

        <div class="buttonsMain">
            <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>

    </form>
</div>
<?php } ?>