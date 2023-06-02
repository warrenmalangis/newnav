<?php
require_once'session.php';
	require_once'class.php';
	$db=new db_class(); 

    $memberCounts = $db->getMemberGenderCounts();

// Extract the values from the returned array
$totalMembers = $memberCounts['totalMembers'];
$maleCount = $memberCounts['maleCount'];
$femaleCount = $memberCounts['femaleCount'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <title>Document</title>
<!--     
    <style>
/* Adjust the styles of the dropdown content */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff; /* Adjust to match the background color of the list container */
  min-width: 200px; /* Adjust the width as needed */
  padding: 10px;
  border: 1px solid #ccc; /* Adjust the border color and style as needed */
  border-top: none;
  z-index: 1;
}

/* Show the dropdown content when the anchor is hovered or clicked */
#members-dropdown:hover + .dropdown-content,
#members-dropdown:focus + .dropdown-content {
  display: block;
}

/* Adjust the styles of the dropdown items */
.dropdown-content a {
  display: block;
  padding: 5px 10px;
  color: #333; /* Adjust the text color of the dropdown items */
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: #f5f5f5; /* Adjust the background color when hovering over the dropdown items */
}

    </style> -->
</head>
<body>

    <div class="wrapper">
        <!--Top menu -->
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
                <div class="top_navbar_icons">
                    <a href="mem_profile.php">
                      <i class="fas fa-user"></i>
                     
                    </a>
                    <a href="#">
                      <i class="fas fa-bell"></i>
                    </a>
                    <a href="logout.php">
                      <i class="fas fa-sign-out-alt"></i>
                      <span>Exit</span>
                    </a>
                  </div>
            </div>

        </div>

        <div class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="Loan Management System">
                <h2>LOAN MANAGEMENT SYSTEM</h2>
              </div>
              <div class="profile">
    <img src="images/admin-logo.png" alt="profile_picture">

     <h5><?php echo $_SESSION['name']; ?></h5>
      <p><?php echo $_SESSION['role']; ?></p> 

</div>

        <ul>
            <li>
                <a href="#" class="active">
                    <span class="icon"><i class="fas fa-chart-line fa-fw"></i></span>
                    <span class="item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="membership_form.php" id="members-dropdown">
                  <span class="icon"><i class="fas fa-users fa-fw"></i></span>
                  <span class="item">Members</span>
                  <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
                </a>
                <div class="dropdown-content">
                  <a href="#"><i class="fas fa-user"></i> Add member</a>
                  <a href="#"><i class="fas fa-search"></i> Search members</a>
                  <a href="#"><i class="fas fa-list"></i> List members</a>
                </div>
              </li>
            <li>
                <a href="membership_form.php">
                    <span class="icon"><i class="fas fa-coins fa-fw"></i></span>
                    <span class="item">Loans</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-money-bill-wave fa-fw"></i></span>
                    <span class="item">Cashflow</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-file-alt fa-fw"></i></span>
                    <span class="item">Reports</span>
                    <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-cog fa-fw"></i></span>
                    <span class="item">Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <div class='dashboard-app'>
    <div class='dashboard-content'>
                <h2 >Member List</h2>
        <div class="container-white">
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
                   <th class="sortable" data-sort-dir="desc" data-sort-by="0">Member ID <span class="sort-icon">&uarr;</span><span class="sort-icon">&darr;</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="1">Full Name <span class="sort-icon">&uarr;</span><span class="sort-icon">&darr;</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="2">Email <span class="sort-icon">&uarr;</span><span class="sort-icon">&darr;</span></th>
<th class="sortable" data-sort-dir="desc" data-sort-by="3">Civil Status <span class="sort-icon">&uarr;</span><span class="sort-icon">&darr;</span></th>


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
                    echo "<td>" . $member['id'] . "</td>";
                    echo "<td>" . $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] . "</td>";
                    echo "<td>" . $member['email'] . "</td>";
                    echo "<td>" . $member['civilStatus'] . "</td>";
                   echo "<td><a href='get_member_details.php?mem_id=" . $member['id'] . "' class='details-button'><i class='fas fa-eye'></i> See Details</a></td>";
                    echo "</tr>";

                }
                ?>
               <tfoot>
      <tr id="no-results" style="display: none;">
        <td colspan="5">No results found.</td>
      </tr>
    </tfoot>
            </tbody>
        </table>
        <div class="table-pagination">
        <button id="previous-button" disabled>Previous</button>
        <div id="page-numbers"></div>
        <button id="next-button">Next</button>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
// Get the table element
var table = document.getElementById("member-table");

// Get all sortable column headers
var headers = table.querySelectorAll("th.sortable");

