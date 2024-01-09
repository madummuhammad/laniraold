<?php 

session_start();

if ($_SESSION['role'] == 'admin') {
  echo "<script>alert('anda tidak diberikan akses');</script>";
  echo "<script>location='index.php';</script>";
  exit();
}

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
  ?>
  <!DOCTYPE html>

  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DND</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">


    <style type="text/css">
      table {
        border-collapse: collapse;
        width: 100%;
      }

      thead {
        background-color: #f2f2f2;
      }

      th, td {
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      a {
        color: #007bff;
      }

      .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
      }

      .page-item {
        margin: 0 5px;
      }

      .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
      }

      .page-link {
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        transition: all 0.3s ease-in-out;
      }

      .page-link:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
      }

      .page-link:focus {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      }

      .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
      }

      .page-item.disabled .page-link:hover {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
      }

      .page-item:first-child .page-link {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
      }

      .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
      }

    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">



      <?php include "include/sidebar.php" ?>

      <div class="content-wrapper">
        <div class="content">
          <div class="container-fluid"><br>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <a class="btn btn-primary" href="#" role="button">Add Member</a> -->
                  </div>
                  <div class="card-body table-responsive p-0">

                    <?php
                    // include "../config/conn.php";

                    // $per_page = 10;
                    // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    // $start = ($page - 1) * $per_page;

                    // $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

                    // $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // $query = "SELECT oi.product_name, ps.size, m.nama, SUM(oi.qty) AS total_sold
                    // FROM orders_item oi
                    // JOIN product_sizes ps ON oi.size_id = ps.id
                    // JOIN orders o ON oi.order_id = o.id
                    // JOIN members m ON o.member_id = m.id";
                    // if (!empty($filter)) {
                    //   $query .= " WHERE oi.product_name = '$filter'";
                    // }

                    // if (!empty($search)) {
                    //   $query .= " WHERE oi.product_name LIKE '%$search%'";
                    // }

                    // $query .= " GROUP BY oi.product_name, ps.size, m.nama
                    // ORDER BY total_sold ASC
                    // LIMIT $start, $per_page";

                    // $total_query = "SELECT COUNT(*) AS total FROM ($query) AS count_table";
                    // $total_result = mysqli_query($conn, $total_query);
                    // $total_row = mysqli_fetch_assoc($total_result)['total'];

                    // $result = mysqli_query($conn, $query);
                    // $pages = ceil($total_row / $per_page);
                    include "../config/conn.php";
                    // $query = "SELECT oi.product_id, p.name AS product_name, oi.size_id, ps.size AS size_name, SUM(oi.qty) AS total_qty
                    // FROM orders_item oi
                    // JOIN products p ON oi.product_id = p.id
                    // JOIN product_sizes ps ON oi.size_id = ps.id
                    // GROUP BY oi.product_id, oi.size_id";

                    // $result = mysqli_query($conn, $query);

                    // if (mysqli_num_rows($result) > 0) {
                    //   while ($row = mysqli_fetch_assoc($result)) {
                    //     $product_id = $row['product_id'];
                    //     $product_name = $row['product_name'];
                    //     $size_id = $row['size_id'];
                    //     $size_name = $row['size_name'];
                    //     $total_qty = $row['total_qty'];

                    //     echo "Product ID: " . $product_id . "<br>";
                    //     echo "Product Name: " . $product_name . "<br>";
                    //     echo "Size ID: " . $size_id . "<br>";
                    //     echo "Size Name: " . $size_name . "<br>";
                    //     echo "Total Quantity: " . $total_qty . "<br>";
                    //     echo "<br>";
                    //   }
                    // } else {
                    //   echo "Tidak ada data yang ditemukan.";
                    // }

                    // mysqli_close($conn);


                    $per_page = 10;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($page - 1) * $per_page;

                    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    $query = "SELECT oi.product_name, ps.size, SUM(oi.qty) AS total_sold
                    FROM orders_item oi
                    JOIN product_sizes ps ON oi.size_id = ps.id
                    JOIN orders o ON oi.order_id = o.id
                    JOIN members m ON o.member_id = m.id";

                    if (!empty($filter)) {
                      $query .= " WHERE oi.product_name = '$filter'";
                    }

                    if (!empty($search)) {
                      if (empty($filter)) {
                        $query .= " WHERE oi.product_name LIKE '%$search%'";
                      } else {
                        $query .= " AND oi.product_name LIKE '%$search%'";
                      }
                    }

                    $query .= " GROUP BY oi.product_name, ps.size
                    ORDER BY total_sold ASC";

                    $total_query = "SELECT COUNT(*) AS total FROM ($query) AS count_table";
                    $total_result = mysqli_query($conn, $total_query);
                    $total_row = mysqli_fetch_assoc($total_result)['total'];

                    $query .= " LIMIT $start, $per_page";

                    $result = mysqli_query($conn, $query);
                    $pages = ceil($total_row / $per_page);
                    ?>

                    <h4>Produk Terjual</h4>
                    <form action="" method="GET" class="form-inline">
                      <div class="form-group mr-2">
                        <input type="text" name="search" id="search" class="form-control" value="<?php echo $search; ?>" placeholder="Search Produk">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Filter & Search</button>
                      <a href="sold.php" class="btn btn-secondary mr-2">Reset</a>
                      <button class="btn btn-success" type="button" onclick="exportToExcel('<?php echo $search; ?>')">Export to Excel</button>
                    </form>

                    <br>
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Produk Name</th>
                          <th>Size</th>
                          <th>Terjual</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $total = 0;
                        while ($data = mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?php echo $data['size']; ?></td>
                            <td><?php echo $data['total_sold']; ?></td>
                          </tr>
                          <?php
                          $total+=$data['total_sold'];
                        }
                        ?>
                        <tr>
                          <td colspan="2">Total</td>
                          <td><?php echo $total; ?></td>
                        </tr>
                      </tbody>
                    </table>

                    <script>
                      function exportToExcel(search) {
                        let url = 'export/export_excel_sold.php';

                        if (search) {
                          url += '?search=' + encodeURIComponent(search);
                        }

                        window.open(url);
                      }
                    </script>

                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php if ($page > 1) { ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>
                          <li class="page-item <?php if ($i == $page) echo 'active' ?>"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>

                        <?php if ($page < $pages) { ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                        <?php } ?>
                      </ul>
                    </nav>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>

      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>Copyright &copy;2023
        </footer>
      </div>


      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/dist/js/adminlte.min.js"></script>
    </body>
    </html>
    <?php 
  }else{
    echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
  }
  ?>
