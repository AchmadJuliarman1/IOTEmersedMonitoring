<?php 
$file_name = explode('/', $_SERVER['PHP_SELF'])[2];
 ?>
<style>
    .sidebar {
      height: 100vh;
      width: 15vw;
      font-size: 0.7vw;
      font-family: "Roboto Mono", monospace;
      background-color: #212544;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      position: fixed;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.7);
    }
    .sidebar .nav{
      height: 100%;
    }
    .sidebar .nav-link {
      color: white;
      transition: background-color 0.3s, color 0.3s;
      border-radius: 5px;
    }
    .sidebar .nav-link:hover {
      background-color: #dce5ff;
      color: #007bff;
    }
    .upgrade-section {
      margin-top: auto;
      text-align: center;
      background-color: #e8f0ff;
      padding: 15px;
      border-radius: 5px;
    }
    .upgrade-section a {
      text-decoration: none;
      font-weight: bold;
    }
    .nav-link.active{
      background-color: #dce5ff;
      color: black;
    }
    .nav:hover> :not(:hover) {
      filter:blur(0.8px);
      opacity: 0.6;
      transition: 0.5s;
    }
    /*.sidebar .nav-item:last-child {
      margin-top: auto; /* This pushes the last nav-item to the bottom */
    }*/
    .sidebar + * {
      margin-left: 17vw;
    }
</style>
</head>
<body>
  <div class="d-flex">  
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
      <ul class="nav flex-column mt-4">
        <li class="nav-item mb-2">
          <a href="periodik.php" class="nav-link <?= $file_name == "periodik.php" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
                <img src="icons/periodik.png" style="width: 2vw ;"> <div class="px-1">Data Periodik</div>
            </div>
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="index.php" class="nav-link <?= $file_name == "index.php" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
                <img src="icons/realtime.png" style="width: 2vw ;"> <div class="px-1">Data Realtime</div>
            </div>
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="perbandingan.php" class="nav-link <?= $file_name == "perbandingan.php" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
              <img src="icons/perbandingan.png" style="width: 2vw ;"> <div class="px-1">Perbandingan</div>
            </div>
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="input.php" class="nav-link <?= $file_name == "input.php" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
              <img src="icons/input.png" style="width: 2vw ;"> <div class="px-1">Input Data</div>
            </div>
          </a>
        </li>
      </ul>
    </nav>
    
