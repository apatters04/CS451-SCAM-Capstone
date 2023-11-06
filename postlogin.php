<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">        
        <h1>CSEE GTA Admin Application View</h1>
        <ul>
            <li><a href="Homepage.html">Homepage</a></li>            
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.html">Application</a></li>
            <li><a href="Login.html">Admin Login</a></li>
        </ul>
    </div>

    <form>
        <select name="level" id="levelSelect">
            <option value="">Select a level:</option>
            <option value="BS">BS</option>
            <option value="MS">MS</option>
            <option value="PhD">PhD</option>
        </select>
        <select name="degree" id="degreeSelect">
            <option value="">Select a major:</option>
            <option value="CS">CS</option>
            <option value="IT">IT</option>
            <option value="ECE">ECE</option>
            <option value="BSCS">BSCS</option>
        </select>
    </form>
    <br>
    <div id="txtHint">Application info will be listed here...</div>

    <script>
        function loadData(level, major) {
            const xhttp = new XMLHttpRequest();

            xhttp.onload = function() {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }

            xhttp.open("GET", "getapplication.php?level=" + level + "&major=" + major);
            xhttp.send();
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadData('', '');
            
            document.getElementById("levelSelect").addEventListener("change", function() {
                var level = this.value;
                var major = document.getElementById("degreeSelect").value; // Changed to "degreeSelect"
                loadData(level, major);
            });

            document.getElementById("degreeSelect").addEventListener("change", function() { // Changed to "degreeSelect"
                var level = document.getElementById("levelSelect").value;
                var major = this.value;
                loadData(level, major);
            });
        });
    </script>
    #git test 
</body>

</html>
