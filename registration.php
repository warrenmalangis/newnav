<?php
include('reg_process.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:wght@400;600;900&display=swap">
  <link rel="stylesheet" href="css/reg.css">
  <style>
    .password-toggle {
      background: none;
      border: none;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <img src="logo.png" alt="" class="outside-logo">
    <div class="container">
      <form method="POST" action="reg_process.php">
        <h3 class="text-center mb-4">Loan Management System</h3>
		<?php
// Display error messages if present
if (isset($_GET['error'])) {
  $error = $_GET['error'];
  if ($error === 'birthdate') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">Please select a valid birthdate.</div>';
  } elseif ($error === 'sex') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">Please select a valid sex.</div>';
  } elseif ($error === 'password_mismatch') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">The two passwords do not match.</div>';
  } elseif ($error === 'username_exists') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">Username already exists.</div>';
  } elseif ($error === 'email_exists') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">Email already exists.</div>';
  } elseif ($error === 'name_exists') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">User with the same first name and last name already exists.</div>';
  } elseif ($error === 'registration') {
    echo '<div class="alert alert-danger" style="font-size: 12px;">Error occurred during registration. Please try again.</div>';
  }
}
?>
        <div class="form-row">
          <div class="form-group col-md-5">
          <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name"  required >
		</div>
		<div class="form-group col-md-5">
			<input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name"  required >
		</div>
		<div class="form-group col-md-2">
			<input type="text" class="form-control" id="middle-name" name="middle-name" maxlength="1"  placeholder="M." required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-8">
			<input type="text" class="form-control" id="address" name="address" placeholder="Full Address"required>
		</div>
		<div class="form-group col-md-4">
			<input type="text" class="form-control" id="username" name="username" maxlength="20" placeholder="Username"  required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<input type="tel" class="form-control" id="mobile-number" name="email" placeholder="Email"  required>
		</div>
		<div class="form-group col-md-6">
			<select id="sex" name="sex" class="form-control"  required>
				<option selected disabled>Gender</option>
				<option>Male</option>
				<option>Female</option>
			</select>
		</div>
	</div>
	<div class="form-group col-md-12 birthday-group">
		<label for="birth-date" class="label-birthday">Birthday:</label>
		<div class="form-row birthday-row">
			<div class="form-group col-md-4">
				<select class="form-control select2"id="month" name="month" required>
					<option selected disabled value="Month">Month</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<select class="form-control select2" id="day" name="day" required>
					<option selected disabled value="Day">Day</option>
					<?php for ($i = 1; $i <= 31; $i++) : ?>
					<option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= $i ?></option>
					<?php endfor; ?>
				</select>
        </div>
				<div class="form-group col-md-4">
					<select class="form-control select2" id="year" name="year" required>
						<option selected disabled value="Year">Year</option>
						<?php $currentYear = date('Y'); ?>
						<?php for ($i = $currentYear - 100; $i <= $currentYear; $i++) : ?>
						<option value="<?= $i ?>"><?= $i ?></option>
						<?php endfor; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<input type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password"  required>
				<span class="password-toggle" id="new-password-toggle">
					<i class="fas fa-eye"></i>
				</span>
			</div>
			<div class="form-group col-md-6">
				<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password"  required>
              <div class="input-group-append">
                <span class="input-group-text password-toggle" id="confirm-password-toggle">
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
          </div>
        <div class="form-group text-center">
          <button type="submit"  name="register" class="btn btn-sign-up">Sign Up</button>
        </div>
        <div class="form-group text-center">
          <small>Already a member? <a href="index.php" style="text-decoration: underline;">Sign In</a></small>
        </div>
        </div>
      </form>
    </div>
    <img src="rectangle.png" alt="" class="outside-logo-below">
  </div>
</div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

  <script>
    const newPasswordInput = document.getElementById('new-password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const newPasswordToggle = document.getElementById('new-password-toggle');
    const confirmPasswordToggle = document.getElementById('confirm-password-toggle');

    const togglePasswordVisibility = (inputField, toggleElement) => {
      const type = inputField.getAttribute('type');
      const isPasswordVisible = type === 'text';

      if (isPasswordVisible) {
        inputField.setAttribute('type', 'password');
        toggleElement.innerHTML = '<i class="fas fa-eye"></i>';
      } else {
        inputField.setAttribute('type', 'text');
        toggleElement.innerHTML = '<i class="fas fa-eye-slash"></i>';
      }
    };

    newPasswordToggle.addEventListener('click', () => {
      togglePasswordVisibility(newPasswordInput, newPasswordToggle);
    });

    confirmPasswordToggle.addEventListener('click', () => {
      togglePasswordVisibility(confirmPasswordInput, confirmPasswordToggle);
    });
  </script>
</body>
</html>
