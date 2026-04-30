<?php 
    include('../scripts/database.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professeur</title>

  <!-- Tailwind -->
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
  </aside>

  <!-- MAIN -->
  <main class="ml-64 flex-1 p-6 space-y-10">

    <div>
      <h1 class="text-2xl font-bold">Dashboard Professeur</h1>
      <p class="text-gray-500 text-sm">Gérez vos cours et vos étudiants</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="bg-white p-4 rounded-lg shadow">
        <p class="text-sm text-gray-500">Mes Cours</p>
       <h2 class="text-xl font-bold">
        <?php 
            $stmt = $conn->prepare("
                SELECT COUNT(*) 
                FROM courses 
                WHERE user_id = ?
            ");

            $stmt->execute([2]); //  $_SESSION['user_id']
            $count = $stmt->fetchColumn();

            echo $count;
        ?>
        </h2>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <?php 
            $stmt=$conn->prepare("
            select count(*) from users 
            where role_id=?
            ");
            $stmt->execute([3]); //
            $count=$stmt->fetchColumn();

        ?>
        <p class="text-sm text-gray-500">Étudiants</p>
        <h2 class="text-xl font-bold"><?php echo $count; ?></h2>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <?php 
             $stmt = $conn->prepare("
            SELECT COUNT(DISTINCT classes.id)
            FROM classes
            INNER JOIN students ON students.class_id = classes.id
            INNER JOIN enrollments ON enrollments.student_id = students.id
            INNER JOIN courses ON courses.id = enrollments.course_id
            WHERE courses.user_id = ?
        ");

        $stmt->execute([2]); 
        $count = $stmt->fetchColumn();
        ?>
        <p class="text-sm text-gray-500">Classes</p>
        <h2 class="text-xl font-bold"><?php echo $count; ?></h2>
      </div>
      <?php 
             $stmt=$conn->prepare('SELECT u.firstname, u.lastname, c.title, e.status
            FROM enrollments e
            JOIN students s ON s.id = e.student_id
            JOIN users u ON u.id = s.user_id
            JOIN courses c ON c.id = e.course_id
            WHERE c.user_id = ?');
        $stmt->execute([2]);
        $classes=$stmt->fetchColumn();
      ?>
      <div class="bg-white p-4 rounded-lg shadow">
        <p class="text-sm text-gray-500">Actifs</p>
        <h2 class="text-xl font-bold">60</h2>
      </div>
    </div>

    <!-- US20 -->
    <section id="cours" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Mes Enseignements</h2>
        <?php 
            $sql='select*from courses where user_id=?';
            $stmt=$conn->prepare($sql);
            $stmt->execute([2]);
            $results=$stmt->fetchAll();      
         ?>   
      <ul class="space-y-2 text-sm">  
        <?php foreach ($results as $course) { ?>
        <li class="flex justify-between border-b pb-2">
          <span><?= $course['title']?></span>
          <span class="text-gray-500"><?= $course['total_hours']?></span>
        </li>
        <?php } ?>
      </ul>
    </section>
    <?php 
        $stmt=$conn->prepare('SELECT u.firstname, u.lastname, c.title, e.status
            FROM enrollments e
            JOIN students s ON s.id = e.student_id
            JOIN users u ON u.id = s.user_id
            JOIN courses c ON c.id = e.course_id
            WHERE c.user_id = ?');
        $stmt->execute([2]);
        $classes=$stmt->fetchAll();
       
    ?>
    <section id="effectifs" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Gestion des Effectifs</h2>

      <input type="text" placeholder="Rechercher..."
        class="border p-2 rounded w-full mb-4 text-sm">

      <table class="w-full text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-2 text-left">Nom</th>
            <th class="p-2 text-left">Cours</th>
            <th class="p-2 text-left">Statut</th>
          </tr>
        </thead>
        <tbody>
            <?php ?>
            <?php  
                 foreach ($classes as $class) {
 
            ?>
            <tr class="border-t">
                <td class="p-2"><?= $class['firstname'] ?></td>
            <td class="p-2"><?= $class['title'] ?></td>
            <td class="p-2 text-green-600"><?= $class['status'] ?></td>
          </tr>
            <?php }  ?>
           
        </tbody>
      </table>
    </section>

     <!-- US21 (Gestion des Effectifs) : En tant que prof, je peux afficher la liste des étudiants inscrits à chacun de mes cours . -->
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
        $classes = $stmt->fetchAll();
        $selectedClass = null;
        $students = [];

        if (isset($_GET['class_id'])) {
            $selectedClass = $_GET['class_id'];

            $stmt2 = $conn->prepare("
                SELECT u.firstname, u.lastname
                FROM students s
                JOIN users u ON u.id = s.user_id
                WHERE s.class_id = ?
            ");
            $stmt2->execute([$selectedClass]);
            $students = $stmt2->fetchAll();
        }
        ?>

        <section id="classes" class="bg-gray-50 p-6 rounded-lg shadow">

            <h2 class="text-xl font-bold mb-5 text-gray-800">Mes Classes</h2>

            <?php if (empty($classes)) { ?>
                <p class="text-gray-500">Aucune classe.</p>
            <?php } ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <?php foreach ($classes as $cls) { ?>

                    <div class="bg-white border rounded-xl p-4 shadow-sm hover:shadow-md transition">

                        <div class="flex justify-between items-center mb-3">

                            <h3 class="text-lg font-semibold text-gray-800">
                                <?= htmlspecialchars($cls['name']) ?>
                            </h3>

                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-2 py-1 rounded-full">
                                <?= $cls['total_students'] ?> étudiants
                            </span>

                        </div>

                        <a href="?class_id=<?php echo $cls['id']; ?>#students"
                        class="bg-blue-600 text-white px-3 py-1 rounded text-xs inline-block">
                            Voir étudiants
                        </a>

                    </div>

                <?php } ?>

            </div>
        </section>

        <?php if ($selectedClass) { ?>

        <section id="students" class="bg-white p-5 rounded-lg shadow mt-5">

            <h2 class="text-xl font-bold mb-4 text-gray-800">
                Étudiants de la classe
            </h2>

            <?php if (empty($students)) { ?>
                <p class="text-gray-500">Aucun étudiant dans cette classe.</p>
            <?php } else { ?>

                <ul class="space-y-2">
                    <?php foreach ($students as $st) { ?>
                        <li class="text-sm text-gray-700 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                            <?= htmlspecialchars($st['firstname']) ?>
                            <?= htmlspecialchars($st['lastname']) ?>
                        </li>
                    <?php } ?>
                </ul>

            <?php } ?>

        </section>

        <?php } ?>
</section>
    </section>

  <!-- US23 -->
   <?php
       $stmt = $conn->prepare("
            SELECT 
                e.id AS enrollment_id,
                CONCAT(u.firstname, ' ', u.lastname) AS student_name,
                c.title AS course_name,
                e.status
            FROM enrollments e
            JOIN students s ON s.id = e.student_id
            JOIN users u ON u.id = s.user_id
            JOIN courses c ON c.id = e.course_id
        ");
        $stmt->execute();
        $enrollments = $stmt->fetchAll();
        ?>

        <!-- US23 -->
         <?php
            if (isset($_POST['update_status'])) {

                $enrollment_id = $_POST['enrollment_id'];
                $status = $_POST['status'];

                $stmt = $conn->prepare("
                    UPDATE enrollments 
                    SET status = ? 
                    WHERE id = ?
                ");

                $stmt->execute([$status, $enrollment_id]);
            }
            ?>
        <section id="suivi" class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Suivi Pédagogique</h2>

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Étudiant</th>
                <th class="p-2 text-left">Cours</th>
                <th class="p-2 text-left">Statut</th>
                <th class="p-2 text-left">Action</th>
            </tr>
            </thead>

            <tbody>
                <?php foreach ($enrollments as $enroll): ?>
                <tr class="border-t">

                <td class="p-2"><?= htmlspecialchars($enroll['student_name']) ?></td>
                <td class="p-2"><?= htmlspecialchars($enroll['course_name']) ?></td>

                <form method="POST" action="">
                    
                    <td class="p-2">
                    <select name="status" class="border rounded p-1 text-sm">
                        <option value="actif" <?= $enroll['status'] == "actif" ? "selected" : "" ?>>Actif</option>
                        <option value="termine" <?= $enroll['status'] == "termine" ? "selected" : "" ?>>Terminé</option>
                    </select>
                    </td>

                    <td class="p-2">
                    <input type="hidden" name="enrollment_id" value="<?= $enroll['enrollment_id'] ?>">
                    <button type="submit" name="update_status"
                        class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
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

<!-- JS ACTIVE LINK -->
<script>
  const links = document.querySelectorAll('.nav-link');

  links.forEach(link => {
    link.addEventListener('click', function () {
      links.forEach(l => l.classList.remove('bg-blue-900'));
      this.classList.add('bg-blue-900');
    });
  });
</script>

</body>
</html>