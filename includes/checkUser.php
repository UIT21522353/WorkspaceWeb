<ul class="navbar-nav ms-auto">
              <?php
              if (isset($_SESSION['auth'])) {
              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['auth_user']['name'];   ?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="myOrder.php">My Orders</a></li>
                    <li><a class="dropdown-item" href="myProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </li>
              <?php
              } else {
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              <?php
              }
              ?>
            </ul>
