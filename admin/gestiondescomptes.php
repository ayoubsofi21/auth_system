<?php
session_start();
include '../scripts/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_enrollment'])) {

    $students_id = $_POST['student_id'] ?? null;
    $courses_id  = $_POST['courses_id'] ?? null;
    $status      = $_POST['status'] ?? 'active';

    if (!$students_id || !$courses_id) {
        die("Veuillez sélectionner un étudiant et un cours.");
    }

    $check = $conn->prepare("SELECT id FROM enrollments WHERE student_id = ? AND courses_id = ?");
    $check->execute([$students_id, $courses_id]);
    if ($check->fetch()) {
        die("Cet étudiant est déjà inscrit à ce cours.");
    }

    try {
        $stmt = $conn->prepare("
            INSERT INTO enrollments (student_id, courses_id, status, enrolled_at) 
            VALUES (?, ?, ?, CURDATE())
        ");
        $stmt->execute([$students_id, $courses_id, $status]);

        header("Location: admin_dashboard.php#enrollments");
        exit();

    } catch (PDOException $e) {
        die("Échec de l'inscription: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_enrollment_status'])) {

    $enrollment_id = $_POST['enrollment_id'] ?? null;
    $new_status    = $_POST['new_status'] ?? null;

    if (!$enrollment_id || !in_array($new_status, ['active', 'inactive'])) {
        die("Données invalides.");
    }

    try {
        $stmt = $conn->prepare("UPDATE enrollments SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $enrollment_id]);

        header("Location: admin_dashboard.php#enrollments");
        exit();

    } catch (PDOException $e) {
        die("Échec de la mise à jour: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_enrollment'])) {

    $enrollment_id = $_POST['enrollment_id'] ?? null;

    if (!$enrollment_id) {
        die("ID d'inscription manquant.");
    }

    try {
        $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
        $stmt->execute([$enrollment_id]);

        header("Location: admin_dashboard.php#enrollments");
        exit();

    } catch (PDOException $e) {
        die("Échec de la suppression: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {

    $title       = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? '';
    $total_hours = $_POST['total_hours'] ?? null;
    $user_id     = $_POST['user_id'] ?? null;

    if (!$title || !$total_hours || !$user_id) {
        die("Tous les champs obligatoires doivent être remplis.");
    }

    try {
        $stmt = $conn->prepare("
            INSERT INTO courses (title, description, total_hours, user_id) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$title, $description, $total_hours, $user_id]);

        header("Location: admin_dashboard.php#courses");
        exit();

    } catch (PDOException $e) {
        die("Échec de l'ajout du cours: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_class'])) {

    $name             = $_POST['class_name'] ?? null;
    $classroom_number = $_POST['classroom_number'] ?? null;

    if (!$name || !$classroom_number) {
        die("Tous les champs sont obligatoires.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO classes (name, classrom_number) VALUES (?, ?)");
        $stmt->execute([$name, $classroom_number]);

        header("Location: admin_dashboard.php#classes");
        exit();

    } catch (PDOException $e) {
        die("Échec de l'ajout: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {

    $firstname = $_POST['firstname'] ?? null;
    $lastname  = $_POST['lastname'] ?? null;
    $email     = $_POST['email'] ?? null;
    $password  = $_POST['password'] ?? null;
    $role_id   = $_POST['role_id'] ?? null;
    $dateofbirth = $_POST['date_of_birth'] ?? null;

    if (!$firstname || !$lastname || !$email || !$password || !$role_id) {
        die("All fields are required.");
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) {
        die("A user with this email already exists.");
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("
            INSERT INTO users (firstname, lastname, email, password, role_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$firstname, $lastname, $email, $hashedPassword, $role_id]);

        $newUserId = $conn->lastInsertId();

        $studentRoleId = $conn->query("SELECT id FROM roles WHERE label = 'Student'")->fetchColumn();

        if ($role_id == $studentRoleId) {
            $student_number = 'STU-' . str_pad($newUserId, 6, '0', STR_PAD_LEFT);

            $stmt2 = $conn->prepare("
                INSERT INTO students (user_id, student_number, date_of_birth) 
                VALUES (?, ?, ?)
            ");
            $stmt2->execute([$newUserId, $student_number, $dateofbirth]);
        }

        $conn->commit();
        header("Location: admin_dashboard.php#users");
        exit();

    } catch (PDOException $e) {
        $conn->rollBack();
        die("Failed to add user: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_save'])) {

    $id        = $_POST['user_id'] ?? null;
    $firstname = $_POST['firstname'] ?? null;
    $lastname  = $_POST['lastname'] ?? null;
    $email     = $_POST['email'] ?? null;
    $role_id   = $_POST['role_id'] ?? null;

    if (!$id) die("No user ID provided.");

    try {
        $stmt = $conn->prepare("
            UPDATE users 
            SET firstname = ?, lastname = ?, email = ?, role_id = ?
            WHERE id = ?
        ");
        $stmt->execute([$firstname, $lastname, $email, $role_id, $id]);

        header("Location: admin_dashboard.php");
        exit();

    } catch (PDOException $e) {
        die("Update failed: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {

    $id = $_POST['user_id'] ?? null;

    if (!$id) {
        die("No user ID provided.");
    }

    try {
        $conn->beginTransaction();

        $conn->prepare("
            DELETE enrollments FROM enrollments 
            INNER JOIN students ON enrollments.student_id = students.id 
            WHERE students.user_id = ?
        ")->execute([$id]);

        $conn->prepare("
            DELETE enrollments FROM enrollments 
            INNER JOIN courses ON enrollments.course_id = courses.id 
            WHERE courses.user_id = ?
        ")->execute([$id]);

        $conn->prepare("DELETE FROM students WHERE user_id = ?")->execute([$id]);
        $conn->prepare("DELETE FROM courses WHERE user_id = ?")->execute([$id]);
        $conn->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);

        $conn->commit();
        header("Location: admin_dashboard.php");
        exit();

    } catch (PDOException $e) {
        $conn->rollBack();
        die("Deletion failed: " . $e->getMessage());
    }
}
?>