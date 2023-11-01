$(document).ready(function() {
    // Function to apply filters
    function applyFilters() {
        var levelFilter = $("#currentLevel").val();
        var majorFilter = $("#major").val();
        var semesterFilter = $("#graduatingSemester").val();
        var yearFilter = $("#graduatingYear").val();

        $("#applicationTable tbody tr").hide();

        $("#applicationTable tbody tr").each(function() {
            var level = $(this).find("td:eq(5)").text();
            var major = $(this).find("td:eq(11)").text();
            var semester = $(this).find("td:eq(6)").text();
            var year = $(this).find("td:eq(7)").text();

            if ((levelFilter === '' || level === levelFilter) &&
                (majorFilter === '' || major === majorFilter) &&
                (semesterFilter === '' || semester === semesterFilter) &&
                (yearFilter === '' || year === yearFilter)) {
                $(this).show();
            }
        });
    }

    // Event handlers for filter elements
    $("#currentLevel, #major, #graduatingSemester, #graduatingYear").on("change", applyFilters);
});

function search_Jobs($_POST){
    $by_type = $_POST['jobType'];
    $by_code = $_POST['courseCode'];
    $by_prof = $_POST['courseInstructor'];
    $by_day = $_POST['courseDay'];
    $by_time = $_POST['courseTime'];
}