<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1 style="text-align: center">Creating profile page</h1>
    <div class="container">
        <form action="php/create.php"
              method="post">
            <h1 class="display-6 text-center">Create new profile</h1>
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
                       value="<?php if (isset($_GET['name'])) echo $_GET['name'] ?>"
                       placeholder="Enter your first and last name">
            </div>

            <div class="mb-3">
                <label for="InputName" class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                       id="email"
                       name="email"
                       value="<?php if (isset($_GET['email'])) echo $_GET['email'] ?>"
                       placeholder="Enter your Email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>


            <div class="mb-3">
                <label for="Select" class="form-label">Gender</label>
                <select id="selectGender" class="form-select" name="selectGender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Select" class="form-label">Status</label>
                <select id="selectStatus" class="form-select" name="selectStatus">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="buttonsMain">
                <button type="submit" class="btn btn-primary" name="create">Create</button>
            </div>

        </form>
        <br>
        <a href="read.php">
            <button type="button" class="btn btn-secondary" name="viewAll">View All</button>
        </a>
    </div>
</body>
</html>