document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 3;
    const table = document.getElementById("productTable");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const pagination = document.getElementById("pagination");
    const pageCount = Math.ceil(rows.length / rowsPerPage);
    let currentPage = 1;

    function displayPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });
    }

    function createPaginationItem(page) {
        const li = document.createElement("li");
        li.className = `page-item ${page === currentPage ? "active" : ""}`;
        const a = document.createElement("a");
        a.className = "page-link";
        a.href = "#";
        a.textContent = page;
        a.addEventListener("click", function (e) {
            e.preventDefault();
            currentPage = page;
            updatePagination();
            displayPage(currentPage);
        });
        li.appendChild(a);
        return li;
    }

    function updatePagination() {
        pagination.innerHTML = "";
        for (let i = 1; i <= pageCount; i++) {
            pagination.appendChild(createPaginationItem(i));
        }
    }

    updatePagination();
    displayPage(currentPage);
});

