<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['idNo'])) {
    $message = "You need to be logged in to access this page. Please log in below.";
    header("Location: Login.php?message=" . urlencode($message)); 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>CS 451R Project</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}


/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #0072bb;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
</head>

<body>

<div class="header">        
        <img src="UMKC_header_logo.png" style="width:20%;">
        <hr class="solid">
        <ul>
            <li><a href="Homepage.php">Homepage</a></li>
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.php">Application</a></li>
        
            <?php
            if (isset($_SESSION['idNo']) && $_SESSION['idNo'] != NULL) {
                echo '<li><a href="postlogin.php"> My Applications</a></li>';
                echo '<li><a href="postlogin.php">View Student Applications</a></li>';
            }
            // Check if the user is logged in
            if (isset($_SESSION['idNo']) && $_SESSION['idNo'] != NULL) {
                echo '<li><a href="logout.php" style="color: white;">' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <span style="color: #ffd30a;">Logout</span></a></li>';
            } else {
                echo '<li id="user"><a href="Login.php">Login</a></li>';
                echo '<li id="user"><a href="createAccount.html">Register</a></li>';
            }
            ?>
        
        </ul>
        
    </div>


    
    <form id="regForm" action="submit.php" method="post" enctype="multipart/form-data">
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
        <h1 id="blue">Personal Information</h1>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="First" required value="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : ''; ?>">

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last" required value="<?php echo isset($_SESSION['lastname']) ? htmlspecialchars($_SESSION['lastname']) : ''; ?>">

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="username@umsystem.edu" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">

            <label for="phoneNo">Phone Number:</label>
            <input type="tel" id="phoneNo" name="phoneNo" placeholder="(XXX) XXX-XXXX" required value="<?php echo isset($_SESSION['phoneNo']) ? htmlspecialchars($_SESSION['phoneNo']) : ''; ?>">
        </div>

        <div class="tab">
            <h1 id="blue">Academic Information</h1>
            <label for="studentID">Student ID:</label>
            <input type="number" id="studentID" name="studentID" placeholder="ID #" required>

            <label for="GPA">UMKC Cumulative GPA:</label>
            <input type="number" id="GPA"  max="4.00" step=".01" name="GPA" placeholder="(leave blank if first semester is in progress)">

            <label for="hoursCompleted">Hours Completed at UMKC:</label>
            <input type="number" id="hoursCompleted"  step="1" name="hoursCompleted" placeholder="(leave blank if first semester is in progress)">

            <label for="currentLevel">Degree Level:</label>
            <select id="currentLevel" name="currentLevel">
                <option value="BS">BS</option>
                <option value="MS">MS</option>
                <option value="PhD">PhD</option>
            </select>

            <label for="graduatingSemester">Grad Semester:</label>
            <select id="graduatingSemester" name="graduatingSemester">
                <option value="Fall">Fall</option>
                <option value="Spring">Spring</option>
            </select>

            <label for="graduatingYear">Graduating Year:</label>
            <select id="graduatingYear" name="graduatingYear">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>

            <label for="major">Current Major:</label>
            <select id="major" name="major">
                <option value="CS">CS</option>
                <option value="IT">IT</option>
                <option value="ECE">ECE</option>
                <option value="EE">EE</option>
            </select>
            
            <br>
            <label for="degree">Degree info:</label>
            <input type="text" id="degree" name="degree" placeholder="(Did you minor in anything?)">
            </select>
        </div>

        <div class="tab">           
            <h1 id="blue">Application Details</h1>
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class="col-sm">
                            <label for="applyingJob">Applying For: </label>
                        </div>
                        
                        <div class="col-sm">
                            <select id="applyingJob" name="applyingJob">
                                <option value="Grader">Grader</option>
                                <option value="Lab Instructor">Lab Instructor</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                    </div>
                    <p style="float: left; font-size: 12px; color:#2e89c2">*To apply for Lab instructor positions you must be GTA Certified</p>
                </div>
            
                <div class="col-sm">
                    <div class="row">
                        <div class="col-sm">
                            <label for="internationalStudentsCheckbox"> International Student? </label>
                        </div>
                        
                        <div class="col-sm" style="float:left">
                            <input type="checkbox" id="internationalStudentsCheckbox" name="internationalStudentsCheckbox" onclick="showhideGTA(this)">
                            </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm">
                    <div id="GTACert">
                        <label for="GTACert">Upload GTA Certification (if applicable):</label>
                        <input type="file" id="GTACert" name="GTACert">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm">
                    <div id="resume">
                        <label for="resume">Upload Resume Here (if applicable):</label>
                        <input type="file" id="resume" name="resume">
                    </div>
                </div>
            </div>

            <!--<label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" cols="50"></textarea>-->
            <br>
            <label for="serveInstructor">Courses you could serve as lab instructor or grader for (ex. CS201L/ CS5525/ ECE216):</label>
            <input type="text" id="serveInstructor" name="serveInstructor"  rows="4" cols="50" required>
            
        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                <button type="submit" id="submitBtn" style="display:none;">Submit</button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>

    <script>
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";

            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }

            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
                document.getElementById("submitBtn").style.display = "inline";
            } else {
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("submitBtn").style.display = "none";
            }

            fixStepIndicator(n);
        }

        function nextPrev(n) {
            var x = document.getElementsByClassName("tab");
            if (n == 1 && !validateForm()) return false;

            x[currentTab].style.display = "none";
            currentTab = currentTab + n;

            if (currentTab >= x.length) {
                document.getElementById("regForm").submit();
                return false;
            }

            showTab(currentTab);
        }

        function validateForm() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");

            for (i = 0; i < y.length; i++) {
                if (y[i].hasAttribute('required') && y[i].value == "") {
                    y[i].className += " invalid";
                    valid = false;
                }
}

            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }

            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }

            x[n].className += " active";
        }
    </script>
</body>
</html>
