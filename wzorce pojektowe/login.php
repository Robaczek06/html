<!DOCTYPE html>
<html lang="pl">

<head>
	<title>Logowanie</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
</head>

<body>
	<?php
	session_start();
	?>
	<section class="vh-100 gradient-custom">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">
							<div class="mb-md-5 mt-md-4 pb-5">
								<h2 class="fw-bold mb-2 text-uppercase">Login</h2>
								<p class="text-white-50 mb-5">Podaj email i hasło</p>
								<form method="post">
									<div class="form-outline form-white mb-4">
										<input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
										<label class="form-label" for="typeEmailX">Email</label>
									</div>
									<div class="form-outline form-white mb-4">
										<input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
										<label class="form-label" for="typePasswordX">hasło</label>
									</div>
									<button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
								</form>
								<div class="d-flex justify-content-center text-center mt-4 pt-1">

									<?php
									$conn = new mysqli('', 'root', '', 'kurs');
									if ($conn->connect_errno)
										die("Connection failed: {$conn->connect_error}");

									if (isset($_POST['email']) && isset($_POST['password'])) {
										if (!empty($_POST['password']) && !empty($_POST['email'])) {
											$email = $_POST['email'];
											$pass = $_POST['password'];
											$result = $conn->query("SELECT * FROM user WHERE email='$email'");

											if ($result->num_rows == 1) {
												$row = $result->fetch_assoc();
												$password = $row['password'];
												if ($pass == $password) {
													$_SESSION['id'] = $row['id'];
													$_SESSION['permission'] = $row['permission'];
													if ($_SESSION["permission"] == "admin") header('Location: admin.html');
													else									header('Location: test.php');
												} else echo '<span style="color: red;"> ' . "zły email lub hasło";
											} else echo '<span style="color: red;"> ' . "zły email lub hasło";
										} else echo '<span style="color: red;"> ' . "email lub hasło nie może być puste";
									}
									$conn->close();
									?>
								</div>

							</div>
							<div>
								<p class="mb-0"><a href="kurs.html" class="text-white-50 fw-bold">Wróć do kursu</a></p>
							</div>
							<div>
								<p class="mb-0">Nie masz konta? <a href="register.php" class="text-white-50 fw-bold">Zarejestrju się</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>