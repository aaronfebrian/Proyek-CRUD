<?php
session_start();
include '../connection.php';
if ($_SESSION['role'] !== 'Admin' || !(isset($_SESSION['user']))) {
      header('location: http://localhost:8080/wpw/proyek');
}
$connect->exec("USE proyek");

if (isset($_POST['delete'])) {
      try {
            $idBarang = $_POST['selectedNrp'];
            $connect->exec("USE proyek");
            $query = "DELETE FROM barang WHERE id_barang = :idBarang";
            $statement = $connect->prepare($query);
            $statement->bindParam(':idBarang', $idBarang);
            $statement->execute();
      } catch (PDOException $e) {
            echo $e->getMessage();
      }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tools Management</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <!-- font -->
      <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <style>
            *,
            *:before,
            *:after {
                  box-sizing: border-box;
                  margin: 0;
                  padding: 0;
            }

            a {
                  text-decoration: none;
            }

            body {
                  font-family: 'Viga';
                  background: #f7f7f7;
            }

            .table-view {
                  height: 300px;
            }

            table {
                  max-height: 300px;
            }

            .menu-dashboard {
                  background-color: #354458;
                  width: 20%;
                  position: sticky;
                  color: white;
                  padding: 0px;
                  padding-top: -30px;
            }

            .user {
                  width: 70%;
                  height: 45px;
                  background-color: aqua;
            }

            .bar {
                  background-color: #44a0dc;
                  z-index: 999;
                  padding-right: 70px;
                  padding-left: 70px;
            }

            .navigasi .fitur:hover {
                  background-color: #28333e;
            }

            .fitur {
                  height: 55px;
                  border-radius: 0px;
                  width: 100%;
            }

            .fitur a {
                  font-size: 16px;
            }
      </style>
      <script>
            $(document).ready(function() {
                  $("#myModal").modal('show')
            })
      </script>
</head>

<body class="" style="background-color: #ddd;">
      <div class="container-fluid">
            <div class="bar fixed-top shadow d-flex justify-content-between align-items-center" style="height: 50px; " data-bs-theme="dark">
                  <h4 class=" text-white mt-2">Smart Laboratory Equipment Loan System</h4>
            </div>

            <div class=" row mt-5">
                  <div class="col-3 menu-dashboard rounded-end shadow d-flex justify-content-center flex-column align-content-between" style="margin-top:-60px; min-height: 102vh;">
                        <div class="d-flex flex-column justify-content-center  navigasi ">
                              <div style="margin-left:40px" class="pt-3 mb-5 ">
                                    <?php
                                    if (isset($_SESSION['user'])) : ?>
                                          <h5>
                                                <?php echo $_SESSION['user'] ?>
                                          </h5>
                                          <p>
                                                <?php echo $_SESSION['role'] ?>
                                          </p>
                                    <?php endif ?>
                              </div>
                              <div class="btn fitur d-flex justify-content-center align-items-center" style="padding-right: 105px;width:100%;"><span class="text-white  material-symbols-outlined">
                                          home
                                    </span><a class="text-white align-items-center" href="">&#160;&#160;Beranda</a></div>
                              <?php
                              if (isset($_SESSION['user'])) { ?>

                                    <div class="btn fitur d-flex justify-content-center align-items-center" style="padding-right: 40px"><span class="text-white  material-symbols-outlined">
                                                edit_note
                                          </span><a class="text-white align-items-center" href="../peminjaman/">&#160;&#160;Data Peminjaman</a></div>
                                    <div class="btn fitur d-flex justify-content-center align-items-center"><span class="text-white  material-symbols-outlined">
                                                home_repair_service
                                          </span><a class="text-white align-items-center" href="../invman/">&#160;&#160;Manajemen Peralatan</a></div>
                                    <div class="btn fitur d-flex justify-content-center align-items-center">&#160;&#160;<span class="text-white  material-symbols-outlined">
                                                manage_accounts
                                          </span><a class="text-white align-items-center" href="../userman/">&#160;&#160;Manajemen Pengguna</a></div>
                                    <form method="post" class="d-flex justify-content-center fitur" style="padding-right: 100px">
                                          <button name="logout" type="submit" formaction="../logout.php" class=" btn text-white d-flex align-items-center justify-content-center" style="border-radius:0px; height:50px;width: 100%;">
                                                <span class="material-symbols-outlined">
                                                      logout
                                                </span>&#160;&#160;Logout
                                          </button>
                                    </form>
                              <?php } else if (!(isset($_SESSION['user']))) { ?>
                                    <div method="post" class="d-flex justify-content-center fitur" style="padding-right: 100px">
                                          <a name="login" type="submit" class=" btn text-white d-flex align-items-center justify-content-center" style="border-radius:0px; height:50px;width: 100%;" href="../proyek/login/">
                                                <span class="material-symbols-outlined">
                                                      logout
                                                </span>&#160;&#160;Login
                                          </a>
                                    </div>
                              <?php } ?>
                        </div>
                  </div>
                  <!-- table section -->
                  <div class="col-9  ms-auto me-auto bg-white rounded-2 pt-3 " style="max-height:80vh; margin-top: 30px;">
                        <div class="d-flex align-items-center  justify-content-between ps-1 pe-4 mb-2">
                              <button class="btn-primary btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                    </svg><a href="form.php" class="text-white">Tambah</a>
                              </button>
                        </div>
                        <div class="table-view overflow-auto" style="height:80%;">
                              <table class="table table-striped ">
                                    <tr>
                                          <thead>

                                                <th scope="col">No.</th>
                                                <th scope="col">Id Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Tersedia / Jumlah</th>
                                                <th scope="col" class="ms-5">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                          include '../connection.php';
                                          $connect->exec("USE proyek");
                                          $query = "SELECT * FROM barang";
                                          $statement = $connect->prepare($query);
                                          $statement->execute();
                                          $users = $statement->fetchAll();
                                          $i = 1;
                                          foreach ($users as $barang) {  ?>
                                                <tr>
                                                      <td><?php echo $i; ?></td>
                                                      <td><?php echo $barang['id_barang']; ?></td>
                                                      <td><?php echo $barang['nama_barang']; ?></td>
                                                      <td class="ps-5"><?php echo $barang['tersedia'] . '/' . $barang['jumlah'] ?></td>
                                                      <td class="d-flex justify-content-start">
                                                            <form method="GET" action="update.php">
                                                                  <button class="btn btn-warning" name="update" value="<?= $barang['id_barang']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                        </svg></button>
                                                            </form>
                                                            <form method="POST" action="">
                                                                  <input type="hidden" name="selectedNrp" value="<?= $barang['id_barang'];  ?>">
                                                                  <button class="btn btn-danger" name="delete">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                        </svg>
                                                                  </button>
                                                            </form>
                                                      </td>
                                                </tr>
                                          <?php $i++;
                                          } ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>

            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.6.1.min.js"></script>
            <script>
                  $(document).ready(function() {
                        $("#limit-records").change(function() {
                              $('form').submit();
                        })
                  })
            </script>
            <?php

            ?>
</body>

</html>