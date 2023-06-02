<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Member List</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .table-filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .entries {
            display: flex;
            align-items: center;
        }

        .entries label {
            margin-right: 5px;
        }

        .entries select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            margin-right: 5px;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type=text] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            margin-right: 5px;
        }

        .search-container button {
            padding: 5px 10px;
            background: #ddd;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .search-container button:hover {
            background: #ccc;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid grey;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #7ddcd9;
            cursor: pointer;
            font-weight: normal;
        }

        .details-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .eye-icon {
            vertical-align: middle;
            margin-right: 5px;
        }

        .sort-icon {
            margin-left: 5px;
            font-weight: normal;
        }

        .sort-icon.up {
            font-weight: bold;
            transform: rotate(180deg);
        }

        /* Center text in the "Full Name" column */
        td:nth-child(1) {
            text-align: center;
        }

        .highlight {
            background-color: yellow;
        }
        .pagination button {
            padding: 5px 10px;
            background: #ddd;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 5px;
        }

        .table-pagination {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 20px;
}

.page-number {
    padding: 5px 10px;
    background: #ddd;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    margin-right: 5px;
}

.page-number.active {
    background: #7ddcd9;
    color: white;
}

#previous-button,
#next-button {
    padding: 5px 10px;
    background: #ddd;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    margin-right: 5px;
}

#previous-button:hover,
#next-button:hover {
    background: #ccc;
}

#no-results {
    display: none;
    margin-top: 10px;
    color: red;
}

    </style>
</head>
<body>
    <h2>Member List</h2>
    <div class="table-filter">
        <div class="entries">
            <label for="show-entries">Show:</label>
            <select id="show-entries">
                <option value="1">1</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
            <span>entries</span>
        </div>
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Search..." onkeyup="filterTable()">
            <button type="button" id="search-button"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <table id="member-table">
        <thead>
            <tr>
                <th class="sortable" data-sort-dir="desc" data-sort-by="0">Member ID <span class="sort-icon">▾</span><span class="sort-icon">▴</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="1">Full Name <span class="sort-icon">▾</span><span class="sort-icon">▴</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="2">Email <span class="sort-icon">▾</span><span class="sort-icon">▴</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="3">Civil Status <span class="sort-icon">▾</span><span class="sort-icon">▴</span></th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'class.php';
            $db = new db_class();
            $members = $db->getAllMembers();

            foreach ($members as $member) {
                echo "<tr>";
                echo "<td>" . $member['mem_id'] . "</td>";
                echo "<td>" . $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] . "</td>";
                echo "<td>" . $member['email'] . "</td>";
                echo "<td>" . $member['civilStatus'] . "</td>";
                echo "<td><a href='member_details.php?mem_id=" . $member['mem_id'] . "' class='details-button'><i class='fas fa-eye'></i> See Details</a></td>";
                echo "</tr>";
            }
            ?>
            <div id="no-results">
    No results found.
</div>
        </tbody>
    </table>
     <div class="table-pagination">
        <button id="previous-button" disabled>Previous</button>
        <div id="page-numbers"></div>
        <button id="next-button">Next</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
  // Get the table element
  var table = document.getElementById("member-table");

  // Get all sortable column headers
  var headers = table.querySelectorAll("th.sortable");

  // Add click event listeners to each header
  headers.forEach(function(header) {
    header.addEventListener("click", function() {
      var columnIndex = Array.prototype.indexOf.call(table.querySelectorAll("th.sortable"), header);
      var rows = Array.from(table.querySelectorAll("tbody tr"));

      // Toggle the sorting order (asc/desc) based on the current class
      var isAscending = header.classList.contains("asc");
      header.classList.toggle("asc", !isAscending);
      header.classList.toggle("desc", isAscending);

      // Remove the sort classes from all other headers
      headers.forEach(function(otherHeader) {
        if (otherHeader !== header) {
          otherHeader.classList.remove("asc", "desc");
          otherHeader.innerHTML = otherHeader.textContent;
        }
      });

      // Update the arrow indicator
      header.innerHTML = header.textContent + (isAscending ? "&#9650;" : "&#9660;");

      // Sort the rows based on the column values
      rows.sort(function(rowA, rowB) {
        var valueA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
        var valueB = rowB.cells[columnIndex].textContent.trim().toLowerCase();

        if (valueA < valueB) return isAscending ? -1 : 1;
        if (valueA > valueB) return isAscending ? 1 : -1;
        return 0;
      });

      // Reorder the rows in the table
      rows.forEach(function(row) {
        table.querySelector("tbody").appendChild(row);
      });
    });
  });