// Add click event listeners to each header
headers.forEach(function (header) {
  header.addEventListener("click", function () {
    var columnIndex = Array.prototype.indexOf.call(
      table.querySelectorAll("th.sortable"),
      header
    );
    var rows = Array.from(table.querySelectorAll("tbody tr"));

    // Toggle the sorting order (asc/desc) based on the current class
    var isAscending = header.classList.contains("asc");
    var sortIcons = header.querySelectorAll(".sort-icon");

    // Remove the sort icons from all other headers
    headers.forEach(function (otherHeader) {
      if (otherHeader !== header) {
        otherHeader.classList.remove("asc", "desc");
        var otherSortIcons = otherHeader.querySelectorAll(".sort-icon");
        otherSortIcons.forEach(function (icon) {
          icon.classList.remove("active");
        });
      }
    });

    // Toggle the sorting order and update the sort icons
    if (isAscending) {
      header.classList.remove("asc");
      header.classList.add("desc");
      sortIcons[0].classList.remove("active");
      sortIcons[1].classList.add("active");
    } else {
      header.classList.remove("desc");
      header.classList.add("asc");
      sortIcons[0].classList.add("active");
      sortIcons[1].classList.remove("active");
    }

    // Sort the rows based on the column values
    rows.sort(function (rowA, rowB) {
      var valueA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
      var valueB = rowB.cells[columnIndex].textContent.trim().toLowerCase();

      if (valueA < valueB) return isAscending ? -1 : 1;
      if (valueA > valueB) return isAscending ? 1 : -1;
      return 0;
    });

    // Reorder the rows in the table
    rows.forEach(function (row) {
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
        var defaultDisplayCount = 10; // Set the default number of displayed rows
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

        </div>
     </div>
    </div>
    <!-- Place this code just before the script tag that redirects to the dashboard -->
<div id="loading-overlay">
  <div class="spinner"></div>
</div>
  <script>
  // Add this script after the loading overlay HTML

  // Show the loading overlay when the page starts loading
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loading-overlay').style.display = 'flex';
  });

  // Hide the loading overlay after the dashboard page is fully loaded
  window.addEventListener('load', function () {
    document.getElementById('loading-overlay').style.display = 'none';
  });
</script>
  <script>
// Add this JavaScript code to the bottom of your <body> tag or in an external .js file

var hamburger = document.querySelector(".hamburger");
var body = document.querySelector("body");
var sidebar = document.querySelector(".sidebar");

hamburger.addEventListener("click", function() {
  body.classList.toggle("active");
});

window.addEventListener("resize", function() {
  if (window.innerWidth >= 992) {
    body.classList.remove("active");
  } else {
    body.classList.add("active");
  }
});

// Check initial viewport width on page load
if (window.innerWidth >= 992) {
  body.classList.remove("active");
} else {
  body.classList.add("active");
}


  </script>
<!--   <script >
// Add this JavaScript code to the bottom of your <body> tag or in an external .js file

// Get the dropdown anchor element
var dropdown = document.getElementById("members-dropdown");

// Get the dropdown content element
var dropdownContent = document.querySelector("#members-dropdown + .dropdown-content");

// Get the parent ul element
var parentList = dropdown.parentElement.parentElement;

// Get the list items after the dropdown
var listItems = Array.from(parentList.children).slice(Array.from(parentList.children).indexOf(dropdown.parentElement) + 1);

// Add click event listener to the dropdown
dropdown.addEventListener("click", function(e) {
  e.preventDefault();
  // Toggle the display of the dropdown content
  dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";

  // Position the dropdown content below the dropdown anchor
  var dropdownRect = dropdown.getBoundingClientRect();
  dropdownContent.style.left = dropdownRect.left + "px";
  dropdownContent.style.top = dropdownRect.bottom + "px";

  // Adjust the position of the following list items
  var heightDifference = dropdownContent.offsetHeight - dropdown.parentElement.offsetHeight;
  listItems.forEach(function(item) {
    item.style.transform = "translateY(" + heightDifference + "px)";
  });
});

// Close the dropdown when clicking outside of it
window.addEventListener("click", function(event) {
  if (!dropdown.contains(event.target) && event.target !== dropdownContent) {
    dropdownContent.style.display = "none";
    // Reset the position of the following list items
    listItems.forEach(function(item) {
      item.style.transform = "translateY(0)";
    });
  }
});

// Close the dropdown when resizing the window
window.addEventListener("resize", function() {
  dropdownContent.style.display = "none";
  // Reset the position of the following list items
  listItems.forEach(function(item) {
    item.style.transform = "translateY(0)";
  });
});

  </script> -->

</body>
</html>
