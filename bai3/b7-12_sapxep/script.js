 // ---- Sắp xếp cột ----
  const table = document.getElementById("myTable");
  const headers = table.querySelectorAll("th.sortable");
  let sortColumn = -1;
  let sortOrder = "asc"; 

  headers.forEach((header, index) => {
    header.addEventListener("click", () => {
      if (sortColumn === index) {
        sortOrder = (sortOrder === "asc") ? "desc" : "asc";
      } else {
        sortColumn = index;
        sortOrder = "asc";
      }
      sortTable(index, sortOrder);
      headers.forEach(h => h.classList.remove("asc", "desc"));
      header.classList.add(sortOrder);
    });
  });

  function sortTable(colIndex, order) {
    const rows = Array.from(table.tBodies[0].rows);
    rows.sort((a, b) => {
      let x = a.cells[colIndex].innerText.toLowerCase();
      let y = b.cells[colIndex].innerText.toLowerCase();
      if (!isNaN(x) && !isNaN(y)) {
        x = Number(x); y = Number(y);
      }
      return order === "asc" ? x > y ? 1 : -1 : x < y ? 1 : -1;
    });
    rows.forEach(row => table.tBodies[0].appendChild(row));
  }

  // ---- Tìm kiếm + Highlight ----
  const searchBox = document.getElementById("searchBox");
  searchBox.addEventListener("input", () => {
    const keyword = searchBox.value.toLowerCase();
    const rows = table.tBodies[0].rows;

    for (let row of rows) {
      let text = row.innerText.toLowerCase();
      if (text.includes(keyword)) {
        row.style.display = "";
        highlightRow(row, keyword);
      } else {
        row.style.display = "none";
      }
    }
  });

  function highlightRow(row, keyword) {
    for (let cell of row.cells) {
      let text = cell.innerText;
      if (keyword === "") {
        cell.innerHTML = text;
        continue;
      }
      const regex = new RegExp(`(${keyword})`, "gi");
      cell.innerHTML = text.replace(regex, "<span class='highlight'>$1</span>");
    }
  }