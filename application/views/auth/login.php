<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    
    <!-- Vendor Resource -->
    <!-- Google Material Icon Sharp -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f411181642.js" crossorigin="anonymous"></script>
    <!-- JQuery 3.7.0 -->
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-3.7.0.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Data Table -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    
    <!-- Home Resource -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">
    
    <title>GoComplaint Admin Dashboard</title>
</head>
<body>
    <div class="container flex-center flex-colomn">
        <div class="top-card logo flex-center flex-colomn">
            <img src="https://storage.googleapis.com/go-complaint-bucket/assets/logo.svg" alt="">
            <h1 class="header white">
                <span class="light-green">Go</span>Complaint
            </h1>
        </div>
        <div class="card flex-center flex-colomn ">
            <h1 class="header margin-y-1 primary">
                    Admin <span class="success">Login</span>
            </h1>
            <div class="body">
                <form method="POST">
                    <div class="form-input flex-start flex-colomn">
                        <label for="email"><b>Email</b></label>
                        <input type="email" id="email">
                    </div>

                    <div class="form-input flex-start flex-colomn margin-y-1">
                        <label for="password"><b>Password</b></label>
                        <input type="password" id="password">
                    </div>

                    <button class="form-btn margin-y-1">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>