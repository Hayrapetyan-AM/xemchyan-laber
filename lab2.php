<?php require_once('header.php'); ?>

<style>
  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #generatePassword:hover{
    cursor: pointer;
  }
  #generatePassword{
    border: 1px solid green;
    padding: 5px;
    border-radius: 10px;
  }
</style>


<form>
  <h1>Լաբորատոր աշխատանք 2.1</h1>
  <h2>Write your Password here</h2>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <label>
  	<input type="checkbox" onclick="togglePasswordVisibility()"> Show password
  </label>
</form>
<div align="center"><h3 id="passwordStatus"></h3></div>

<div style="margin-top: 40px;">
  <form>
    <h1>Լաբորատոր աշխատանք 2.2</h1>
    <h2 id="generatePassword">Click here to generate strong password</h2>
    <label for="password">Password:</label>
    <div align="center"><h3 id="randomStrongPassword"></h3></div>
  </form>
</div>

<script>
	
  const passwordInput = document.getElementById('password');

  passwordInput.addEventListener('input', () => {
    const password = passwordInput.value;
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
    
    //strong password
    if (
    		password.length > 8 		      && 
    		uppercaseRegex.test(password) &&
    		lowercaseRegex.test(password) &&
    		numberRegex.test(password) 	  &&
    		specialRegex.test(password)   
    	) 
    {
      	const strongPassword = document.getElementById("passwordStatus");
        strongPassword.style.color = "green";
      	strongPassword.innerHTML = "Your password is strong!";
    }
    //medium password
    else  if (
        password.length > 6           && 
        uppercaseRegex.test(password) &&
        lowercaseRegex.test(password) &&
        numberRegex.test(password)    &&
        specialRegex.test(password)   
      ) 
    {
        const strongPassword = document.getElementById("passwordStatus");
        strongPassword.style.color = "orange";
        strongPassword.innerHTML = "Your password is medium!";
    }
    //week password
    else 
    {
        const strongPassword = document.getElementById("passwordStatus");
        strongPassword.style.color = "red";
        strongPassword.innerHTML = "Your password is week!";
    }

  });
</script>

<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
</script>

<script>
  function generatePassword() {
    const lower = "abcdefghijklmnopqrstuvwxyz";
    const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const numbers = "0123456789";
    const symbols = "!@#$%^&*_-+=";
    const allChars = lower + upper + numbers + symbols;

    let password = "";
    password += getRandom(lower);
    password += getRandom(upper);
    password += getRandom(numbers);
    password += getRandom(symbols);

    for (let i = 0; i < 4; i++) {
      password += getRandom(allChars);
    }

    password = password
      .split("")
      .sort(function () {
        return 0.5 - Math.random();
      })
      .join("");

    return password;
  }

  function getRandom(string) {
    return string[Math.floor(Math.random() * string.length)];
  }

  const password = generatePassword();
  const randomStrongPassword = document.getElementById("randomStrongPassword");
  randomStrongPassword.style.color = "green";
  randomStrongPassword.innerHTML = password;
</script>

<script>
  const generatePasswordButton = document.getElementById("generatePassword");

  generatePasswordButton.addEventListener("click", function() {
    location.reload();
  });
</script>