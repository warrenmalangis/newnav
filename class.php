<?php
require_once 'config.php';

class db_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

public function login_user($username, $password) {
    $query = $this->conn->prepare("SELECT user_id, name, password, role FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    
    if ($query->execute()) {
        $result = $query->get_result();
        $valid = $result->num_rows;
        $fetch = $result->fetch_assoc();
        
        if ($valid > 0 && password_verify($password, $fetch['password'])) {
            $_SESSION['user_id'] = isset($fetch['user_id']) ? $fetch['user_id'] : 0;
            $_SESSION['name'] = isset($fetch['name']) ? $fetch['name'] : '';
            $_SESSION['count'] = isset($valid) ? $valid : 0;
            $_SESSION['role'] = isset($fetch['role']) ? $fetch['role'] : '';

            return array(
                'user_id' => $_SESSION['user_id'],
                'name' => $_SESSION['name'],
                'count' => $_SESSION['count'],
                'role' => $_SESSION['role']
            );
        }
    }
    
    return array(
        'user_id' => 0,
        'name' => '',
        'count' => 0,
        'role' => ''
    );
}

   
    
 public function addMembership(
    $user_info, $firstName, $middleName, $lastName, $suffix, $email, $contactNumber, $age, $gender, $address, $zipCode,
    $birthday, $birthplace, $occupation, $nationality, $civilStatus, $religion, $sssNo, $gsisNo, $tinNo,
    $spouseName, $spouseBirthdate, $spouseOccupation, $spouseContactNumber, $uploadedFilePath,
    $elementary, $elementaryAddress, $elementaryYear, $secondary, $secondaryAddress, $secondaryYear,
    $tertiary, $tertiaryAddress, $tertiaryYear,
    $name1, $relationship1, $birthdate1, $name2, $relationship2, $birthdate2, $name3, $relationship3, $birthdate3
) {

    // Insert data into the members table
    $personalInfoQuery = $this->conn->prepare("
        INSERT INTO `personal_info` (
            `user_id`, `firstName`, `middleName`, `lastName`, `suffix`, `email`, `contactNumber`, `age`, `gender`, `address`, `zipCode`,
            `birthday`, `birthplace`, `occupation`, `nationality`, `civilStatus`, `religion`, `sssNo`, `gsisNo`, `tinNo`,
            `image`
            )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ") or die($this->conn->error);

    $personalInfoQuery->bind_param(
        "issssssssssssssssssss",
        $user_info, $firstName, $middleName, $lastName, $suffix, $email, $contactNumber, $age, $gender, $address, $zipCode,
        $birthday, $birthplace, $occupation, $nationality, $civilStatus, $religion, $sssNo, $gsisNo, $tinNo,
        $uploadedFilePath
    );

    // Execute the members query
    $personalInfoQuery->execute();
    $personalInfoQuery->close();

    $spouseQuery = $this->conn->prepare("
        INSERT INTO `spouse` (
            `user_id`, `spouseName`, `spouseBirthdate`, `spouseOccupation`, `spouseContactNumber`
        )
        VALUES (?, ?, ?, ?, ?)
    ") or die($this->conn->error);

    $spouseQuery->bind_param(
        "issss",
        $user_info, $spouseName, $spouseBirthdate, $spouseOccupation, $spouseContactNumber
    );

    // Execute the members query
    $spouseQuery->execute();
    $spouseQuery->close();


    // Insert data into the education table
    $primaryQuery = $this->conn->prepare("
        INSERT INTO `primary_educ` (`user_id`, `school_name`, `address`, `year_attended`)
        VALUES (?, ?, ?, ?)
    ") or die($this->conn->error);

    $primaryQuery->bind_param(
        "isss",
        $user_info, $elementary, $elementaryAddress, $elementaryYear
    );

    // Execute the education query
    $primaryQuery->execute();
    $primaryQuery->close();

    $secondaryQuery = $this->conn->prepare("
        INSERT INTO `secondary_educ` (`user_id`, `school_name`, `address`, `year_attended`)
        VALUES (?, ?, ?, ?)
    ") or die($this->conn->error);

    $secondaryQuery->bind_param(
        "isss",
        $user_info, $secondary, $secondaryAddress, $secondaryYear
    );

    // Execute the education query
    $secondaryQuery->execute();
    $secondaryQuery->close();

    $tertiaryQuery = $this->conn->prepare("
        INSERT INTO `tertiary_educ` (`user_id`, `school_name`, `address`, `year_attended`)
        VALUES (?, ?, ?, ?)
    ") or die($this->conn->error);

    $tertiaryQuery->bind_param(
        "isss",
        $user_info, $tertiary, $tertiaryAddress, $tertiaryYear
    );

    // Execute the education query
    $tertiaryQuery->execute();
    $tertiaryQuery->close();

    // Insert data into the beneficiaries table
    $beneficiariesQuery = $this->conn->prepare("
    INSERT INTO `beneficiaries` (`user_id`, `name`, `relationship`, `birthday`)
    VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?)
") or die($this->conn->error);

$beneficiariesQuery->bind_param(
    "isssisssisss",
    $user_info, $name1, $relationship1, $birthdate1,
    $user_info, $name2, $relationship2, $birthdate2,
    $user_info, $name3, $relationship3, $birthdate3
);

// Execute the beneficiaries query
$beneficiariesQuery->execute();
$beneficiariesQuery->close();


    $this->conn->close();
    return true;
}

// public function displayData($user_info) {

//     // Construct the SQL query to fetch the data
//     $sql = "SELECT *
//             FROM personal_info
//             INNER JOIN spouse ON personal_info.user_id = spouse.user_id
//             INNER JOIN primary_educ ON personal_info.user_id = primary_educ.user_id
//             INNER JOIN secondary_educ ON personal_info.user_id = secondary_educ.user_id
//             INNER JOIN tertiary_educ ON personal_info.user_id = tertiary_educ.user_id
//             INNER JOIN beneficiaries ON personal_info.user_id = beneficiaries.user_id
//             WHERE personal_info.user_id = ?";

//     $stmt = $this->conn->prepare($sql);
//     $stmt->bind_param("i", $user_info);
//     $stmt->execute();

//     // Get the result set
//     $result = $stmt->get_result();

//     // Process the fetched data
//     $data = array();
//     while ($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }

//     // Close the statement and database connection
//     $stmt->close();
//     $this->conn->close();

//     // Return the fetched data
//     return $data;
// }

public function getMembershipData($user_id) {
    $personalInfoQuery = $this->conn->prepare("SELECT * FROM `personal_info` WHERE `user_id` = ?") or die($this->conn->error);
    $personalInfoQuery->bind_param("i", $user_id);
    $personalInfoQuery->execute();
    $personalInfoResult = $personalInfoQuery->get_result();
    $personalInfo = $personalInfoResult->fetch_assoc();

    // Fetch data from the spouse table
    $spouseQuery = $this->conn->prepare("SELECT * FROM `spouse` WHERE `user_id` = ?") or die($this->conn->error);
    $spouseQuery->bind_param("i", $user_id);
    $spouseQuery->execute();
    $spouseResult = $spouseQuery->get_result();
    $spouse = $spouseResult->fetch_assoc();

    // Fetch data from the primary_educ table
    $primaryQuery = $this->conn->prepare("SELECT * FROM `primary_educ` WHERE `user_id` = ?") or die($this->conn->error);
    $primaryQuery->bind_param("i", $user_id);
    $primaryQuery->execute();
    $primaryResult = $primaryQuery->get_result();
    $primaryEduc = $primaryResult->fetch_assoc();

    // Fetch data from the secondary_educ table
    $secondaryQuery = $this->conn->prepare("SELECT * FROM `secondary_educ` WHERE `user_id` = ?") or die($this->conn->error);
    $secondaryQuery->bind_param("i", $user_id);
    $secondaryQuery->execute();
    $secondaryResult = $secondaryQuery->get_result();
    $secondaryEduc = $secondaryResult->fetch_assoc();

    // Fetch data from the tertiary_educ table
    $tertiaryQuery = $this->conn->prepare("SELECT * FROM `tertiary_educ` WHERE `user_id` = ?") or die($this->conn->error);
    $tertiaryQuery->bind_param("i", $user_id);
    $tertiaryQuery->execute();
    $tertiaryResult = $tertiaryQuery->get_result();
    $tertiaryEduc = $tertiaryResult->fetch_assoc();

    // Fetch data from the beneficiaries table
    $beneficiariesQuery = $this->conn->prepare("SELECT * FROM `beneficiaries` WHERE `user_id` = ?") or die($this->conn->error);
    $beneficiariesQuery->bind_param("i", $user_id);
    $beneficiariesQuery->execute();
    $beneficiariesResult = $beneficiariesQuery->get_result();
    $beneficiaries = array();
    while ($row = $beneficiariesResult->fetch_assoc()) {
        $beneficiaries[] = $row;
    }

    // Combine all the fetched data into an array
    $membershipData = array(
        'personalInfo' => $personalInfo,
        'spouse' => $spouse,
        'primaryEduc' => $primaryEduc,
        'secondaryEduc' => $secondaryEduc,
        'tertiaryEduc' => $tertiaryEduc,
        'beneficiaries' => $beneficiaries
    );

    // Return the membership data
    return $membershipData;
}



public function get_user_data($user_id) {
    $query = $this->conn->prepare("SELECT * FROM user_info WHERE user_id = ?");
    $query->bind_param("i", $user_id);
    
    if ($query->execute()) {
        $result = $query->get_result();
        $user_info = $result->fetch_assoc();
        
        $query = $this->conn->prepare("SELECT * FROM spouse WHERE user_id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        $spouse = $result->fetch_assoc();
        
        $query = $this->conn->prepare("SELECT * FROM primary_educ WHERE user_id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        $primary_educ = $result->fetch_assoc();
        
        $query = $this->conn->prepare("SELECT * FROM secondary_educ WHERE user_id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        $secondary_educ = $result->fetch_assoc();
        
        $query = $this->conn->prepare("SELECT * FROM tertiary_educ WHERE user_id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        $tertiary_educ = $result->fetch_assoc();
        
        $query = $this->conn->prepare("SELECT * FROM beneficiaries WHERE user_id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        $beneficiaries = $result->fetch_assoc();
        
        $user_data = [
            'user_info' => $user_info,
            'spouse' => $spouse,
            'primary_educ' => $primary_educ,
            'secondary_educ' => $secondary_educ,
            'tertiary_educ' => $tertiary_educ,
            'beneficiaries' => $beneficiaries
        ];
        
        return $user_data;
    }
    
    return null; // Return null if user data retrieval fails
}


public function getMemberGenderCounts() {
    // Assuming you have a database connection established

    // Calculate the total number of members
    $totalMembersQuery = $this->conn->query("SELECT COUNT(*) as total FROM personal_info");
    $totalMembers = $totalMembersQuery->fetch_assoc()['total'];

    // Calculate the count of males
    $maleCountQuery = $this->conn->query("SELECT COUNT(*) as males FROM personal_info WHERE gender = 'Male'");
    $maleCount = $maleCountQuery->fetch_assoc()['males'];

    // Calculate the count of females
    $femaleCountQuery = $this->conn->query("SELECT COUNT(*) as females FROM personal_info WHERE gender = 'Female'");
    $femaleCount = $femaleCountQuery->fetch_assoc()['females'];

    // Close the database connection
    $this->conn->close();

    return array(
        'totalMembers' => $totalMembers,
        'maleCount' => $maleCount,
        'femaleCount' => $femaleCount
    );
}
// public function displayMembershipDetails($userId) {
//     $query = $this->conn->prepare("SELECT * FROM members WHERE mem_id = ?") or die($this->conn->error);
//     $query->bind_param("i", $userId);
//     if ($query->execute()) {
//         $result = $query->get_result();
//         $memberDetails = $result->fetch_assoc();
//         $query->close();
//         return $memberDetails;
//     }
// }

// public function displayEducationDetails($memberId) {
//     $query = $this->conn->prepare("SELECT * FROM education WHERE mem_id = ?") or die($this->conn->error);
//     $query->bind_param("i", $memberId);
//     if ($query->execute()) {
//         $result = $query->get_result();
//         $educationDetails = $result->fetch_assoc();
//         $query->close();
//         return $educationDetails;
//     }
// }
// public function displayMembershipTable() {
//     $query = $this->conn->prepare("
//         SELECT members.mem_id AS membership_id, CONCAT(members.firstName, ' ', members.middleName, ' ', members.lastName) AS name, members.email, members.civilStatus
//         FROM members
//     ") or die($this->conn->error);

//     if ($query->execute()) {
//         $result = $query->get_result();
//         return $result;    

//         $result->close();
//     }
// }
public function getAllMembers() {
    $query = $this->conn->prepare("SELECT id, firstName, middleName, lastName, email, civilStatus FROM personal_info");
    $query->execute();
    $result = $query->get_result();
    $members = array();
    
    while ($row = $result->fetch_assoc()) {
        $fullName = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
        $row['name'] = $fullName;
        $members[] = $row;
    }
    
    $query->close();
    return $members;
}
// public function getMemberData($mem_id) {
//     $query = $this->conn->prepare("SELECT mem_id, firstName, middleName, lastName, suffix, email, contactNumber, age, gender, address, zipCode, birthday, birthplace, occupation, nationality, civilStatus, religion, sssNo, gsisNo, tinNo, spouseName, spouseBirthdate, spouseOccupation, spouseContactNumber, image FROM members WHERE mem_id = ?");
//     $query->bind_param("i", $mem_id);
//     $query->execute();
//     $result = $query->get_result();

//     if ($result->num_rows == 0) {
//         // Member not found
//         return null;
//     }

//     $memberData = $result->fetch_assoc();
//     $fullName = $memberData['firstName'] . ' ' . $memberData['middleName'] . ' ' . $memberData['lastName'];
//     $memberData['name'] = $fullName;

//     $query->close();
//     return $memberData;
// }
// public function addMemPayment($user_info, $membershipFee, $initialShare, $orNumber) {
//     $paymentDate = date("Y-m-d"); // Get current date

//     // Check if memberId exists in members table
//     $memberExists = $this->checkMemberExists($user_info);
//     if (!$memberExists) {
//         echo "Error: Invalid memberId. Member does not exist.";
//         return;
//     }

//     // Prepare the SQL statement
//     $query = $this->conn->prepare("INSERT INTO `membership_payments` (`user_id`, `membership_fee`, `initial_share`, `or_number`, `payment_date`)
//                 VALUES (?, ?, ?, ?, ?)") or die($this->conn->error);

//     // Bind the parameters to the prepared statement
//     $query->bind_param("issss", $user_info, $membershipFee, $initialShare, $orNumber, $paymentDate);

//     if ($query->execute()) {
//         echo "Payment details added successfully.";
//     } else {
//         echo "Error: " . $query->error;
//     }
// }

// private function checkMemberExists($user_info) {
//     // Prepare the SQL statement to check if memberId exists
//     $query = $this->conn->prepare("SELECT user_id FROM members WHERE mem_id = ?") or die($this->conn->error);

//     // Bind the memberId to the prepared statement
//     $query->bind_param("s", $user_info);

//     // Execute the query
//     $query->execute();

//     // Fetch the result
//     $result = $query->get_result();

//     // Check if the member exists
//     $exists = $result->num_rows > 0;

//     // Debugging
//     echo "Debug: checkMemberExists - userId: " . $user_info . ", exists: " . ($exists ? 'true' : 'false') . "<br>";

//     return $exists;
// }

}
?>
