  
     <li class="nav-item">
          <a class="nav-link active" href="<?php
           if($_SESSION['user_level'] == 0) echo 'members-page.php';
           else if($_SESSION['user_level'] == 1) echo 'admin-page.php';
           else if($_SESSION['user_level'] == 2) echo 'finance-employee.php';
           else if($_SESSION['user_level'] == 3) echo 'finance-manager.php';
           else if($_SESSION['user_level'] == 4) echo 'owner.php';
           ?>" id="home">Home</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="add-project.php" id="page-2"><i class="las la-ad"></i>Add Project</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="view-projects.php" id="page-2"><i class="las la-ad"></i>View Projects</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="view-assignments.php" id="page-2"><i class="las la-ad"></i>Work Assignment</a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="view-profile.php" id="page-2"><i class="las la-ad"></i>View Profile</a>
  </li>
  
    