</script>


    <script>
    // Get the search input element
    var searchInput = document.getElementById("search-input");

    // Get the table rows
    var rows = Array.from(document.querySelectorAll("#member-table tbody tr"));

    // Get the no results message element
    var noResultsMessage = document.getElementById("no-results");

    // Function to filter and display the search results
    function filterRows() {
        var searchTerm = searchInput.value.trim().toLowerCase();

        // Filter the rows based on the search term
        var filteredRows = rows.filter(function(row) {
            var rowData = Array.from(row.querySelectorAll("td")).map(function(cell) {
                return cell.textContent.trim().toLowerCase();
            });

            return rowData.some(function(data) {
                return data.includes(searchTerm);
            });
        });

        // Hide all rows
        rows.forEach(function(row) {
            row.style.display = "none";
        });

        // Display the filtered rows or show no results message
        if (filteredRows.length > 0) {
            filteredRows.forEach(function(row) {
                row.style.display = "";
            });
            noResultsMessage.style.display = "none";
        } else {
            noResultsMessage.style.display = "block";
        }
    }

    // Add event listener to the search input
    searchInput.addEventListener("input", filterRows);
</script>

  <script>
    $(document).ready(function() {
        var defaultDisplayCount = 1; // Set the default number of displayed rows
        var displayCount = defaultDisplayCount; // Initialize the display count variable
        var currentPage = 0; // Current page index
        var totalPages = Math.ceil($("#member-table tbody tr").length / displayCount); // Total number of pages

        // Function to update pagination buttons
        function updatePaginationButtons() {
            var $previousButton = $("#previous-button");
            var $nextButton = $("#next-button");
            var $pageNumbers = $("#page-numbers");

            // Clear the page numbers
            $pageNumbers.empty();

            // Create page number buttons
            for (var i = 0; i < totalPages; i++) {
                var $pageNumberButton = $("<button>", {
                    text: i + 1,
                    class: "page-number",
                    click: function() {
                        currentPage = $(this).text() - 1;
                        filterTable();
                        window.history.pushState(null, "", "?page=" + (currentPage + 1));
                    }
                });
                if (i === currentPage) {
                    $pageNumberButton.addClass("active");
                }
                $pageNumbers.append($pageNumberButton);
            }

            // Hide/Show previous and next buttons based on current page and available rows
            if (currentPage === 0) {
                $previousButton.hide();
            } else {
                $previousButton.show();
            }

            if (currentPage === totalPages - 1 || $("#member-table tbody tr:visible").length === 0) {
                $nextButton.hide();
            } else {
                $nextButton.show();
            }
        }

        // Function to filter and display rows based on current page and display count
        function filterTable() {
            var $rows = $("#member-table tbody tr");
            var $noResults = $("#no-results");
            var $searchInput = $("#search-input");
            var startIndex = currentPage * displayCount;
            var endIndex = startIndex + displayCount;
            var searchTerm = $searchInput.val().toLowerCase();

            $rows.hide();

            // Check if search term is provided
            if (searchTerm) {
                var $matchingRows = $rows.filter(function() {
                    var rowData = $(this).text().toLowerCase();
                    return rowData.indexOf(searchTerm) > -1;
                });

                // Display no results message if there are no matching rows
                if ($matchingRows.length === 0) {
                    $noResults.show();
                } else {
                    $noResults.hide();
                    $matchingRows.slice(startIndex, endIndex).show();
                }
            } else {
                $noResults.hide();
                $rows.slice(startIndex, endIndex).show();
            }

            updatePaginationButtons();
        }

        // Set the default display count
        $("#show-entries").val(defaultDisplayCount);

        // Event handlers for display count change, "Previous" button, "Next" button, and search button
        $("#show-entries").change(function() {
            displayCount = parseInt($(this).val());
            currentPage = 0;
            totalPages = Math.ceil($("#member-table tbody tr").length / displayCount);
            filterTable();
            window.history.pushState(null, "", "?page=1");
        });

        $("#previous-button").click(function() {
            if (currentPage > 0) {
                currentPage--;
                filterTable();
                window.history.pushState(null, "", "?page=" + (currentPage + 1));
            }
        });

        $("#next-button").click(function() {
            if (currentPage < totalPages - 1) {
                currentPage++;
                filterTable();
                window.history.pushState(null, "", "?page=" + (currentPage + 1));
            }
        });

        $("#search-button").click(function() {
            filterTable();
        });

        $("#search-input").keyup(function(event) {
            filterTable();
        });

        // Get the page number from the URL and set the current page accordingly
        var urlParams = new URLSearchParams(window.location.search);
        var page = parseInt(urlParams.get("page"));
        if (!isNaN(page) && page >= 1 && page <= totalPages) {
            currentPage = page - 1;
            filterTable();
        } else {
            window.history.pushState(null, "", "?page=1");
        }
    });
</script>


</body>
</html>