  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="<?= base_url('assets/dist/img/user/wawa.jpg') ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <a href="#" class="d-block">
                  <?php $name = $user['user_name'] ?>
                  <?php $count = 0; ?>
                  <?php $name_d = explode(' ', $name); ?>
                  <?php foreach ($name_d as $n) : ?>
                      <?php if ($count < 15) : ?>
                          <?php $count += strlen($n); ?>
                          <?= $n ?>
                      <?php else : ?>
                          <br>
                          <?php $count = 0; ?>
                          <?= $n ?>
                      <?php endif; ?>
                  <?php endforeach; ?>
              </a>
          </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- dashbaord -->
              <li class="nav-item">
                  <a href="index.php" class="nav-link <?php if ($title == 'Dashboard') : ?> active <?php endif; ?>">
                      <i class="nav-icon fas fa-grip"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>
              <!-- HOME ELECTRICAL APPLIANCES -->
              <li class="nav-item">
                  <a href="home_electrical_appliances.php" class="nav-link <?php if ($title == 'Home Electrical Appliances') : ?> active <?php endif; ?>">
                      <i class="nav-icon fas fa-tv"></i>
                      <p style="font-size: 14px;">
                          Home Electrical Appliances
                      </p>
                  </a>
              </li>
              <!-- Monthly Analsis -->
              <li class="nav-item">
                  <a href="monthly_analysis.php" class="nav-link <?php if ($title == 'Monthly Analysis') : ?> active <?php endif; ?>">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                          Monthly Analysis
                      </p>
                  </a>
              </li>
              <!-- myaccount -->
              <li class="nav-item">
                  <a href="myaccount.php" class="nav-link <?php if ($title == 'My Account') : ?> active <?php endif; ?>">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                          My Account
                      </p>
                  </a>
              </li>
              <!-- logout -->
              <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      <p>
                          Logout
                      </p>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->