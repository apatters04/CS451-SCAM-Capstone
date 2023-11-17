// dropdownmenu.js

// Function to toggle the dropdown
function toggleDropdown() {
    var dropdown = document.getElementById("accountDropdown");
    dropdown.classList.toggle("show");
}

document.addEventListener("DOMContentLoaded", function () {
    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.account-icon')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };
});
