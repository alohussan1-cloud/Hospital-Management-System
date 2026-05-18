<?php
require_once "conn.php";

$errors = []??'';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$fullName = trim($_POST['fullName'] ?? '');
$address  = trim($_POST['address']  ?? '');
$city     = trim($_POST['city']     ?? '');
$gender   = trim($_POST['gender']   ?? '');
$email    = htmlspecialchars(trim($_POST['email'])    ?? '');
$password = trim($_POST['password'] ?? '');


  if (empty($fullName)) $errors['ferror'] = "Full name is required."??'' ;
  if (empty($address))  $errors['adderror'] = "Address is required.";
  if (empty($city))     $errors['cityerror'] = "City is required.";
  if (empty($gender))   $errors['generror'] = "Please select a gender.";
  if (empty($email))    $errors['mailerror'] = "Email is required.";
  if (empty($password)) $errors['perror'] = "Password is required.";
  

  if (empty($errors)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = $conn->prepare("INSERT INTO patient(Name, Address, City, Gender, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssss", $fullName, $address, $city, $gender, $email, $password);
    
    if ($sql->execute()) {
      header("location: patient-log.php") ;
      } else {
        echo "Insertion failed";
        }
} 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HMS | Patient Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #f0f4f8;
      --card: #ffffff;
      --primary: #1a6ef5;
      --primary-dark: #1455c7;
      --text: #1e2a3a;
      --muted: #8a97a8;
      --border: #d8e2ef;
      --input-bg: #f7fafd;
      --error: #e84040;
      --success: #22c55e;
      --shadow: 0 8px 40px rgba(26,110,245,0.08), 0 2px 8px rgba(0,0,0,0.06);
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
      background-image:
        radial-gradient(ellipse at 20% 20%, rgba(26,110,245,0.07) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 80%, rgba(26,110,245,0.05) 0%, transparent 60%);
    }

    h1.page-title {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(1.6rem, 3vw, 2.2rem);
      color: var(--text);
      margin-bottom: 1.5rem;
      letter-spacing: -0.01em;
      text-align: center;
    }

    h1.page-title span {
      color: var(--primary);
    }

    .card {
      background: var(--card);
      border-radius: 18px;
      box-shadow: var(--shadow);
      padding: 2.5rem 2.2rem 2rem;
      width: 100%;
      max-width: 520px;
      animation: slideUp 0.5s cubic-bezier(.22,.8,.28,1) both;
    }
    span{
      color:red;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .card-header {
      border-bottom: 2px solid var(--primary);
      padding-bottom: 0.6rem;
      margin-bottom: 1.4rem;
    }

    .card-header h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.3rem;
      color: var(--primary);
      letter-spacing: 0.01em;
    }

    .section-label {
      font-size: 0.78rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.9rem;
      margin-top: 1.4rem;
    }

    .field-group {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap .icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.95rem;
      pointer-events: none;
      display: flex;
      align-items: center;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.7rem 1rem;
      border: 1.5px solid var(--border);
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.93rem;
      color: var(--text);
      background: var(--input-bg);
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
      outline: none;
    }

    .has-icon input {
      padding-left: 2.4rem;
    }

    input::placeholder { color: var(--muted); }

    input:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(26,110,245,0.12);
    }

    input.error {
      border-color: var(--error);
      box-shadow: 0 0 0 3px rgba(232,64,64,0.1);
    }

    .field-error {
      font-size: 0.75rem;
      color: var(--error);
      margin-top: 2px;
      padding-left: 2px;
      display: none;
    }

    /* Gender */
    .gender-section { margin-top: 1rem; }

    .gender-label-text {
      font-size: 0.78rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.65rem;
    }

    .gender-options {
      display: flex;
      gap: 1.2rem;
    }

    .gender-option {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      cursor: pointer;
      font-size: 0.92rem;
      color: var(--text);
      font-weight: 500;
    }

    .gender-option input[type="radio"] {
      appearance: none;
      width: 18px;
      height: 18px;
      border: 2px solid var(--border);
      border-radius: 50%;
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      position: relative;
      flex-shrink: 0;
    }

    .gender-option input[type="radio"]:checked {
      border-color: var(--primary);
      background: var(--primary);
      box-shadow: inset 0 0 0 3px #fff;
    }

    /* Agree checkbox */
    .agree-row {
      display: flex;
      align-items: center;
      gap: 0.55rem;
      margin-top: 1.3rem;
    }

    .agree-row input[type="checkbox"] {
      appearance: none;
      width: 19px;
      height: 19px;
      border: 2px solid var(--border);
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.18s;
      position: relative;
      flex-shrink: 0;
      background: var(--input-bg);
    }

    .agree-row input[type="checkbox"]:checked {
      background: var(--primary);
      border-color: var(--primary);
    }

    .agree-row input[type="checkbox"]:checked::after {
      content: '';
      position: absolute;
      left: 4px;
      top: 1px;
      width: 7px;
      height: 11px;
      border: 2.5px solid #fff;
      border-top: none;
      border-left: none;
      transform: rotate(45deg);
    }

    .agree-row label {
      font-size: 0.9rem;
      color: var(--text);
      cursor: pointer;
      font-weight: 400;
    }

    /* Bottom row */
    .form-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 1.5rem;
      flex-wrap: wrap;
      gap: 0.8rem;
    }

    .login-link {
      font-size: 0.87rem;
      color: var(--muted);
    }

    .login-link a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .login-link a:hover { color: var(--primary-dark); }

    .submit-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.65rem 1.6rem;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 16px rgba(26,110,245,0.25);
    }

    .submit-btn:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(26,110,245,0.35);
    }

    .submit-btn:active { transform: translateY(0); }

    .submit-btn svg { width: 17px; height: 17px; }

    /* Footer */
    .site-footer {
      margin-top: 1.6rem;
      font-size: 0.78rem;
      color: var(--muted);
      text-align: center;
    }

    .site-footer strong { color: var(--text); }

    /* Success toast */
    .toast {
      position: fixed;
      top: 1.5rem;
      right: 1.5rem;
      background: var(--success);
      color: #fff;
      padding: 0.8rem 1.4rem;
      border-radius: 10px;
      font-size: 0.9rem;
      font-weight: 600;
      box-shadow: 0 4px 20px rgba(34,197,94,0.3);
      transform: translateY(-80px);
      opacity: 0;
      transition: all 0.4s cubic-bezier(.22,.8,.28,1);
      z-index: 100;
    }

    .toast.show { transform: translateY(0); opacity: 1; }
  </style>
