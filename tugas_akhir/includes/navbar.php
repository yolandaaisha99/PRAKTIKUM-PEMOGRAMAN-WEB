<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="/tugas_akhir/index.php">
      <i class="bi bi-egg-fried"></i> Dapoer Nusantara
    </a>

    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="/tugas_akhir/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="/tugas_akhir/pages/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="/tugas_akhir/pages/register.php">Register</a>
        </li>

        <!-- Dropdown Login -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle fw-semibold"
            href="#"
            id="loginDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Login
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
            <li>
              <a class="dropdown-item" href="/tugas_akhir/login_user.php">
                <i class="bi bi-person-circle me-2"></i>Login as User
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="/tugas_akhir/admin/login_admin.php">
                <i class="bi bi-shield-lock-fill me-2"></i>Login as Admin
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
