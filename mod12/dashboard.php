<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
        td,th{
            padding:10px 20px;
        }
    </style>
</head>
<body>

<?php include_once{"Header.php"};?>
    <?php 
    include_once("config.php");
    $sql="SELECT * FROM users";
    $getUsers=$conn->prepare($sql);
    $getUsers->execute();
    $users=$getUsers->fetchAll();

?>
<table>
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
    </thead>
    <tbody>
        <?php
        foreach($users as $user){ 
            ?>
            <tr>
                <td><?= $user['id']?></td>
                <td><?= $user['name']?></td>
                <td><?= $user['username']?></td>
                <td><?= $user['email']?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<a href="add.php">Add</a>

<?php include_once{"footer.php"};?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
