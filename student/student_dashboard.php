<?php
session_start();

include '../scripts/database.php';
require '../includes/auth.php';

requireLogin();
requireRole('Student');

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT u.firstname, u.lastname, u.email, c.name AS classe
    FROM users u
    INNER JOIN students s ON s.user_id = u.id
    INNER JOIN classes c ON c.id = s.class_id
    WHERE u.id = ?
");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("
    SELECT c.title, u.firstname AS prof_name
    FROM enrollments e
    INNER JOIN students s ON e.student_id = s.id
    INNER JOIN courses c ON e.course_id = c.id
    INNER JOIN users u ON c.user_id = u.id
    WHERE s.user_id = ?
");
$stmt->execute([$user_id]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("
    SELECT u.firstname, u.lastname
    FROM students s
    INNER JOIN users u ON s.user_id = u.id
    WHERE s.class_id = (
        SELECT class_id FROM students WHERE user_id = ?
    )
    AND u.id != ?
");
$stmt->execute([$user_id, $user_id]);
$classmates = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("
    SELECT c.title, c.description, c.total_hours
    FROM enrollments e
    INNER JOIN students s ON e.student_id = s.id
    INNER JOIN courses c ON e.course_id = c.id
    WHERE s.user_id = ?
");
$stmt->execute([$user_id]);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Étudiant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<div class="flex">

  <aside class="w-64 bg-blue-700 text-white min-h-screen p-5 fixed">
    <h2 class="text-xl font-bold mb-6">Student Dashboard</h2>

    <nav class="space-y-3 text-sm">
      <a href="#profile" class="block p-2 rounded hover:bg-blue-600">Mon Profil</a>
      <a href="#courses" class="block p-2 rounded hover:bg-blue-600">Mes Cours</a>
      <a href="#classmates" class="block p-2 rounded hover:bg-blue-600">Ma Classe</a>
      <a href="#modules" class="block p-2 rounded hover:bg-blue-600">Modules</a>
    </nav>

    <div class="absolute bottom-5 left-5 right-5">
      <form action="../scripts/logout.php" method="POST" class="absolute bottom-5 left-5 right-5">
        <button type="submit" name="logout"
          class="w-full text-center bg-red-500 hover:bg-red-600 text-white text-sm p-2 rounded">
          Se déconnecter
        </button>
      </form>
    </div>
  </aside>

  <main class="ml-64 flex-1 p-6 space-y-10">

    <div>
      <h1 class="text-2xl font-bold">Dashboard Étudiant</h1>
      <p class="text-gray-500 text-sm">Espace personnel et suivi académique</p>
    </div>

    <section id="profile" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Mon Profil Académique</h2>

      <?php if ($user): ?>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
          <div>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
          </div>
          <div>
            <p><strong>Classe :</strong> <?= htmlspecialchars($user['classe']) ?></p>
            <p><strong>Statut :</strong> Étudiant</p>
          </div>
        </div>
      <?php else: ?>
        <p class="text-red-500">Utilisateur introuvable</p>
      <?php endif; ?>
    </section>

    <section id="courses" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Mon Programme</h2>

      <?php if ($courses): ?>
        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">Cours</th>
              <th class="p-2 text-left">Professeur</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($courses as $course): ?>
              <tr class="border-t">
                <td class="p-2"><?= htmlspecialchars($course['title']) ?></td>
                <td class="p-2"><?= htmlspecialchars($course['prof_name']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="text-gray-500">Aucun cours trouvé</p>
      <?php endif; ?>
    </section>

    <section id="classmates" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Ma Classe</h2>

      <?php if ($classmates): ?>
        <ul class="text-sm space-y-2">
          <?php foreach ($classmates as $mate): ?>
            <li class="flex justify-between border-b pb-2">
              <span><?= htmlspecialchars($mate['firstname'] . ' ' . $mate['lastname']) ?></span>
              <span class="text-gray-500"><?= htmlspecialchars($user['classe'] ?? '') ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-gray-500">Aucun camarade trouvé</p>
      <?php endif; ?>
    </section>

    <section id="modules" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Modules</h2>

      <?php if ($modules): ?>
        <div class="space-y-4 text-sm">
          <?php foreach ($modules as $module): ?>
            <div class="border p-3 rounded">
              <h3 class="font-semibold"><?= htmlspecialchars($module['title']) ?></h3>
              <p>Description : <?= htmlspecialchars($module['description']) ?></p>
              <p>Volume horaire : <?= htmlspecialchars($module['total_hours']) ?>h</p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="text-gray-500">Aucun module trouvé</p>
      <?php endif; ?>
    </section>

  </main>
</div>
</body>
</html>