<?php include "php/update.php"; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1 style="text-align: center">Editing profile page</h1>
<div class="container">
    <form action="php/update.php"
          method="post">
        <h1 class="display-6 text-center">Editing user</h1>
        <hr>
        <br>
        <?php if (isset($_GET['error'])) {?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error'] ?>
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="name"
                   class="form-control"
                   id="name"
                   name="name"
                   value="<?=$row['name']?>"
                   >
        </div>

        <div class="mb-3">
            <label for="InputName" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="<?=$row['email']?>"
                   >
        </div>


        <div class="mb-3">
            <label for="Select" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="selectGender">
                <option value="male" <?php if ($row['gender'] == 'male') { echo ' selected="selected"'; }?>>Male</option>
                <option value="female" <?php if ($row['gender'] == 'female') { echo ' selected="selected"'; }?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Select" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="selectStatus">
                <option value="active" <?php if ($row['status'] == 'active') { echo ' selected="selected"'; }?>>Active</option>
                <option value="inactive" <?php if ($row['status'] == 'inactive') { echo ' selected="selected"'; }?>>Inactive</option>
            </select>
        </div>

        <input type="text" name="emailOld" value="<?=$row['email']?>" hidden>

        <div class="buttonsMain">
            <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>

    </form>
</div>
</body>
</html>