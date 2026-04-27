<?php
include("../includes/navbar.html")
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduSync — School Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 antialiased">

  <!-- Hero Section -->
  <section class="min-h-screen flex flex-col items-center justify-center px-6 text-center bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-2xl mx-auto">

      <!-- Logo mark -->
      <div class="flex items-center justify-center gap-2 mb-8">
        <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center">
          <svg class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5 8.191V13.5a1 1 0 00.553.894l4 2a1 1 0 00.894 0l4-2A1 1 0 0015 13.5V8.191l2-0.86V14a1 1 0 102 0V6a1 1 0 00-.606-.92l-8-3.44z"/>
          </svg>
        </div>
        <span class="text-xl font-semibold text-gray-900">EduSync</span>
      </div>

      <!-- Headline -->
      <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-4">
        Your school,<br class="hidden sm:block"/>
        <span class="text-blue-600">all in one place.</span>
      </h1>
      <p class="text-base text-gray-500 max-w-md mx-auto mb-10">
        Manage students, track attendance, and access your dashboard — securely and simply.
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="register.php"
           class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
          Create an account
        </a>
        <a href="login.php"
           class="w-full sm:w-auto px-6 py-3 bg-white text-gray-700 text-sm font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
          Sign in
        </a>
      </div>
    </div>


  </section>

  <!-- Features Section -->
  <section class="py-20 px-6 bg-white">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-2xl font-bold text-center text-gray-900 mb-2">Everything your school needs</h2>
      <p class="text-sm text-center text-gray-400 mb-12">Simple tools, built for students and staff.</p>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <!-- Feature 1 -->
        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
          <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
            </svg>
          </div>
          <h3 class="text-sm font-semibold text-gray-900 mb-1">Student Management</h3>
          <p class="text-xs text-gray-400 leading-relaxed">Register new students, manage profiles, and keep records organized.</p>
        </div>

        <!-- Feature 2 -->
        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
          <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center mb-4">
            <svg class="w-5 h-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="text-sm font-semibold text-gray-900 mb-1">Secure Access</h3>
          <p class="text-xs text-gray-400 leading-relaxed">Session-based authentication ensures only authorized users reach the dashboard.</p>
        </div>

        <!-- Feature 3 -->
        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
          <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4">
            <svg class="w-5 h-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
              <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
            </svg>
          </div>
          <h3 class="text-sm font-semibold text-gray-900 mb-1">Live Dashboard</h3>
          <p class="text-xs text-gray-400 leading-relaxed">Track grades, attendance, and performance from a clean, unified view.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="py-16 px-6 bg-blue-600">
    <div class="max-w-xl mx-auto text-center">
      <h2 class="text-2xl font-bold text-white mb-3">Ready to get started?</h2>
      <p class="text-sm text-blue-100 mb-8">Join EduSync and bring your school management online today.</p>
      <a href="register.php"
         class="inline-block px-8 py-3 bg-white text-blue-600 text-sm font-semibold rounded-xl hover:bg-blue-50 transition-colors shadow">
        Sign up for free
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-8 px-6 bg-white border-t border-gray-100 text-center">
    <p class="text-xs text-gray-400">&copy; 2026 EduSync. Built with PHP &amp; Tailwind CSS.</p>
  </footer>

</body>
</html>