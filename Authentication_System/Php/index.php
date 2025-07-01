<?php
  include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="container">

            <div class="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div class="main">
                <h2>Welcome to our website</h2>
                <p>
                    You can register in this website and create account. 
                </p>

                <h2 class="mt_20 mb_10">All Registered Users</h2>
                <table class="t1">
                    <tr>
                        <th>SL</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                     <?php
                        $i=0;
                        $statement = $pdo->prepare("SELECT * FROM users");
                        $statement->execute(); // This is required
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                           $i++;
                           echo '<tr>';
                               echo '<td>' . $i . '</td>';
                               echo '<td>' . $row['firstname'] . '</td>';
                               echo '<td>' . $row['lastname'] . '</td>';
                               echo '<td>' . $row['email'] . '</td>';
                               echo '<td>' . $row['phone'] . '</td>';
                            echo '</tr>';
                        }
                     ?>
       
                </table>
            </div>
        </div>
     <?php include_once('footer.php'); ?>
    
</body>
</html>