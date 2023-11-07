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
                var major = document.getElementById("degreeSelect").value; 
                loadData(level, major);
            });

            document.getElementById("degreeSelect").addEventListener("change", function() { 
                var level = document.getElementById("levelSelect").value;
                var major = this.value;
                loadData(level, major);
            });
            
            //new osrting function to handle the headers being clicked
            const headers = document.querySelectorAll("th");
            let currentSort = {
                column: -1,
                direction: 1
            };

            function sortTable(column) {
                if (currentSort.column === column) {
                    currentSort.direction = -currentSort.direction;
                } else {
                    currentSort.column = column;
                    currentSort.direction = 1;
                }

                const table = document.getElementById("applicationTable");
                const rows = Array.from(table.getElementsByTagName("tr")).slice(1);
                const isNumeric = !isNaN(parseFloat(rows[0].getElementsByTagName("td")[column].textContent));

                rows.sort((a, b) => {
                    const aValue = isNumeric ? parseFloat(a.getElementsByTagName("td")[column].textContent) : a.getElementsByTagName("td")[column].textContent;
                    const bValue = isNumeric ? parseFloat(b.getElementsByTagName("td")[column].textContent) : b.getElementsByTagName("td")[column].textContent;
                    return aValue > bValue ? 1 : -1;
                });

                if (currentSort.direction === -1) {
                    rows.reverse();
                }

                table.tBodies[0].append(...rows);
            }

            headers.forEach((header, index) => {
                header.addEventListener("click", () => {
                    sortTable(index);
                    headers.forEach(header => header.classList.remove("sorted"));
                    header.classList.add("sorted");
                });
            });
        });
    </script>
</body>

</html>
