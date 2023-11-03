function applyFilters() {
    var form = document.getElementById('filterForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                document.getElementById('filteredResults').innerHTML = xhr.responseText;
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };

    xhr.open('POST', 'filter.php', true);
    xhr.send(formData);
}
