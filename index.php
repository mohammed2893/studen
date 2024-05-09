<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>لوحة التحكم</title>
    <style>
        body {
            background-color: whitesmoke;
            font-family: "Kanit", sans-serif;
        }
        main {
            float: left;
            border: 1px solid gray;
            padding: 5px;
            width: 66%;
            
        }
        aside {
            float: right;
            width: 30%;
            border: 1px solid black;
            padding: 10px;
            font-size: 20px;
            background-color: silver;
            color: white;
            text-align: center;
        }
        table {
            width: 100%;
            font-size: 20px;
            background-color: silver;
            color: black;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            border-collapse: collapse;
        }
        input, button {
            padding: 8px;
            border: 2px solid black;
            text-align: center;
            font-size: 17px;
            font-family: "Kanit", sans-serif;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            font-weight: bold;
            cursor: pointer;
            
        }
    </style>
</head>
<body dir="rtl">
    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db23";
    
    // Establish connection to database
    $con = mysqli_connect($host, $user, $pass, $db, 3306);
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            
            // Insert new student record into database
            $sql = "INSERT INTO table1 (id, name, address) VALUES ('$id', '$name', '$address')";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('تمت إضافة الطالب بنجاح.')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } elseif (isset($_POST["del"])) {
            $name = $_POST["name"];
            
            // Delete student record from database
            $sql = "DELETE FROM table1 WHERE name='$name'";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('تم حذف الطالب بنجاح.')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }
    
    // Retrieve all students from database
    $result = mysqli_query($con, "SELECT * FROM table1");
    ?>
    
    <div id="method">
        <form method="post">
            <aside>
                <img src="png-clipart.png" alt="لوجو الموقع" width="200px">
                <h3>لوحة المدير</h3>
                <label for="id">رقم الطالب:</label><br>
                <input type="text" name="id" id="id"><br>
                <label for="name">اسم الطالب:</label><br>
                <input type="text" name="name" id="name"><br>
                <label for="address">عنوان الطالب:</label><br>
                <input type="text" name="address" id="address"><br>
                <button type="submit" name="add">اضافة طالب</button>
                <button type="submit" name="del">حذف طالب</button>
            </aside>
            
            <main>
                <table id="table">
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <th>اسم الطالب</th>
                        <th>عنوان الطالب</th>
                    </tr>
                    <?php
                    // Display student records in table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </main>
        </form>
    </div>
    
    <?php
    // Close database connection
    mysqli_close($con);
    ?>
</body>
</html>
