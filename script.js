// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Your existing JavaScript code here
    document.getElementById('internationalStudentsCheckbox').addEventListener('change', function() {
        var description = document.querySelector('.description');
        var descriptionTextarea = document.querySelector('.description textarea');
        var GTACert = document.querySelector('.GTACert');

        if (this.checked) {
            description.style.display = 'block';
            descriptionTextarea.style.pointerEvents = 'auto'; /* Enable interactions */
            GTACert.style.display = 'block';
        } else {
            description.style.display = 'none';
            descriptionTextarea.style.pointerEvents = 'none'; /* Disable interactions */
            GTACert.style.display = 'none';
        }
    });
});
