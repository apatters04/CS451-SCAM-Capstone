<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="filter.js"></script>
</head>
<body>
    <div class="header">        
        <h1>CSEE GTA Application</h1>
        <ul>
            <li><a href="Homepage.html">Homepage</a></li>            
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="Projectv1.html">Application</a></li>
            <li><a href="Login.html">Admin Login</a></li>
        </ul>
    </div>

    
    <div class="container">

        
        

        <?php

            if(isset($_POST['search']))
            {
                $valueToSearch = $_POST['valueToSearch'];
                // search in all table columns
                // using concat mysql function
                $query = "SELECT * FROM `activejobs` WHERE CONCAT(`jobType`, `courseCode`, `courseInstructor`, `courseDay`, `courseTime`) LIKE '%".$valueToSearch."%'";
                $search_result = filterTable($query);
                
            }
            else {
                $query = "SELECT * FROM activejobs";
                $search_result = filterTable($query);
        }

        function filterTable($query)
            {
                $connect = mysqli_connect("localhost", "root", "", "cs451r");
                $filter_Result = mysqli_query($connect, $query);
                return $filter_Result;
            }

        ?>

        <form action="joblistings.php" method="post">
        <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
        <input type="submit" name="search" value="Filter">

        <table>
            <tr>
                <th>Job Type</th>
                <th>Course</th>
                <th>Professor</th>
                <th>Days</th>
                <th>Time</th>
            </tr>
                <?php while($row = mysqli_fetch_array($query)):?>
                <tr>
                    <td><?php echo $row['jobType'];?></td>
                    <td><?php echo $row['courseCode'];?></td>
                    <td><?php echo $row['courseInstructor'];?></td>
                    <td><?php echo $row['courseDay'];?></td>
                    <td><?php echo $row['courseTime'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>
