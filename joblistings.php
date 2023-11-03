<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form>
            <label for="jobType">Job Type:</label>
            <select name="jobType" id="jobType">
                <option value="">Both</option>
                <option value="Grader">Grader</option>
                <option value="Lab Instructor">Lab Instructor</option>
            </select>
            <label for="courseCode">Department:</label>
            <select name="courseCode" id="courseCode">
                <option value="">All</option>
                <option value="CS">CS</option>
                <option value="IT">IT</option>
                <option value="ECE">ECE</option>
                <option value="BSCS">BSCS</option>
            </select>
            <label for="day">Day:</label>
            <select name="day" id="day">
                <option value="">All</option>
                <option value="M">Monday</option>
                <option value="T">Tuesday</option>
                <option value="W">Wednesday</option>
                <option value="Th">Thursday</option>
                <option value="F">Friday</option>
            </select>
        </form>
        <br>
        <div id="jobListings">Job listings will be listed here...</div>
    </div>

    <script>
        function loadData() {
            const jobType = document.getElementById("jobType").value;
            const courseCode = document.getElementById("courseCode").value;
            const day = document.getElementById("day").value;

            const xhttp = new XMLHttpRequest();

            xhttp.onload = function() {
                document.getElementById("jobListings").innerHTML = this.responseText;
            }

            xhttp.open("GET", `getjoblisting.php?jobType=${jobType}&courseCode=${courseCode}&day=${day}`);
            xhttp.send();
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadData();

            document.getElementById("jobType").addEventListener("change", loadData);
            document.getElementById("courseCode").addEventListener("change", loadData);
            document.getElementById("day").addEventListener("change", loadData);
        });
    </script>
</body>

</html>
