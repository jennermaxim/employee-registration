<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NWIR | Employee Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <div class="details">
            <?php
            if ($_GET) {
                $id = $_GET['id'];
                include 'connect.php';

                $sql = "SELECT * FROM tbl_employees WHERE employee_id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <h2 style="color: blue; padding-bottom: 10px">Employee Details</h2>
                <p><span class="title">Full Name: </span><span><?php echo $row['full_name']; ?></span></p>
                <p><span class="title">Date of Birth: </span><span><?php echo $row['dob']; ?></span></p>
                <p><span class="title">Nation Identification Number: </span><span><?php echo $row['nin']; ?></span></p>
                <p><span class="title">Email Address: </span><span><?php echo $row['e_email']; ?></span></p>
                <p><span class="title">Phone Number: </span><span><?php echo $row['e_contact']; ?></span></p>
                <p><span class="title">Address: </span><span><?php echo $row['e_address']; ?></span></p>
                <p><span class="title">Job Title: </span><span><?php echo $row['job_title']; ?></span></p>
                <p><span class="title">Department: </span><span><?php echo $row['department']; ?></span></p>
                <p><span class="title">Supervisor: </span><span><?php echo $row['supervisor']; ?></span></p>
                <p><span class="title">Employment status: </span><span><?php echo $row['employment_status']; ?></span></p>
                <p><span class="title">Start Date: </span><span><?php echo $row['start_date']; ?></span></p>
                <p><span class="title">Employee ID Number: </span><span><?php echo $row['employee_id_number']; ?></span></p>
                <?php
            } else {
                header("Location: index.php");
            }
            ?>
        </div>
    </div>
</body>

</html>