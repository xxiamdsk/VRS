<?php
session_start();
include ('../config.php');
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="../plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/slick/slick.css" rel="stylesheet">
    <link href="../plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="../plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        /* Custom styles for the admin dashboard */
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }

        /* Main content area */
        .main-content {
            margin-left: 300px;
            /* Same width as sidebar */
            padding: 20px;
        }

        .user-details {
            margin-left: 300px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <!-- header -->
    <?php include ('header.php'); ?>
    <!-- header -->


    <!-- Sidebar -->
    <?php include ('leftbar.php'); ?>
    <!-- Sidebar -->

    <!-- Main content -->
    <div class="user-details">
        <h1>Booking</h1>
        <!-- <a href="add-brand.php" class="btn btn-primary">Add Brand</a> -->
        <table>
            <tr>
                <th>b_no</th>
                <th>resg_no</th>
                <th>uid</th>
                <th>brand</th>
                <th>model</th>
                <th>sc_id</th>
                <th>amount</th>
                <th>location</th>
                <th>date</th>
                <th>Action</th>
            </tr>
            <?php
            // select only DISTINCT brand and model from cars table 
            $sql = "SELECT * FROM booking ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['b_no']; ?></td>
                        <td><?php echo $row['resg_no']; ?></td>
                        <td><?php echo $row['uid']; ?></td>
                        <td><?php echo $row['brand']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['sc_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td>
                            <a href="#" style="padding-right: 10px;"><i class="fa fa-check"></i></a>
                            <a href="#"><i class="fas fa-ban"></i> </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>