<?php
session_start();
require_once "conn.php";

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "Both email and password are required.";
    } else {
        $sql    = "SELECT * FROM patient WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) >1) {
            $patient = mysqli_fetch_assoc($result);

            if (password_verify($password, $patient['Password'])) {
                $_SESSION['patient_id'] = $patient['USER_ID'];
                header("Location: ./patient-dash.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HMS | Login</title>
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

    h1.page-title span { color: var(--primary); }

    .card {
      background: var(--card);
      border-radius: 18px;
      box-shadow: var(--shadow);
      padding: 2.5rem 2.2rem 2rem;
      width: 100%;
      max-width: 460px;
      animation: slideUp 0.5s cubic-bezier(.22,.8,.28,1) both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .card-header {
      border-bottom: 2px solid var(--primary);
      padding-bottom: 0.6rem;
      margin-bottom: 1.6rem;
    }

    .card-header h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.3rem;
      color: var(--primary);
      letter-spacing: 0.01em;
    }

    .card-header p {
      font-size: 0.83rem;
      color: var(--muted);
      margin-top: 0.3rem;
    }

    /* Alert boxes */
    .alert {
      padding: 0.75rem 1rem;
      border-radius: 9px;
      font-size: 0.88rem;
      font-weight: 500;
      margin-bottom: 1.2rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .alert-error {
      background: #fff1f1;
      color: var(--error);
      border: 1.5px solid #fcc;
    }

    .alert-success {
      background: #f0fdf4;
      color: #15803d;
      border: 1.5px solid #bbf7d0;
    }

    /* Fields */
    .field-group {
      display: flex;
      flex-direction: column;
      gap: 0.85rem;
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
      pointer-events: none;
      display: flex;
      align-items: center;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border: 1.5px solid var(--border);
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.93rem;
      color: var(--text);
      background: var(--input-bg);
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
      outline: none;
    }

    input::placeholder { color: var(--muted); }

    input:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(26,110,245,0.12);
    }

    /* Show/hide password toggle */
    .toggle-pw {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--muted);
      display: flex;
      align-items: center;
      padding: 2px;
      transition: color 0.2s;
    }

    .toggle-pw:hover { color: var(--primary); }

    /* Forgot password */
    .forgot-row {
      text-align: right;
      margin-top: 0.3rem;
    }

    .forgot-row a {
      font-size: 0.82rem;
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }

    .forgot-row a:hover { color: var(--primary-dark); }

    /* Submit */
    .submit-btn {
      width: 100%;
      margin-top: 1.4rem;
      padding: 0.78rem 1.6rem;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.97rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 16px rgba(26,110,245,0.25);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Cpath d='M12 8l4 4-4 4M8 12h8'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1.2rem center;
      background-size: 17px 17px;
    }

    .submit-btn:hover {
      background-color: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(26,110,245,0.35);
    }

    .submit-btn:active { transform: translateY(0); }

    /* Register link */
    .register-link {
      text-align: center;
      margin-top: 1.4rem;
      font-size: 0.87rem;
      color: var(--muted);
    }

    .register-link a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .register-link a:hover { color: var(--primary-dark); }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin: 1.3rem 0 0;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .divider span {
      font-size: 0.78rem;
      color: var(--muted);
      white-space: nowrap;
    }

    /* Footer */
    .site-footer {
      margin-top: 1.6rem;
      font-size: 0.78rem;
      color: var(--muted);
      text-align: center;
    }

    .site-footer strong { color: var(--text); }
  </style>
</head>
<body>

  <h1 class="page-title">HMS | <span>Patient Login</span></h1>

  <div class="card">
    <div class="card-header">
      <h2>Log In</h2>
      <p>Enter your credentials to access your account</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
        </svg>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm-1 14.41-3.7-3.7 1.41-1.42L11 13.59l4.29-4.3 1.41 1.42L11 16.41z"/>
        </svg>
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <form method="POST" >
      <div class="field-group">

        <div class="input-wrap">
          <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
              <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </span>
          <input type="email" name="email" placeholder="Email address" autocomplete="email">
        </div>

        <div>
          <div class="input-wrap">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
              </svg>
            </span>
            <input type="password" name="password" id="passwordField" placeholder="Password" autocomplete="current-password"/>
            <button type="button" class="toggle-pw" onclick="togglePassword()" title="Show/hide password">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
              </svg>
            </button>
          </div>
          <div class="forgot-row">
            <a href="#">Forgot password?</a>
          </div>
        </div>

      </div>

      <input type="submit" value="Log In" class="submit-btn"/>
    </form>

    <div class="divider"><span>don't have an account?</span></div>

    <p class="register-link"><a href="patient-reg.php">Create an account</a></p>
  </div>

  <p class="site-footer">© 2022 <strong>HMS</strong>. All rights reserved</p>
<script>
  
</script>
</body>
</html>