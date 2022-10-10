<h1>Главная страница</h1>

<?php foreach ($users as $user): ?>
    <h3><?php echo $user['email']; ?></h3>
    <p><?php echo $user['name']; ?></p>
    <p><?php echo $user['gender']; ?></p>
    <p><?php echo $user['status']; ?></p>
    <hr>
<?php endforeach;?>
