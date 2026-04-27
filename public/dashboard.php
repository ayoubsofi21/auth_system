<?php
session_start();
include("../scripts/database.php");

if(!isset($_SESSION['name'])) {
  header("Location: ../public/login.php");
  exit();
}
  $name = $_SESSION['name'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Elmwood Academy — Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Segoe UI', system-ui, sans-serif; }
    .bar-fill { transition: width 0.6s ease; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-56 flex-shrink-0 bg-white border-r border-gray-100 flex flex-col py-6">
    <div class="px-5 pb-5 border-b border-gray-100">
      <div class="text-sm font-semibold text-gray-900">Elmwood Academy</div>
      <div class="text-xs text-gray-400 mt-0.5">Student Portal</div>
    </div>

    <nav class="flex-1 px-3 py-4 flex flex-col gap-0.5">
      <button onclick="setActive(this)" class="nav-item active flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/>
          <rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/>
        </svg>
        Overview
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M2 3h12M2 8h12M2 13h8"/>
        </svg>
        Assignments
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="2" y="2" width="12" height="12" rx="1.5"/>
          <path d="M5 2v12M2 6h3M2 10h3"/>
        </svg>
        Schedule
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
        </svg>
        Teachers
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M8 1l2 4 5 .7-3.5 3.4.8 4.9L8 12l-4.3 2 .8-4.9L1 5.7 6 5z"/>
        </svg>
        Grades
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M2 13V6l6-4 6 4v7H2z"/><rect x="6" y="8" width="4" height="5" rx="0.5"/>
        </svg>
        Library
      </button>
    </nav>

    <!-- Logout Button -->
    <div class="px-3">
        <form action="../scripts/logout.php" method="post">

            <button name="logout"  class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 border border-red-200 hover:bg-red-50 w-full text-left transition-colors">
              <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 14H3a1 1 0 01-1-1V3a1 1 0 011-1h3M10 11l3-3-3-3M13 8H6"/>
              </svg>
              Log out
            </button>

        </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col overflow-auto">

    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-100 px-6 h-14 flex items-center justify-between flex-shrink-0">
      <div class="flex items-center justify-center">
        
        <span class="text-2xl font-medium text-gray-900">Good morning, <?php 
        

        echo $name;
  
        ?> 
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 128 128"><path fill="#307d31" d="m56.81 85.29l21.86.17s-1.74 5.65-3.18 7.87c-2.35 3.6-3.52 5.44-4.52 9.13c-1.55 5.68-1.42 10.05-1.42 10.05s1.21-.42 2.68 0c1.79.51 2.76 1.7 2.6 2.43c-.15.65-2.14.21-3.52 1.59c-1.09 1.09-1.51 3.02-1.68 4.27c-.17 1.26-.34 2.85-2.68 3.18c-2.35.34-5.86.59-6.62-.59c-.75-1.17-.34-21.61-.34-21.61z"/><path fill="#5c9823" d="M56.56 80.76c-.42.75-10.32 2.53-10.32 2.53s-3.31 1.77-4.56 7.55c-.68 3.13-.53 9.47-1.12 11.69c-.84 3.18-4.36 5.03-4.19 5.78s3.24.7 5.61-.34c5.36-2.35 6.3-7.21 8.04-11.39c1.68-4.02 4.86-6.13 4.86-6.13s-.75 2.92-.43 6.14c.27 2.77 1.14 6.3 0 9.73c-1.09 3.27-2.62 5.24-2.01 5.54c.46.22 5.92-.33 8.1-5.11c2.41-5.28 2.58-9.61 4.02-12.71c1.59-3.43 4.62-4.89 4.62-4.89s2.15 1.26 4.78 4.94c2.93 4.1 5.38 7.55 6.96 9.67c3.7 4.98 8.83 6.55 8.99 5.71c.25-1.34-2.47-3.49-3.02-6.11c-1.35-6.45.5-9.54-1.03-14.49c-2.2-7.15-7.39-7.28-9.19-7.62c-.42-.06-20.11-.49-20.11-.49"/><path fill="#96010c" d="M47.31 44.34c-1.13-1.01-17.87-13.21-17.87-13.21l-.25-7.42s-4.1-7.75.62-13.52c4.1-5.01 9.57-3.59 9.57-3.59s2.74-3.45 7.52-3.69c6.11-.31 9.09 4.83 9.09 4.83l27.55 4.53l15.47 10.06s2.29-.74 4.19.6c1.98 1.39 1.33 4.31 1.11 5.62c-.21 1.25-20.65 17.56-20.65 17.56l2.14 31.96l-7.14 7.97s-1 .98-3.05 1.24c-1.19.15-2.72-.33-2.72-.33l-4.45-12.78z"/><path fill="#af0c1b" d="m83.15 6.86l-3.72.28l-2.61 2.19l.93 4.21s.12 3.15-2.36 4.66s-7.35 3.99-7.35 3.99l-3.36 5.56s-2.16-.71-5.68-2.52c-3.29-1.7-7.5-5.58-7.5-5.58l-7.53-.51s-1.44-.13-2.65 1.15c-1.74 1.86-1.12 5.8 2.29 9.41c3.28 3.47 10.38 7.7 11.96 8.87s3.99 2.67 5.36 3.44c1.32.74 2.9 1.8 3.59 1.67c.69-.14 1.71-2.49 4.94-4.76s6.39-4.19 11.55-5.98s10.11-3.85 11.62-4.81s-.55-7.49-2.41-11.48s-6.94-10.2-7.07-9.79"/><path fill="#db132c" d="M65.07 23.98c-1.27 1.68-1.03 3.64-1.03 3.64s2.77 1.66 5.5 2.61c4.95 1.72 16.09 1.24 21.45-1.17s7.98-4.49 8.8-7.01c.96-2.96 1.76-8.94-4-13.55c-6.6-5.29-16.56-2.4-16.56-1.02s3.99.28 3.99 5.29s-4.4 8.04-8.87 8.66s-7.36 0-9.28 2.55"/><path fill="#f71538" d="M42.24 19.65s-.51-2.02 1.17-3.64c2.54-2.48 5.78-3.78 7.63-5.78s4.48-5.79 10.93-6.67c9.56-1.31 15.74 2.27 17.12 6.67s-1.24 5.91-3.92 5.98s-4.17-1.19-9.08-.34c-8.32 1.44-11.21 5.91-11.96 6.33c-.76.41-3.23-1.03-6.6-1.93c-2.43-.65-4.19-.49-5.29-.62"/><path fill="#cd0e1f" d="M69.62 48.38s1.7-5.65 7.25-9.23c5.56-3.58 9.61-3.67 16.68-6.88s9.51-5.32 10.64-6.06c1.16-.76 2.21-1.45 3.02-.12c.52.86-.38 4.38-2.77 7.8c-2.44 3.49-4.84 5.41-6.66 11.42c-2.41 7.93 2.22 15.14-2.72 27.88c-1.6 4.12-5.35 7.89-8.84 10.34s-8.52 3-8.52 3s1.79-1.25 2.77-5.85c.48-2.26 1.2-6.27.65-10.54c-1.57-12.21-11.5-21.76-11.5-21.76"/><path fill="#e2122d" d="M31.74 46.68c.12 2.68-1.14 12.43.49 20.26c1.28 6.16 7.62 17.05 19.49 20.25c10.92 2.95 22.61-.09 22.61-.09s4.41-7.45 2.18-18.31c-2.43-11.84-14.26-20.64-27.9-27.38c-16.39-8.1-19.36-17.86-19.36-17.86s-5.39-1.41-6.74 3.44c-2.07 7.44 9.05 15.64 9.23 19.69"/></svg> 

      </div>
      <div class="flex items-center gap-3">
        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full border border-gray-100">Spring 2026</span>
        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-xs font-medium text-blue-700">AJ</div>
      </div>
    </div>

  

</main>
      
</body>
</html>