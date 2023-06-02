<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

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
            background-color: #f2f2f2;
            cursor: pointer;
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
    </style>
</head>
<body>
    <h2>Member List</h2>
    <div class="table-filter">
        <div class="entries">
            <label for="show-entries">Show:</label>
            <select id="show-entries">
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
                <th class="sortable" data-sort-dir="desc" data-sort-by="0">Member ID <span class="sort-icon">&darr;</span></th>
                <th class="sortable" data-sort-dir="desc" data-sort-by="1">Full Name <span class="sort-icon">&darr;</span></th>
                <th class="sortable" data-sort-dir="desc" data-sort-by="2">Email <span class="sort-icon">&darr;</span></th>
                <th class="sortable" data-sort-dir="desc" data-sort-by="3">Civil Status <span class="sort-icon">&darr;</span></th>
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
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
    $(document).ready(function() {
        var defaultPageSize = 10;
        var $table = $("#member-table");
        var $rows = $table.find("tbody tr");
        var $showEntries = $("#show-entries");

        // Initialize table with default page size
        showPage(1, defaultPageSize);

        $(".sortable").click(function() {
            var column = $(this).data("sort-by");
            var sortDir = $(this).data("sort-dir");
            $(".sort-icon").removeClass("up");
            $(this).find(".sort-icon").toggleClass("up");
            if (sortDir === "desc") {
                $(this).data("sort-dir", "asc");
                sortTable(column, "asc");
            } else {
                $(this).data("sort-dir", "desc");
                sortTable(column, "desc");
            }
            // Reapply pagination after sorting
            showPage(1, parseInt($showEntries.val()));
        });

        $("#search-button").click(function() {
            filterTable();
        });

        $("#search-input").keyup(function(event) {
            filterTable();
        });

        $showEntries.change(function() {
            var pageSize = parseInt($(this).val());
            showPage(1, pageSize);
        });

        function sortTable(column, direction) {
            var $tbody = $table.find("tbody");
            var rows = $tbody.find("tr").get();
            rows.sort(function(a, b) {
                var aValue = $(a).children("td").eq(column).text().toUpperCase();
                var bValue = $(b).children("td").eq(column).text().toUpperCase();
                if (direction === "asc") {
                    return aValue.localeCompare(bValue);
                } else {
                    return bValue.localeCompare(aValue);
                }
            });
            $.each(rows, function(index, row) {
                $tbody.append(row);
            });
        }

        function filterTable() {
    var input = $("#search-input").val().toUpperCase();
    var noResultsMessage = $("#no-results-message");

    var hasResults = false;
    $rows.each(function() {
        var row = $(this);
        var cells = row.find("td");
        var match = false;

        cells.each(function() {
            var cell = $(this);
            var cellText = cell.text();
            var highlightedText = cellText.replace(new RegExp(input, 'gi'), function(match) {
                return '<span class="highlight">' + match + '</span>';
            });

            if (cellText.toUpperCase().includes(input)) {
                match = true;
                cell.html(highlightedText);
            } else {
                cell.html(cellText);
            }
        });

        if (match) {
            row.show();
            hasResults = true;
        } else {
            row.hide();
        }
    });

    if (!hasResults) {
        $table.find("tbody").append('<tr id="no-results-message"><td colspan="' + $table.find("th").length + '">No results found.</td></tr>');
    } else {
        noResultsMessage.remove();
    }

    // Reapply pagination after filtering
    showPage(1, parseInt($showEntries.val()));
}


        function showPage(page, pageSize) {
            var startIndex = (page - 1) * pageSize;
            var endIndex = startIndex + pageSize;
            $rows.hide();
            $rows.slice(startIndex, endIndex).show();
        }
    });
</script>

</body>
</html>
