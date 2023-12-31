<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="bootstrap.min.css">
      <style>
            * {
                  margin: 0;
                  padding: 0;
                  font-family: 'Viga'
            }
      </style>
</head>

<body>
      <div class="container">
            <h1 class="d-flex justify-content-center">DATA PEMINJAMAN</h1>
            <table class="table table-bordered border-primary">
                  <thead>
                        <tr>
                              <th scope="col">NO.</th>
                              <th scope="col">Nama Peminjam</th>
                              <th scope="col">Barang yang Dipinjam</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Tanggal Pengembalian</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        include('connection.php');
                        $connect->exec("USE proyek");
                        $user = $_SESSION['user'];
                        $sesStmnt = "SELECT nama_user FROM user WHERE username = '$user'";
                        $statement = $connect->prepare($sesStmnt);
                        $statement->execute();
                        // $query = "SELECT peminjaman.id_user, peminjaman.barang, peminjaman.quantity, peminjaman.tanggal_pengembalian FROM peminjaman JOIN user ON user.id_user = peminjaman.user_id GROUP BY peminjaman.id_user";
                        $query = "SELECT peminjaman.id_user, peminjaman.barang, peminjaman.quantity, peminjaman.tanggal_pengembalian FROM peminjaman JOIN user ON user.id_user = peminjaman.id_user GROUP BY peminjaman.id_user, peminjaman.barang, peminjaman.quantity, peminjaman.tanggal_pengembalian ";
                        $result = $connect->prepare($query);
                        $result->execute();

                        $nomor = 1;

                        while ($row = $result->fetch()) { ?>
                              <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $row['id_user'] ?></td>
                                    <td><?= $row['barang'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['tanggal_pengembalian'] ?></td>
                              </tr>
                        <?php $nomor++;
                              break;
                        }
                        ?>
                  </tbody>
            </table>
            <div class="gap-2 mt-3 d-flex justify-content-center">
                  <a class="nav-link" href="index.php"><input class="btn btn-success" type="submit" value="Selesai" name="selesai"></a>
            </div>
      </div>
</body>

</html>