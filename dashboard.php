<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] == "") {
    header("Location:index.php");
}
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
</head>

<body>
    <div class="dashboard">
        <div class="profile">
            <div class="profile-details">
                <h2>Admin</h2>
                <div class="img-details">
                    <img src="profile.png" alt="">
                    <div class="details">
                        <?php
                        $email = $_SESSION['email'];
                        $query = "SELECT * FROM tbl_admin WHERE email = '$email'";
                        $select = mysqli_query($conn, $query);
                        if (mysqli_num_rows($select) > 0) {
                            $row = mysqli_fetch_array($select);
                            $admin_id = $row['admin_id'];
                            ?>
                            <div class="name"><?php echo $row['name']; ?></div>
                            <div class="email"><?php echo $row['email']; ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="logout"><a href="logout.php">Logout</a></div>
            </div>
        </div>
        <div class="employess">
            <div class="table">
                <div class="title">
                    <h1 class="company" style="color: #fff;">
                        <?php echo $row['company']; ?>
                    </h1>
                    <div class="add-employee">
                        <a href="?action=add">Add Employee</a>
                    </div>
                </div>
                <h2 style="margin-top: 40px; color: #fff;">Employees</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Qr Code</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>NIN</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Job Title</th>
                            <th>Department</th>
                            <th>Supervisor</th>
                            <th>Employment Status</th>
                            <th>Start Date</th>
                            <th>Employee ID</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_employees";
                        $select = mysqli_query($conn, $query);
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_array($select)) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="qrcode"></div>
                                        <input type="hidden" class="employeeId" value="<?php echo $row['employee_id']; ?>">
                                    </td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['nin']; ?></td>
                                    <td><?php echo $row['e_email']; ?></td>
                                    <td><?php echo $row['e_contact']; ?></td>
                                    <td><?php echo $row['e_address']; ?></td>
                                    <td><?php echo $row['job_title']; ?></td>
                                    <td><?php echo $row['department']; ?></td>
                                    <td><?php echo $row['supervisor']; ?></td>
                                    <td><?php echo $row['employment_status']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['employee_id_number']; ?></td>
                                    <td><a href="delete.php?id=<?php echo $row['employee_id']; ?>">Delete</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="12" style="text-align: center; color: red;">No employee registered</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == 'add') {
            $error = "";
            if (isset($_POST['add_employee'])) {
                $full_name = $_POST['full_name'];
                $dob = $_POST['dob'];
                $nin = $_POST['nin'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $address = $_POST['address'];
                $job_title = $_POST['job_title'];
                $department = $_POST['department'];
                $supervisor = $_POST['supervisor'];
                $employment_status = $_POST['employment_status'];
                $start_date = $_POST['start_date'];
                $employee_id_number = $_POST['employee_id_number'];

                $query = "SELECT * FROM tbl_employees WHERE e_email = '$email'";
                $select = mysqli_query($conn, $query);
                if (mysqli_num_rows($select) > 0) {
                    $error .= "<div style='color:red;'>Error, The employee already exists</div>";
                } else {
                    $query = "INSERT INTO tbl_employees(full_name, dob, nin, e_email, e_contact, 
                    e_address, job_title, department, supervisor, employment_status, 
                    `start_date`, employee_id_number, admin_id)
                    VALUES('$full_name','$dob','$nin','$email','$contact','$address','$job_title',
                    '$department','$supervisor','$employment_status','$start_date',
                    '$employee_id_number','" . $admin_id . "')";
                    $insert = mysqli_query($conn, $query);
                    if ($insert) {
                        header("Location:dashboard.php");
                    } else {
                        $error .= "<div style='color: red;'>Error, failed to add the employee, please try again</div>";
                    }
                }
            }
            ?>
            <div class="add">
                <div class="add-form">
                    <div class="close"><a href="dashboard.php">X</a></div>
                    <form method="post">
                        <span><?php echo $error; ?></span>
                        <h3>Persnal Details</h3>
                        <div class="input-box">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" class="input-field" placeholder="Full Name" required />
                        </div>
                        <div class="input-box">
                            <label for="date">Date of Birth</label>
                            <input type="date" name="dob" class="input-field" required />
                        </div>
                        <div class="input-box">
                            <label for="nin">Nation Identification Number</label>
                            <input type="text" name="nin" class="input-field" placeholder="Nation Identification Number"
                                required />
                        </div>
                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="input-field" placeholder="Email" required />
                        </div>
                        <div class="input-box">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" class="input-field" placeholder="Phone Number" required />
                        </div>
                        <div class="input-box">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="input-field" placeholder="Address" required />
                        </div>
                        <br>
                        <h3>Employment Details</h3>
                        <div class="input-box">
                            <label for="job_title">Job Title/Position</label>
                            <input type="text" name="job_title" class="input-field" placeholder="Job Title" required />
                        </div>
                        <div class="input-box">
                            <label for="department">Department or Team</label>
                            <input type="text" name="department" class="input-field" placeholder="Department" required />
                        </div>
                        <div class="input-box">
                            <label for="supervisor">Supervisor/Manager</label>
                            <input type="text" name="supervisor" class="input-field" placeholder="Supervisor" required />
                        </div>
                        <div class="input-box">
                            <label for="employment_status">Employment Status</label>
                            <select name="employment_status">
                                <option value="">Select the employment status</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Contractor">Contract</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="input-field" required />
                        </div>
                        <div class="input-box">
                            <label for="employee_id_number">Employee ID Number (if already assigned)</label>
                            <input type="test" name="employee_id_number" class="input-field"
                                placeholder="Employment ID Number" />
                        </div>
                        <div class="input-box">
                            <input type="submit" name="add_employee" class="submit" value="Add Employee" />
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>
<script>
    let employeeElements = document.querySelectorAll(".employeeId");

    employeeElements.forEach(employeeElement => {
        let employeeId = employeeElement.value.trim();
        const qrcodeDiv = document.createElement("div");
        qrcodeDiv.classList.add("qrcode");
        employeeElement.parentNode.appendChild(qrcodeDiv);

        new QRCode(qrcodeDiv, {
            text: "http://172.20.10.2/employee-registration.com/employee.php?id=" + employeeId,
            width: 128,
            height: 128
        });
    });
</script>

</html>