</head>
<body>

  <h1 class="page-title">HMS | <span>Patient Registration</span></h1>

  <div class="card">
    <div class="card-header">
      <h2>Sign Up</h2>
    </div>

    <p class="section-label">Personal Details</p>
    <form  method="POST">
        <div class="field-group">
            <div class="input-wrap">
                <input type="text" id="fullName" name="fullName" placeholder="Full Name" autocomplete="name"/>
                <span><?php echo  $errors['ferror']??"" ?></span>
                <div class="field-error" id="fullName-err">Please enter your full name.</div>
            </div>
  
            <div class="input-wrap">
                <input type="text" id="address" name="address" placeholder="Address" autocomplete="street-address"/>
                <span><?php echo  $errors['adderror']??"" ?></span>
                <div class="field-error" id="address-err">Please enter your address.</div>
            </div>
            
            <div class="input-wrap">
                <input type="text" id="city" name="city" placeholder="City" autocomplete="address-level2"/>
                <span><?php echo  $errors['cityerror']??"" ?></span>
                <div class="field-error" id="city-err">Please enter your city.</div>
            </div>
    </div>
    
    <div class="gender-section">
        <div class="gender-label-text">Gender</div>
        <div class="gender-options">
            <label class="gender-option">
                <input type="radio" name="gender" value="female"/> Female
            </label>
            <label class="gender-option">
                <input type="radio" name="gender" value="male"/> Male
            </label>
            <span><?php echo  $errors['generror']??"" ?></span>
        </div>
        <div class="field-error" id="gender-err">Please select your gender.</div>
    </div>
    
    <p class="section-label" style="margin-top:1.5rem;">Account Details</p>
    
    <div class="field-group">
        <div class="input-wrap has-icon">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
        </svg>
        </span>
        <input type="email" id="email" name="email" placeholder="Email" autocomplete="email"/>
        <span><?php echo $errors['mailerror'] ??"" ?></span>
        <div class="field-error" id="email-err">Please enter a valid email.</div>
    </div>
    
    <div class="input-wrap has-icon">
        <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
          </svg>
        </span>
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="new-password"/>
        <span><?php echo   $errors['perror']??"" ?></span>
        <div class="field-error" id="password-err">Password must be at least 6 characters.</div>
    </div>
    
    <div class="agree-row">
        <input type="checkbox" id="agree" checked/>
      <label for="agree">I agree to the terms and conditions</label>
    </div>
    <div class="field-error" id="agree-err">You must agree to continue.</div>
    
    <div class="form-footer">
        <p class="login-link">Already have an account? <a href="patient-log.php">Log-in</a></p>
        <input type="submit" name="submit" value="Submit" class="submit-btn">
    </div>
</div>
</form>

  <p class="site-footer">© 2022 <strong>HMS</strong>. All rights reserved</p>

  <div class="toast" id="toast">✓ Registration successful!</div>

</body>
</html>