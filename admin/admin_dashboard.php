<?php
require '../scripts/database.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

  <div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-700 text-white min-h-screen p-5 fixed">
      <h2 class="text-xl font-bold mb-6">Admin Dashboard</h2>

      <nav class="space-y-3 text-sm">
        <a href="#users" class="nav-link block p-2 rounded hover:bg-blue-600">Utilisateurs</a>
        <a href="#classes" class="nav-link block p-2 rounded hover:bg-blue-600">Classes</a>
        <a href="#courses" class="nav-link block p-2 rounded hover:bg-blue-600">Cours</a>
        <a href="#enrollments" class="nav-link block p-2 rounded hover:bg-blue-600">Inscriptions</a>
        <a href="#stats" class="nav-link block p-2 rounded hover:bg-blue-600">Statistiques</a>
      </nav>
    </aside>

    <!-- MAIN -->
    <main class="ml-64 flex-1 p-6 space-y-10">

      <!-- HEADER -->
      <div>
        <h1 class="text-2xl font-bold">Dashboard Administrateur</h1>
        <p class="text-gray-500 text-sm">Gestion globale de l’établissement</p>
      </div>

      <!-- GLOBAL STATS (US19) -->
      <?php
      // Stats queries
      $totalStudents  = $conn->query("SELECT COUNT(*) FROM students")->fetchColumn();
      $totalProfessors = $conn->query("SELECT COUNT(*) FROM users LEFT JOIN roles ON users.roles_id = roles.id WHERE roles.label = 'Prof'")->fetchColumn();
      $totalCourses   = $conn->query("SELECT COUNT(*) FROM courses")->fetchColumn();
      $totalClasses   = $conn->query("SELECT COUNT(*) FROM classes")->fetchColumn();

      // Students per class
      $studentsPerClass = $conn->query("
    SELECT classes.name, COUNT(students.id) as total
    FROM classes
    LEFT JOIN students ON students.classes_id = classes.id
    GROUP BY classes.id, classes.name
")->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <section id="stats" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
          <p class="text-sm text-gray-500">Étudiants</p>
          <h2 class="text-xl font-bold"><?php echo $totalStudents; ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <p class="text-sm text-gray-500">Professeurs</p>
          <h2 class="text-xl font-bold"><?php echo $totalProfessors; ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <p class="text-sm text-gray-500">Cours</p>
          <h2 class="text-xl font-bold"><?php echo $totalCourses; ?></h2>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <p class="text-sm text-gray-500">Classes</p>
          <h2 class="text-xl font-bold"><?php echo $totalClasses; ?></h2>
        </div>
      </section>

      <!-- Students per class breakdown -->
      <section class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Répartition des étudiants par classe</h2>
        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">Classe</th>
              <th class="p-2 text-left">Nombre d'étudiants</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($studentsPerClass)): ?>
              <?php foreach ($studentsPerClass as $row): ?>
                <tr class="border-t">
                  <td class="p-2"><?php echo htmlspecialchars($row['name']); ?></td>
                  <td class="p-2"><?php echo $row['total']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="2" class="p-2 text-center">Aucune donnée</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>


      <!-- US15 : Gestion des Comptes -->
      <section id="users" class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Gestion des Comptes</h2>

        <button type="button" onclick="openAddModal()" class="bg-blue-600 text-white px-4 py-2 rounded text-sm mb-4">
          + Ajouter Utilisateur
        </button>

        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">Nom</th>
              <th class="p-2 text-left">Email</th>
              <th class="p-2 text-left">Rôle</th>
              <th class="p-2 text-left">Actions</th>
            </tr>
          </thead>

          <?php

          $stmt = $conn->query("SELECT users.id AS user_id, users.firstname, users.email, roles.label ,users.roles_id 
                      FROM users 
                      LEFT JOIN roles ON users.roles_id = roles.id");
          $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $roles = $conn->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <tbody>
            <?php if (!empty($users)): ?>
              <?php foreach ($users as $user): ?>
                <?php



                ?>
                <tr class="border-t">
                  <td class="p-2"><?php echo $user['firstname']; ?></td>
                  <td class="p-2"><?php echo $user['email']; ?></td>
                  <td class="p-2"><?php echo $user['label']; ?></td>
                  <td class="p-2 space-x-2">

                    <form action="gestiondescomptes.php" method="post">

                      <button type="button" onclick="openEditModal(this)"
                        data-id="<?php echo $user['user_id']; ?>"
                        data-firstname="<?php echo htmlspecialchars($user['firstname'] ?? '', ENT_QUOTES); ?>"
                        data-lastname="<?php echo htmlspecialchars($user['lastname'] ?? '', ENT_QUOTES); ?>"
                        data-email="<?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES); ?>"
                        data-role="<?php echo $user['roles_id'] ?? ''; ?>"
                        class="bg-yellow-400 px-4 py-1 rounded text-xs ml-2">Edit</button>

                    </form>
                    <form action="gestiondescomptes.php" method="post">
                      <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                      <button type="submit" name="delete" class="bg-red-500 text-white px-2 py-1 rounded text-xs mt-4">
                        Delete
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="p-2 text-center">No users found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- US16 : Classes -->
      <section id="classes" class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Structure Académique</h2>

        <button type="button" onclick="openAddClassModal()" class="bg-blue-600 text-white px-4 py-2 rounded text-sm mb-4">
          + Ajouter Classe
        </button>
        <?php
        $classes = $conn->query("SELECT *from classes")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">ID</th>
              <th class="p-2 text-left">Nom</th>
              <th class="p-2 text-left">Salle</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($classes)): ?>
              <?php foreach ($classes as $class): ?>
                <tr class="border-t">
                  <td class="p-2"><?php echo $class['id']; ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($class['name']); ?></td>
                  <td class="p-2"><?php echo $class['classrom_number']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="p-2 text-center">Aucune classe trouvée</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- US17 : Cours -->
      <section id="courses" class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Gestion des Cours</h2>

        <button type="button" onclick="openAddCourseModal()" class="bg-blue-600 text-white px-4 py-2 rounded text-sm mb-4">
          + Ajouter Cours
        </button>
        <?php
        $courses = $conn->query("
    SELECT courses.id, courses.title, courses.description, courses.total_hours, 
           users.firstname, users.lastname
    FROM courses
    LEFT JOIN users ON courses.user_id = users.id
         ")->fetchAll(PDO::FETCH_ASSOC);

        $professors = $conn->query("
    SELECT users.id, users.firstname, users.lastname 
    FROM users 
    LEFT JOIN roles ON users.roles_id = roles.id 
    WHERE roles.label = 'Prof'
")->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">Cours</th>
              <th class="p-2 text-left">Professeur</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($courses)): ?>
              <?php foreach ($courses as $course): ?>
                <tr class="border-t">
                  <td class="p-2"><?php echo htmlspecialchars($course['title']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($course['description']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($course['total_hours']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($course['firstname'] . ' ' . $course['lastname']); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="p-2 text-center">Aucun cours trouvé</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>


      <!-- US18 : Inscriptions -->
      <?php
      $enrollments = $conn->query("
    SELECT enrollments.id, enrollments.enrolled_at, enrollments.status,
           students.student_number,
           users.firstname, users.lastname,
           courses.title AS course_title
    FROM enrollments
    LEFT JOIN students ON enrollments.students_id = students.id
    LEFT JOIN users ON students.users_id = users.id
    LEFT JOIN courses ON enrollments.courses_id = courses.id
")->fetchAll(PDO::FETCH_ASSOC);

      // Fetch students and courses for the add enrollment dropdown
      $students_list = $conn->query("
    SELECT students.id, users.firstname, users.lastname, students.student_number
    FROM students
    LEFT JOIN users ON students.users_id = users.id
")->fetchAll(PDO::FETCH_ASSOC);

      $courses_list = $conn->query("SELECT id, title FROM courses")->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <section id="enrollments" class="bg-white p-5 rounded-lg shadow">
        <h2 class="font-bold mb-4">Administration des Inscriptions</h2>

        <button type="button" onclick="openAddEnrollmentModal()"
          class="bg-green-600 text-white px-4 py-2 rounded text-sm mb-4">
          + Inscrire un étudiant
        </button>

        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 text-left">Étudiant</th>
              <th class="p-2 text-left">Numéro</th>
              <th class="p-2 text-left">Cours</th>
              <th class="p-2 text-left">Date</th>
              <th class="p-2 text-left">Statut</th>
              <th class="p-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($enrollments)): ?>
              <?php foreach ($enrollments as $enrollment): ?>
                <tr class="border-t">
                  <td class="p-2"><?php echo htmlspecialchars($enrollment['firstname'] . ' ' . $enrollment['lastname']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($enrollment['student_number']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($enrollment['course_title']); ?></td>
                  <td class="p-2"><?php echo htmlspecialchars($enrollment['enrolled_at']); ?></td>
                  <td class="p-2">
                    <span class="px-2 py-1 rounded text-xs <?php echo $enrollment['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                      <?php echo ucfirst($enrollment['status']); ?>
                    </span>
                  </td>
                  <td class="p-2 space-x-1">
                    <!-- Toggle Status -->
                    <form action="gestiondescomptes.php" method="post" style="display:inline">
                      <input type="hidden" name="enrollment_id" value="<?php echo $enrollment['id']; ?>">
                      <input type="hidden" name="new_status" value="<?php echo $enrollment['status'] === 'active' ? 'inactive' : 'active'; ?>">
                      <button type="submit" name="toggle_enrollment_status"
                        class="px-2 py-1 rounded text-xs <?php echo $enrollment['status'] === 'active' ? 'bg-yellow-400' : 'bg-green-500 text-white'; ?>">
                        <?php echo $enrollment['status'] === 'active' ? 'Désactiver' : 'Activer'; ?>
                      </button>
                    </form>
                    <!-- Delete -->
                    <form action="gestiondescomptes.php" method="post" style="display:inline">
                      <input type="hidden" name="enrollment_id" value="<?php echo $enrollment['id']; ?>">
                      <button type="submit" name="delete_enrollment"
                        class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                        Supprimer
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="p-2 text-center">Aucune inscription trouvée</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- ACTIVE LINK SCRIPT -->
      <script>
        const links = document.querySelectorAll('.nav-link');

        links.forEach(link => {
          link.addEventListener('click', function() {
            links.forEach(l => l.classList.remove('bg-blue-900'));
            this.classList.add('bg-blue-900');
          });
        });
      </script>

      <!-- Edit Modal -->
      <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
          <h2 class="text-lg font-semibold mb-4">Edit User</h2>
          <form action="gestiondescomptes.php" method="post">
            <input type="hidden" name="user_id" id="edit_user_id">

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">First Name</label>
              <input type="text" name="firstname" id="edit_firstname"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Last Name</label>
              <input type="text" name="lastname" id="edit_lastname"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Email</label>
              <input type="email" name="email" id="edit_email"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Role</label>
              <select name="roles_id" id="edit_role" class="w-full border rounded px-3 py-2 text-sm">
                <?php foreach ($roles as $role): ?>
                  <option value="<?php echo $role['id']; ?>">
                    <?php echo htmlspecialchars($role['label']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="flex justify-end space-x-2">
              <button type="button" onclick="closeEditModal()"
                class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
              <button type="submit" name="edit_save"
                class="px-4 py-2 text-sm rounded bg-blue-500 text-white hover:bg-blue-600">Save</button>
            </div>


          </form>
          <button
            onclick="openEditModal(this)"
            data-id="<?php echo $user['user_id']; ?>"
            data-firstname="<?php echo htmlspecialchars($user['firstname'] ?? '', ENT_QUOTES); ?>"
            data-lastname="<?php echo htmlspecialchars($user['lastname'] ?? '', ENT_QUOTES); ?>"
            data-email="<?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES); ?>"
            data-role="<?php echo $user['roles_id'] ?? ''; ?>"
            class="bg-yellow-400 px-2 py-1 rounded text-xs">
            Edit
          </button>
        </div>
      </div>


      <script>
        function openEditModal(btn) {
          document.getElementById('edit_user_id').value = btn.dataset.id;
          document.getElementById('edit_firstname').value = btn.dataset.firstname;
          document.getElementById('edit_lastname').value = btn.dataset.lastname;
          document.getElementById('edit_email').value = btn.dataset.email;
          document.getElementById('edit_role').value = btn.dataset.role;
          document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
          document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editModal').addEventListener('click', function(e) {
          if (e.target === this) closeEditModal();
        });

        function openAddModal() {
          document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
          document.getElementById('addModal').classList.add('hidden');
        }

        document.getElementById('addModal').addEventListener('click', function(e) {
          if (e.target === this) closeAddModal();
        });
      </script>
      <!-- Add User Modal -->
      <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
          <h2 class="text-lg font-semibold mb-4">Ajouter Utilisateur</h2>
          <form action="gestiondescomptes.php" method="post">

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">First Name</label>
              <input type="text" name="firstname"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">date_of_birth</label>
              <input type="date" name="date_of_birth"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">student_number</label>
              <input type="text" name="student_number"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>


            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Last Name</label>
              <input type="text" name="lastname"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>





            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Email</label>
              <input type="email" name="email"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Password</label>
              <input type="password" name="password"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Role</label>
              <select name="roles_id" class="w-full border rounded px-3 py-2 text-sm">
                <?php foreach ($roles as $role): ?>
                  <option value="<?php echo $role['id']; ?>">
                    <?php echo htmlspecialchars($role['label']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="flex justify-end space-x-2">
              <button type="button" onclick="closeAddModal()"
                class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
              <button type="submit" name="add_user"
                class="px-4 py-2 text-sm rounded bg-green-500 text-white hover:bg-green-600">Add</button>
            </div>

          </form>
        </div>
      </div>


      <!-- Add Class Modal -->
      <div id="addClassModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
          <h2 class="text-lg font-semibold mb-4">Ajouter une Classe</h2>
          <form action="gestiondescomptes.php" method="post">

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Nom de la classe</label>
              <input type="text" name="class_name"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Numéro de salle</label>
              <input type="text" name="classroom_number"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="flex justify-end space-x-2">
              <button type="button" onclick="closeAddClassModal()"
                class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-gray-300">Annuler</button>
              <button type="submit" name="add_class"
                class="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">Ajouter</button>
            </div>

          </form>
        </div>
      </div>
      <script>
        function openAddClassModal() {
          document.getElementById('addClassModal').classList.remove('hidden');
        }

        function closeAddClassModal() {
          document.getElementById('addClassModal').classList.add('hidden');
        }

        document.getElementById('addClassModal').addEventListener('click', function(e) {
          if (e.target === this) closeAddClassModal();
        });
      </script>

      <!-- Add Course Modal -->
      <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
          <h2 class="text-lg font-semibold mb-4">Ajouter un Cours</h2>
          <form action="gestiondescomptes.php" method="post">

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Titre du cours</label>
              <input type="text" name="title"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Description</label>
              <textarea name="description" rows="3"
                class="w-full border rounded px-3 py-2 text-sm"></textarea>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Total heures</label>
              <input type="number" name="total_hours" min="1"
                class="w-full border rounded px-3 py-2 text-sm" required>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Assigner un Professeur</label>
              <select name="user_id" class="w-full border rounded px-3 py-2 text-sm" required>
                <option value="">-- Choisir un professeur --</option>
                <?php foreach ($professors as $prof): ?>
                  <option value="<?php echo $prof['id']; ?>">
                    <?php echo htmlspecialchars($prof['firstname'] . ' ' . $prof['lastname']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="flex justify-end space-x-2">
              <button type="button" onclick="closeAddCourseModal()"
                class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-gray-300">Annuler</button>
              <button type="submit" name="add_course"
                class="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">Ajouter</button>
            </div>

          </form>
        </div>
      </div>
      <script>
        function openAddCourseModal() {
          document.getElementById('addCourseModal').classList.remove('hidden');
        }

        function closeAddCourseModal() {
          document.getElementById('addCourseModal').classList.add('hidden');
        }

        document.getElementById('addCourseModal').addEventListener('click', function(e) {
          if (e.target === this) closeAddCourseModal();
        });
      </script>

      <!-- Add Enrollment Modal -->
      <div id="addEnrollmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
          <h2 class="text-lg font-semibold mb-4">Inscrire un Étudiant</h2>
          <form action="gestiondescomptes.php" method="post">

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Étudiant</label>
              <select name="students_id" class="w-full border rounded px-3 py-2 text-sm" required>
                <option value="">-- Choisir un étudiant --</option>
                <?php foreach ($students_list as $student): ?>
                  <option value="<?php echo $student['id']; ?>">
                    <?php echo htmlspecialchars($student['firstname'] . ' ' . $student['lastname'] . ' (' . $student['student_number'] . ')'); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="block text-sm font-medium mb-1">Cours</label>
              <select name="courses_id" class="w-full border rounded px-3 py-2 text-sm" required>
                <option value="">-- Choisir un cours --</option>
                <?php foreach ($courses_list as $course): ?>
                  <option value="<?php echo $course['id']; ?>">
                    <?php echo htmlspecialchars($course['title']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Statut</label>
              <select name="status" class="w-full border rounded px-3 py-2 text-sm">
                <option value="active">Actif</option>
                <option value="inactive">Inactif</option>
              </select>
            </div>

            <div class="flex justify-end space-x-2">
              <button type="button" onclick="closeAddEnrollmentModal()"
                class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-gray-300">Annuler</button>
              <button type="submit" name="add_enrollment"
                class="px-4 py-2 text-sm rounded bg-green-600 text-white hover:bg-green-700">Inscrire</button>
            </div>

          </form>
        </div>
      </div>
      <script>
        function openAddEnrollmentModal() {
          document.getElementById('addEnrollmentModal').classList.remove('hidden');
        }

        function closeAddEnrollmentModal() {
          document.getElementById('addEnrollmentModal').classList.add('hidden');
        }

        document.getElementById('addEnrollmentModal').addEventListener('click', function(e) {
          if (e.target === this) closeAddEnrollmentModal();
        });
      </script>


</body>

</html>








