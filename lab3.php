<?php require_once('header.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <style>
      form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      label {
        margin-top: 10px;
        margin-bottom: 5px;
      }

      input[type="email"],
      input[type="tel"],
      input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type="button"] {
        background-color: #4caf50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type="button"]:hover {
        background-color: #45a049;
      }
      #reg_form{
      	margin: 60px;
      	width: 500px;
      	margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <div id="reg_form">
    	<h2>Registration Form</h2>
	    <form id="form" action="lab3/Registrate.php" method="post">
	      <label for="email">Email:</label>
	      <input type="email" id="email" name="email" required>

	      <label for="phone">Phone Number:</label>
	      <input type="tel" id="phone" name="phone" required>

	      <label for="password">Password:</label>
	      <input type="password" id="password" name="password" required>

	      <label for="password2">Repeat Password:</label>
	      <input type="password" id="password2" name="password2" required>

	      <input type="button" value="Submit" onclick="validate()">
	      <h4 id="errors" style="color: red;"></h4>
	    </form>
    </div>
  </body>

  <script>
  	function validate() {
  	  const email =  document.getElementById("email").value;
  	  const phoneNumber = document.getElementById("phone").value;
  	  const password = document.getElementById("password").value;
  	  const repeatPassword = document.getElementById("password2").value;
  	  const errors = document.getElementById("errors");
  	  const form = document.getElementById("form");

	  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	  const phoneNumberRegex = /^\+374\d{8}$/;

	  if (email === '' || phoneNumber === '' || password === '' || repeatPassword === '') {
	    errors.innerHTML = 'Please fill in all fields.';
	    return false;
	  }

	  if (!emailRegex.test(email)) {
	     errors.innerHTML =  "Please enter a valid email address.";
	     return false;
	  }

	  if (!phoneNumberRegex.test(phoneNumber)) {
	    errors.innerHTML =  "Please enter a valid phone number in the format +374XXXXXXXX.";
	    return false;
	  }

	  if (password !== repeatPassword) {
	     errors.innerHTML =  "Passwords do not match.";
	     return false;
	  }

	  if (password.length < 8) {
	     errors.innerHTML =  "Password must be at least 8 characters long.";
	     return false;
	  }

	  if (!/[A-Z]/.test(password)) {
	     errors.innerHTML =  "Password must contain at least one uppercase letter.";
	     return false;
	  }

	  if (!/[a-z]/.test(password)) {
	     errors.innerHTML =  "Password must contain at least one lowercase letter.";
	     return false;
	  }

	  if (!/\d/.test(password)) {
	     errors.innerHTML =  "Password must contain at least one number.";
	     return false;
	  }

	  if (!/[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/.test(password)) {
	     errors.innerHTML =  "Password must contain at least one special character.";
	     return false;
	  }
	  form.submit();
	}

  </script>
</html>
