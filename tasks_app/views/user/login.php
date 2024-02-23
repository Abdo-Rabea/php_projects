<!-- login form -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Login</title>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <form action="../../includes/login.inc.php" method="POST">
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="pwd" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="./register.php">Register</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>