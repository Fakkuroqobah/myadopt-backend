<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAdopt</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background: #EC877D;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar .nav-link {
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #d36f67;
        }

        .content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #fff;
        }

        .navbar-light {
            background-color: #EC877D;
        }

        .navbar-light .navbar-brand,
        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-light .navbar-toggler-icon {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <?php $current_page = basename($_SERVER["PHP_SELF"]); ?>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h2 class="text-center mb-4">MyAdopt</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" href="index.php">Pengajuan Adopsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page == 'hewan.php' ? 'active' : ''; ?>" href="hewan.php">Hewan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page == 'pengguna.php' ? 'active' : ''; ?>" href="pengguna.php">Pengguna</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
       