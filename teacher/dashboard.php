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

    <!-- HEADER -->
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
        <p class="text-sm text-gray-500">Étudiants</p>
        <h2 class="text-xl font-bold">72</h2>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <p class="text-sm text-gray-500">Classes</p>
        <h2 class="text-xl font-bold">3</h2>
      </div>
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

    <!-- US22 -->
    <section id="classes" class="bg-white p-5 rounded-lg shadow">
      <h2 class="font-bold mb-4">Détails des Classes</h2>
      <p class="text-sm mb-2">Classe : <strong>L2 INFO</strong></p>
      <p class="text-sm mb-2">Nombre d'étudiants : <strong>64</strong></p>
      <p class="text-sm">Salle : <strong>205</strong></p>
    </section>

    <!-- US23 -->
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
          <tr class="border-t">
            <td class="p-2">Amina</td>
            <td class="p-2">Web</td>
            <td class="p-2">
              <select class="border rounded p-1 text-sm">
                <option>Actif</option>
                <option>Terminé</option>
              </select>
            </td>
            <td class="p-2">
              <button class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
                Save
              </button>
            </td>
          </tr>
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