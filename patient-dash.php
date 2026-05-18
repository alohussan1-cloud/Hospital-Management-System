<?php
require_once "conn.php";

// // -----------------------------------------------------------
// // Session guard – redirect to login if not logged in
// // -----------------------------------------------------------
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient-log.php");
    exit;
}

// // -----------------------------------------------------------
// // Fetch patient from DB
// // -----------------------------------------------------------
$id     = $_SESSION['patient_id'];
$sql    = "SELECT * FROM patient WHERE USER_ID = '$id'";
$result = mysqli_query($conn, $sql);

 $patient = mysqli_fetch_assoc($result);

// // -----------------------------------------------------------
// // Handle Edit Profile POST
// // -----------------------------------------------------------
// $editSuccess = '';
// $editError   = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_profile') {
//     $newName    = trim($_POST['fullName'] ?? '');
//     $newAddress = trim($_POST['address']  ?? '');
//     $newCity    = trim($_POST['city']     ?? '');

//     if (empty($newName) || empty($newAddress) || empty($newCity)) {
//         $editError = "All fields are required.";
//     } else {
//         $update = "UPDATE patient SET Name='$newName', Address='$newAddress', City='$newCity' WHERE id='$id'";
//         if (mysqli_query($conn, $update)) {
//             $patient['Name']    = $newName;
//             $patient['Address'] = $newAddress;
//             $patient['City']    = $newCity;
//             $editSuccess = "Profile updated successfully.";
//         } else {
//             $editError = "Update failed. Please try again.";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HMS | Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #f0f4f8;
      --card: #ffffff;
      --primary: #1a6ef5;
      --primary-dark: #1455c7;
      --primary-light: #e8f0fe;
      --text: #1e2a3a;
      --muted: #8a97a8;
      --border: #d8e2ef;
      --input-bg: #f7fafd;
      --error: #e84040;
      --success: #22c55e;
      --warning: #f59e0b;
      --shadow: 0 8px 40px rgba(26,110,245,0.08), 0 2px 8px rgba(0,0,0,0.06);
      --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
      --sidebar-w: 240px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      min-height: 100vh;
      color: var(--text);
      background-image:
        radial-gradient(ellipse at 10% 10%, rgba(26,110,245,0.05) 0%, transparent 50%),
        radial-gradient(ellipse at 90% 90%, rgba(26,110,245,0.04) 0%, transparent 50%);
    }

    /* ── Sidebar ── */
    .sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--card);
      border-right: 1.5px solid var(--border);
      display: flex;
      flex-direction: column;
      padding: 0 0 1.5rem;
      z-index: 100;
      box-shadow: 2px 0 16px rgba(26,110,245,0.05);
    }

    .sidebar-brand {
      padding: 1.5rem 1.4rem 1.2rem;
      border-bottom: 1.5px solid var(--border);
      margin-bottom: 1rem;
    }

    .sidebar-brand h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.25rem;
      color: var(--text);
      letter-spacing: -0.01em;
    }

    .sidebar-brand h1 span { color: var(--primary); }

    .sidebar-brand p {
      font-size: 0.72rem;
      color: var(--muted);
      margin-top: 2px;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      font-weight: 600;
    }

    /* Avatar */
    .sidebar-avatar {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      padding: 0.8rem 1.4rem;
      margin-bottom: 0.5rem;
    }

    .avatar-circle {
      width: 40px; height: 40px;
      border-radius: 50%;
      background: var(--primary);
      color: #fff;
      font-family: 'DM Serif Display', serif;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .avatar-info p { font-size: 0.88rem; font-weight: 600; }
    .avatar-info span { font-size: 0.74rem; color: var(--muted); }

    /* Nav */
    .sidebar-nav {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 2px;
      padding: 0 0.7rem;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.65rem 0.9rem;
      border-radius: 9px;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--muted);
      cursor: pointer;
      transition: all 0.18s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      text-decoration: none;
    }

    .nav-item:hover {
      background: var(--primary-light);
      color: var(--primary);
    }

    .nav-item.active {
      background: var(--primary-light);
      color: var(--primary);
      font-weight: 600;
    }

    .nav-item svg { flex-shrink: 0; }

    .nav-divider {
      height: 1px;
      background: var(--border);
      margin: 0.6rem 0.9rem;
    }

    .logout-btn {
      margin: 0 0.7rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.65rem 0.9rem;
      border-radius: 9px;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--error);
      cursor: pointer;
      transition: all 0.18s;
      border: none;
      background: none;
      width: calc(100% - 1.4rem);
      text-align: left;
      text-decoration: none;
    }

    .logout-btn:hover { background: #fff1f1; }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      padding: 2rem 2rem 3rem;
      min-height: 100vh;
    }

    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .topbar-left h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.6rem;
      color: var(--text);
    }

    .topbar-left p {
      font-size: 0.84rem;
      color: var(--muted);
      margin-top: 2px;
    }

    .book-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.6rem 1.3rem;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 14px rgba(26,110,245,0.25);
      text-decoration: none;
    }

    .book-btn:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }

    /* Sections */
    .section { display: none; }
    .section.active { display: block; animation: fadeIn 0.3s ease; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Stat cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 1rem;
      margin-bottom: 1.8rem;
    }

    .stat-card {
      background: var(--card);
      border-radius: 14px;
      padding: 1.2rem 1.3rem;
      box-shadow: var(--shadow-sm);
      border: 1.5px solid var(--border);
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      animation: slideUp 0.4s cubic-bezier(.22,.8,.28,1) both;
    }

    .stat-card:nth-child(2) { animation-delay: 0.05s; }
    .stat-card:nth-child(3) { animation-delay: 0.1s; }
    .stat-card:nth-child(4) { animation-delay: 0.15s; }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .stat-icon {
      width: 36px; height: 36px;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
    }

    .stat-icon.blue   { background: #e8f0fe; color: var(--primary); }
    .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-icon.amber  { background: #fffbeb; color: #d97706; }
    .stat-icon.red    { background: #fff1f1; color: var(--error); }

    .stat-value {
      font-family: 'DM Serif Display', serif;
      font-size: 1.6rem;
      color: var(--text);
      line-height: 1;
    }

    .stat-label { font-size: 0.78rem; color: var(--muted); font-weight: 500; }

    /* Cards */
    .card {
      background: var(--card);
      border-radius: 14px;
      box-shadow: var(--shadow-sm);
      border: 1.5px solid var(--border);
      overflow: hidden;
      margin-bottom: 1.2rem;
    }

    .card-head {
      padding: 1rem 1.4rem;
      border-bottom: 1.5px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-head h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 1rem;
      color: var(--text);
    }

    .badge {
      font-size: 0.72rem;
      font-weight: 600;
      padding: 0.2rem 0.6rem;
      border-radius: 20px;
    }

    .badge-blue   { background: #e8f0fe; color: var(--primary); }
    .badge-green  { background: #f0fdf4; color: #16a34a; }
    .badge-amber  { background: #fffbeb; color: #d97706; }
    .badge-red    { background: #fff1f1; color: var(--error); }

    /* Profile card */
    .profile-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
    }

    .profile-field {
      padding: 1rem 1.4rem;
      border-bottom: 1px solid var(--border);
      border-right: 1px solid var(--border);
    }

    .profile-field:nth-child(even) { border-right: none; }
    .profile-field:nth-last-child(-n+2) { border-bottom: none; }

    .profile-field label {
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      color: var(--muted);
      display: block;
      margin-bottom: 0.3rem;
    }

    .profile-field p { font-size: 0.92rem; font-weight: 500; color: var(--text); }

    /* Table */
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: var(--input-bg); }
    th {
      padding: 0.7rem 1.2rem;
      text-align: left;
      font-size: 0.74rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--muted);
    }

    td {
      padding: 0.85rem 1.2rem;
      font-size: 0.88rem;
      color: var(--text);
      border-top: 1px solid var(--border);
    }

    tr:hover td { background: var(--input-bg); }

    /* Empty state */
    .empty-state {
      padding: 3rem 1rem;
      text-align: center;
      color: var(--muted);
    }

    .empty-state svg { margin-bottom: 0.8rem; opacity: 0.4; }
    .empty-state p { font-size: 0.9rem; }

    /* Edit form */
    .edit-form { padding: 1.4rem; }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.9rem;
      margin-bottom: 0.9rem;
    }

    .form-field { display: flex; flex-direction: column; gap: 0.3rem; }

    .form-field label {
      font-size: 0.76rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--muted);
    }

    .form-field input {
      padding: 0.65rem 0.9rem;
      border: 1.5px solid var(--border);
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      color: var(--text);
      background: var(--input-bg);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-field input:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(26,110,245,0.1);
    }

    .form-field.full { grid-column: 1 / -1; }

    .save-btn {
      padding: 0.65rem 1.5rem;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      box-shadow: 0 4px 14px rgba(26,110,245,0.22);
    }

    .save-btn:hover { background: var(--primary-dark); transform: translateY(-1px); }

    /* Alert */
    .alert {
      padding: 0.7rem 1rem;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 500;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .alert-error   { background: #fff1f1; color: var(--error);  border: 1.5px solid #fcc; }
    .alert-success { background: #f0fdf4; color: #15803d;       border: 1.5px solid #bbf7d0; }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; padding: 1.2rem; }
      .profile-grid { grid-template-columns: 1fr; }
      .form-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- ══ SIDEBAR ══ -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <h1>HMS | <span>Patient</span></h1>
    <p>Health Management System</p>
  </div>

  <div class="sidebar-avatar">
    <div class="avatar-circle">
      <?= ucwords(strtolower($patient['Name'])) ?>
    </div>
    <div class="avatar-info">
      <p><?= $patient['Name'] ?></p>
      <span><?= $patient['Email'] ?></span>
    </div>
  </div>

  <nav class="sidebar-nav">
    <button class="nav-item active" onclick="showSection('overview', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
      </svg>
      Overview
    </button>

    <button class="nav-item" onclick="showSection('profile', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
      </svg>
      My Profile
    </button>

    <button class="nav-item" onclick="showSection('appointments', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.9 3 3 3.9 3 5v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V8h14v13zM7 10h5v5H7z"/>
      </svg>
      Appointments
    </button>

    <button class="nav-item" onclick="showSection('records', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
      </svg>
      Medical Records
    </button>

    <button class="nav-item" onclick="showSection('prescriptions', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M6.5 10h-2v3h-3v2h3v3h2v-3h3v-2h-3zm9.5.5c1.93 0 3.5-1.57 3.5-3.5S17.93 3.5 16 3.5 12.5 5.07 12.5 7s1.57 3.5 3.5 3.5zm-4 6c0-2.33 3.33-3.5 4-3.5s4 1.17 4 3.5V18H12v-1.5z"/>
      </svg>
      Prescriptions
    </button>

    <button class="nav-item" onclick="showSection('edit', this)">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
      </svg>
      Edit Profile
    </button>

    <div class="nav-divider"></div>
  </nav>

  <a href="logout.php" class="logout-btn">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
      <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
    </svg>
    Logout
  </a>
</aside>

<!-- ══ MAIN ══ -->
<main class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h2>Good day, <?=  $patient['Name']?> 👋</h2>
      <p><?= date('l, F j, Y') ?></p>
    </div>
    <a href="book-appointment.php" class="book-btn">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.9 3 3 3.9 3 5v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm4 12H8v-1c0-1.33 2.67-2 4-2s4 .67 4 2v1z"/>
      </svg>
      Book Appointment
    </a>
  </div>

  <!-- ── OVERVIEW ── -->
  <div id="section-overview" class="section active">
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.9 3 3 3.9 3 5v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V8h14v13zM7 10h5v5H7z"/>
          </svg>
        </div>
        <div class="stat-value">0</div>
        <div class="stat-label">Appointments</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
          </svg>
        </div>
        <div class="stat-value">0</div>
        <div class="stat-label">Medical Records</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6.5 10h-2v3h-3v2h3v3h2v-3h3v-2h-3zm9.5.5c1.93 0 3.5-1.57 3.5-3.5S17.93 3.5 16 3.5 12.5 5.07 12.5 7s1.57 3.5 3.5 3.5zm-4 6c0-2.33 3.33-3.5 4-3.5s4 1.17 4 3.5V18H12v-1.5z"/>
          </svg>
        </div>
        <div class="stat-value">0</div>
        <div class="stat-label">Prescriptions</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon red">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5 2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35z"/>
          </svg>
        </div>
        <div class="stat-value">Good</div>
        <div class="stat-label">Health Status</div>
      </div>
    </div>

    <!-- Quick profile summary -->
    <div class="card">
      <div class="card-head">
        <h3>Patient Summary</h3>
        <span class="badge badge-blue">Active</span>
      </div>
      <div class="profile-grid">
        <div class="profile-field">
          <label>Full Name</label>
          <p><?= $patient['Name'] ?></p>
        </div>
        <div class="profile-field">
          <label>Gender</label>
          <p><?= ucfirst($patient['Gender']) ?></p>
        </div>
        <div class="profile-field">
          <label>Email</label>
          <p><?= $patient['Email'] ?></p>
        </div>
        <div class="profile-field">
          <label>City</label>
          <p><?= ucfirst($patient['City']) ?></p>
        </div>
      </div>
    </div>

    <!-- Upcoming appointments preview -->
    <div class="card">
      <div class="card-head">
        <h3>Upcoming Appointments</h3>
        <a href="book-appointment.php" class="book-btn" style="font-size:0.78rem; padding:0.4rem 0.9rem;">+ Book</a>
      </div>
      <div class="empty-state">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.9 3 3 3.9 3 5v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V8h14v13z"/>
        </svg>
        <p>No upcoming appointments</p>
      </div>
    </div>
  </div>

  <!-- ── PROFILE ── -->
  <div id="section-profile" class="section">
    <div class="card">
      <div class="card-head">
        <h3>My Profile</h3>
        <span class="badge badge-green">Verified</span>
      </div>
      <div class="profile-grid">
        <div class="profile-field">
          <label>Full Name</label>
          <p><?= htmlspecialchars($patient['Name']) ?></p>
        </div>
        <div class="profile-field">
          <label>Gender</label>
          <p><?= htmlspecialchars(ucfirst($patient['Gender'])) ?></p>
        </div>
        <div class="profile-field">
          <label>Email Address</label>
          <p><?= htmlspecialchars($patient['Email']) ?></p>
        </div>
        <div class="profile-field">
          <label>City</label>
          <p><?= htmlspecialchars($patient['City']) ?></p>
        </div>
        <div class="profile-field full" style="grid-column:1/-1; border-right:none;">
          <label>Address</label>
          <p><?= htmlspecialchars($patient['Address']) ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- ── APPOINTMENTS ── -->
  <div id="section-appointments" class="section">
    <div class="card">
      <div class="card-head">
        <h3>My Appointments</h3>
        <a href="book-appointment.php" class="book-btn" style="font-size:0.78rem; padding:0.4rem 0.9rem;">+ Book New</a>
      </div>
      <div class="empty-state">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.9 3 3 3.9 3 5v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V8h14v13z"/>
        </svg>
        <p>No appointments yet. Book your first one!</p>
      </div>
    </div>
  </div>

  <!-- ── MEDICAL RECORDS ── -->
  <div id="section-records" class="section">
    <div class="card">
      <div class="card-head">
        <h3>Medical Records</h3>
        <span class="badge badge-blue">0 Records</span>
      </div>
      <div class="empty-state">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
          <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
        </svg>
        <p>No medical records on file yet.</p>
      </div>
    </div>
  </div>

  <!-- ── PRESCRIPTIONS ── -->
  <div id="section-prescriptions" class="section">
    <div class="card">
      <div class="card-head">
        <h3>Prescriptions</h3>
        <span class="badge badge-amber">0 Active</span>
      </div>
      <div class="empty-state">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
          <path d="M6.5 10h-2v3h-3v2h3v3h2v-3h3v-2h-3zm9.5.5c1.93 0 3.5-1.57 3.5-3.5S17.93 3.5 16 3.5 12.5 5.07 12.5 7s1.57 3.5 3.5 3.5z"/>
        </svg>
        <p>No prescriptions issued yet.</p>
      </div>
    </div>
  </div>

  <!-- ── EDIT PROFILE ── -->
  <div id="section-edit" class="section">
    <div class="card">
      <div class="card-head">
        <h3>Edit Profile</h3>
      </div>
      <div class="edit-form">

        <?php if ($editError): ?>
          <div class="alert alert-error"><?= htmlspecialchars($editError) ?></div>
        <?php endif; ?>
        <?php if ($editSuccess): ?>
          <div class="alert alert-success"><?= htmlspecialchars($editSuccess) ?></div>
        <?php endif; ?>

        <form method="POST" action="dashboard.php">
          <input type="hidden" name="action" value="edit_profile"/>
          <div class="form-row">
            <div class="form-field full">
              <label>Full Name</label>
              <input type="text" name="fullName" value="<?= htmlspecialchars($patient['Name']) ?>" placeholder="Full Name"/>
            </div>
            <div class="form-field full">
              <label>Address</label>
              <input type="text" name="address" value="<?= htmlspecialchars($patient['Address']) ?>" placeholder="Address"/>
            </div>
            <div class="form-field">
              <label>City</label>
              <input type="text" name="city" value="<?= htmlspecialchars($patient['City']) ?>" placeholder="City"/>
            </div>
            <div class="form-field">
              <label>Email (cannot change)</label>
              <input type="email" value="<?= htmlspecialchars($patient['Email']) ?>" disabled style="opacity:0.5; cursor:not-allowed;"/>
            </div>
          </div>
          <input type="submit" value="Save Changes" class="save-btn"/>
        </form>
      </div>
    </div>
  </div>

</main>

<script>
  function showSection(name, btn) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
    document.getElementById('section-' + name).classList.add('active');
    btn.classList.add('active');
  }

  // Auto-open edit section if there was an edit post
  <?php if ($editError || $editSuccess): ?>
    document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById('section-edit').classList.add('active');
    document.querySelectorAll('.nav-item')[5].classList.add('active');
  <?php endif; ?>
</script>

</body>
</html>