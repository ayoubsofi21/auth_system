<?php 
session_start();
include('../scripts/database.php');
require '../includes/auth.php';

requireLogin();
requireRole('Prof');

$teacher_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professeur</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-blue-700 text-white min-h-screen p-5 fixed">
  <h2 class="text-xl font-bold mb-6">Prof Dashboard</h2>

  <nav class="space-y-3 text-sm">
    <a href="#cours" class="nav-link block p-2 rounded hover:bg-blue-600">Mes Cours</a>
    <a href="#effectifs" class="nav-link block p-2 rounded hover:bg-blue-600">Effectifs</a>
    <a href="#classes" class="nav-link block p-2 rounded hover:bg-blue-600">Classes</a>
    <a href="#suivi" class="nav-link block p-2 rounded hover:bg-blue-600">Suivi</a>
  </nav> 
  <a href="../scripts/logout.php"
    class="block p-2 mt-6 bg-red-500 hover:bg-red-600 rounded text-center">
    Se déconnecter
    </a>
</aside>

<!-- MAIN -->
<main class="ml-64 flex-1 p-6 space-y-10">

  <div>
    <h1 class="text-2xl font-bold">Dashboard Professeur</h1>
    <p class="text-gray-500 text-sm">Gérez vos cours et vos étudiants</p>
  </div>

  <!-- STATS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

    <?php
    // My courses
    $stmt = $conn->prepare("SELECT COUNT(*) FROM courses WHERE user_id = ?");
    $stmt->execute([$teacher_id]);
    $courses_count = $stmt->fetchColumn();

    // Students
    $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM students s
        JOIN enrollments e ON e.student_id = s.id
        JOIN courses c ON c.id = e.course_id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$teacher_id]);
    $students_count = $stmt->fetchColumn();

    // Classes
    $stmt = $conn->prepare("
        SELECT COUNT(DISTINCT c.id)
        FROM classes c
        JOIN students s ON s.class_id = c.id
        JOIN enrollments e ON e.student_id = s.id
        JOIN courses co ON co.id = e.course_id
        WHERE co.user_id = ?
    ");
    $stmt->execute([$teacher_id]);
    $classes_count = $stmt->fetchColumn();

    // Active enrollments
    $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM enrollments e
        JOIN courses c ON c.id = e.course_id
        WHERE c.user_id = ? AND e.status = 'actif'
    ");
    $stmt->execute([$teacher_id]);
    $active_count = $stmt->fetchColumn();
    ?>

    <div class="bg-white p-4 rounded shadow">
      <p class="text-sm text-gray-500">Mes Cours</p>
      <h2 class="text-xl font-bold"><?= $courses_count ?></h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <p class="text-sm text-gray-500">Étudiants</p>
      <h2 class="text-xl font-bold"><?= $students_count ?></h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <p class="text-sm text-gray-500">Classes</p>
      <h2 class="text-xl font-bold"><?= $classes_count ?></h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <p class="text-sm text-gray-500">Actifs</p>
      <h2 class="text-xl font-bold"><?= $active_count ?></h2>
    </div>

  </div>

  <!-- COURSES -->
  <section id="cours" class="bg-white p-5 rounded shadow">
    <h2 class="font-bold mb-4">Mes Enseignements</h2>

    <?php
    $stmt = $conn->prepare("SELECT * FROM courses WHERE user_id = ?");
    $stmt->execute([$teacher_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <ul class="space-y-2 text-sm">
      <?php foreach ($courses as $course): ?>
        <li class="flex justify-between border-b pb-2">
          <span><?= htmlspecialchars($course['title']) ?></span>
          <span class="text-gray-500"><?= $course['total_hours'] ?>h</span>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <!-- EFFECTIFS -->
  <section id="effectifs" class="bg-white p-5 rounded shadow">
    <h2 class="font-bold mb-4">Gestion des Effectifs</h2>

    <?php
    $stmt = $conn->prepare("
        SELECT 
            u.firstname,
            u.lastname,
            c.title,
            e.status
        FROM enrollments e
        JOIN students s ON s.id = e.student_id
        JOIN users u ON u.id = s.user_id
        JOIN courses c ON c.id = e.course_id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$teacher_id]);
    $effectifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="w-full text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2 text-left">Nom</th>
          <th class="p-2 text-left">Cours</th>
          <th class="p-2 text-left">Statut</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($effectifs as $row): ?>
          <tr class="border-t">
            <td class="p-2"><?= htmlspecialchars($row['firstname'].' '.$row['lastname']) ?></td>
            <td class="p-2"><?= htmlspecialchars($row['title']) ?></td>
            <td class="p-2 text-green-600"><?= htmlspecialchars($row['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <!-- CLASSES -->
  <section id="classes" class="bg-white p-5 rounded shadow">
    <h2 class="font-bold mb-4">Mes Classes</h2>

    <?php
    $stmt = $conn->prepare("
        SELECT 
            c.id,
            c.name,
            COUNT(s.id) AS total_students
        FROM classes c
        LEFT JOIN students s ON s.class_id = c.id
        GROUP BY c.id, c.name
    ");
    $stmt->execute();
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <?php foreach ($classes as $cls): ?>
        <div class="bg-gray-50 p-4 rounded shadow">
          <h3 class="font-semibold"><?= htmlspecialchars($cls['name']) ?></h3>
          <p class="text-sm text-gray-500"><?= $cls['total_students'] ?> étudiants</p>

          <a href="?class_id=<?= $cls['id'] ?>#students"
             class="text-blue-600 text-sm">Voir étudiants</a>
        </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- STUDENTS -->
  <?php if (isset($_GET['class_id'])): ?>

  <section id="students" class="bg-white p-5 rounded shadow">
    <h2 class="font-bold mb-4">Étudiants</h2>

    <?php
    $stmt = $conn->prepare("
        SELECT u.firstname, u.lastname
        FROM students s
        JOIN users u ON u.id = s.user_id
        WHERE s.class_id = ?
    ");
    $stmt->execute([$_GET['class_id']]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <ul class="space-y-2">
      <?php foreach ($students as $st): ?>
        <li><?= htmlspecialchars($st['firstname'].' '.$st['lastname']) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <?php endif; ?>

  <!-- FOLLOW UP -->
  <?php
  if (isset($_POST['update_status'])) {
      $stmt = $conn->prepare("
          UPDATE enrollments e
          JOIN courses c ON c.id = e.course_id
          SET e.status = ?
          WHERE e.id = ? AND c.user_id = ?
      ");
      $stmt->execute([
          $_POST['status'],
          $_POST['enrollment_id'],
          $teacher_id
      ]);
  }

  $stmt = $conn->prepare("
      SELECT 
          e.id AS enrollment_id,
          CONCAT(u.firstname,' ',u.lastname) AS student_name,
          c.title,
          e.status
      FROM enrollments e
      JOIN students s ON s.id = e.student_id
      JOIN users u ON u.id = s.user_id
      JOIN courses c ON c.id = e.course_id
      WHERE c.user_id = ?
  ");
  $stmt->execute([$teacher_id]);
  $enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <section id="suivi" class="bg-white p-5 rounded shadow">
    <h2 class="font-bold mb-4">Suivi Pédagogique</h2>

    <table class="w-full text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2">Étudiant</th>
          <th class="p-2">Cours</th>
          <th class="p-2">Statut</th>
          <th class="p-2">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($enrollments as $e): ?>
        <tr class="border-t">
          <td class="p-2"><?= htmlspecialchars($e['student_name']) ?></td>
          <td class="p-2"><?= htmlspecialchars($e['title']) ?></td>

          <form method="POST">
            <td class="p-2">
              <select name="status" class="border p-1">
                <option value="actif" <?= $e['status']=='actif'?'selected':'' ?>>Actif</option>
                <option value="termine" <?= $e['status']=='termine'?'selected':'' ?>>Terminé</option>
              </select>
            </td>

            <td class="p-2">
              <input type="hidden" name="enrollment_id" value="<?= $e['enrollment_id'] ?>">
              <button name="update_status" class="bg-blue-600 text-white px-3 py-1 text-xs rounded">
                Save
              </button>
            </td>
          </form>

        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

</main>
</div>

<script>
const links = document.querySelectorAll('.nav-link');
links.forEach(link => {
  link.addEventListener('click', () => {
    links.forEach(l => l.classList.remove('bg-blue-900'));
    link.classList.add('bg-blue-900');
  });
});
</script>

</body>
</html>