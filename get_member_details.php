<?php
require_once 'class.php';
$db = new db_class();

if (isset($_GET['mem_id'])) {
    $mem_id = $_GET['mem_id'];
    $memberData = $db->getMemberData($mem_id);

    if ($memberData) {
        echo "<div class='container'>";
        echo "<h3>Member Profile</h3>";
        
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p><strong>Member ID:</strong> " . $memberData['mem_id'] . "</p>";
        echo "<p><strong>Name:</strong> " . $memberData['firstName'] . " " . $memberData['middleName'] . " " . $memberData['lastName'];
        
        if (!empty($memberData['suffix'])) {
            echo " " . $memberData['suffix'];
        }
        
        echo "</p>";
        echo "<p><strong>Email:</strong> " . $memberData['email'] . "</p>";
        echo "<p><strong>Contact Number:</strong> " . $memberData['contactNumber'] . "</p>";
        echo "<p><strong>Age:</strong> " . $memberData['age'] . "</p>";
        echo "<p><strong>Gender:</strong> " . $memberData['gender'] . "</p>";
        echo "<p><strong>Address:</strong> " . $memberData['address'] . "</p>";
        echo "<p><strong>Zip Code:</strong> " . $memberData['zipCode'] . "</p>";
        echo "<p><strong>Birthday:</strong> " . $memberData['birthday'] . "</p>";
        echo "<p><strong>Birthplace:</strong> " . $memberData['birthplace'] . "</p>";
        echo "<p><strong>Occupation:</strong> " . $memberData['occupation'] . "</p>";
        echo "<p><strong>Nationality:</strong> " . $memberData['nationality'] . "</p>";
        echo "</div>"; // End of col-md-6

        echo "<div class='col-md-6'>";
        echo "<p><strong>Civil Status:</strong> " . $memberData['civilStatus'] . "</p>";
        echo "<p><strong>Religion:</strong> " . $memberData['religion'] . "</p>";
        echo "<p><strong>SSS No:</strong> " . $memberData['sssNo'] . "</p>";
        echo "<p><strong>GSIS No:</strong> " . $memberData['gsisNo'] . "</p>";
        echo "<p><strong>TIN No:</strong> " . $memberData['tinNo'] . "</p>";
        
        if (!empty($memberData['spouseName'])) {
            echo "<h4>Spouse Information:</h4>";
            echo "<p><strong>Name:</strong> " . $memberData['spouseName'] . "</p>";
            echo "<p><strong>Birthdate:</strong> " . $memberData['spouseBirthdate'] . "</p>";
            echo "<p><strong>Occupation:</strong> " . $memberData['spouseOccupation'] . "</p>";
            echo "<p><strong>Contact Number:</strong> " . $memberData['spouseContactNumber'] . "</p>";
        }

        echo "</div>"; // End of col-md-6
        
        echo "</div>"; // End of row

        // Assuming you have retrieved the image data from the database and stored it in $imageData
        $imageData = $memberData['image'];

        // Generate the base64 encoded image data
        $imageBase64 = base64_encode($imageData);

        echo "<div class='member-image'>";
        echo "<img src='data:image/jpeg;base64," . $imageBase64 . "' alt='Member Image'>";
        echo "</div>"; // End of member-image

        echo "</div>"; // End of container
    } else {
        // Member not found
        echo "<div class='container'>";
        echo "<h3>Member Profile</h3>";
        echo "<p>Member not found.</p>";
        echo "</div>"; // End of container
    }
} else {
    // Invalid request
    echo "<div class='container'>";
    echo "<h3>Member Profile</h3>";
    echo "<p>Invalid request.</p>";
    echo "</div>"; // End of container
}
?>
