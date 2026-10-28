<?php require '../config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6)
        $msg = 'Enter name, valid email and password (at least 6 characters).';
    else {
        $s = $conn->prepare('SELECT id FROM users WHERE email=?');
        // This simple practical uses students table from the supplied database.
        $s->close();
        $s = $conn->prepare('SELECT student_id FROM students WHERE email=?');
        $s->bind_param('s', $email);
        $s->execute();
        if ($s->get_result()->num_rows)
            $msg = 'Email already registered.';
        else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $mobile = '0000000000';
            $course = 'BCA';
            $year = 1;
            $gender = 'Prefer not to say';
            $s = $conn->prepare("INSERT INTO students(name,email,mobile,password_hash,course,year,gender,role) VALUES(?,?,?,?,?,?,?, 'student')");
            $s->bind_param('sssssis', $name, $email, $mobile, $hash, $course, $year, $gender);
            $msg = $s->execute() ? 'Registration successful. You can now login.' : 'Registration failed.';
        }
        $s->close();
    }
}
?>
<h2>Practical 9: Register</h2>
<form method="post"><input name="name" placeholder="Name" required><br><input type="email" name="email"
        placeholder="Email" required><br><input type="password" name="password" placeholder="Password (6+ characters)"
        minlength="6" required><br><button>Register</button></form>
<p><?= h($msg) ?></p><a href="../Practical10/login.php">Login</a>