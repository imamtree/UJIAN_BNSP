<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Sidebar</title>
    <style>
        /* Mengubah warna teks sidebar link menjadi hitam */
        .sidebar-link {
            color: black !important;
        }

        /* Mengubah warna latar belakang sidebar link menjadi pink */
        .sidebar-link {
            background-color: rgb(232, 9, 9) !important;
        }
    </style>
</head>
<body>
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="http://127.0.0.1:8000/dashboard" aria-expanded="false">
                    <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="http://127.0.0.1:8000/employee" aria-expanded="false">
                    <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                    <span class="hide-menu">Data Pegawai</span>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>
