<?php
include "conn.php";
include "session.php";
 
$role = $_SESSION['role'];
$itteam_id = $_SESSION['itteam_id'];
$sql = "SELECT name FROM it_team WHERE itteam_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itteam_id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
$conn->close();
 
function getInitials($nameinitials) {
    $initials = "";
    $name_parts = explode(" ", $nameinitials);
    foreach ($name_parts as $part) {
        $initials .= strtoupper($part[0]);
    }
    return $initials;
}
$_SESSION['initials'] = getInitials($name);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Asset Gudang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/dashboard.css?v=1.6">
    <script src="js/script.js"></script>
 
    <!-- script khusus pergantian tabel -->
    <script>
        $(document).ready(function() {
            var trigger = $('#sidebar ul li a'),
                triggerpage = $('#sidebar a'),
                triggerprofile = $('#header ul li #prof'),
                container = $('#table-content'),
                containerpage = $('#page-content');

            trigger.on('click', function() {
                var $this = $(this),
                    target = $this.data('target');
                console.log(target);
                containerpage.load(target + '.php');
                return false;
            });
 
            triggerpage.on('click', function(){
                var $this = $(this),
                    target = $this.data('target');
                console.log(target);
                containerpage.load(target + '.php');
                return false;
            });

            triggerprofile.on('click', function(){
                var $this = $(this),
                    target = $this.data('target');
                console.log(target);
                containerpage.load(target + '.php');
                return false;
            });
 
            // Check if the load parameter is set in the URL
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('load')) {
                var loadTarget = urlParams.get('load');
                containerpage.load(loadTarget + '.php');
            }
        });
    </script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="dashboard" id="home-link" ><i class="fas fa-home"></i> Home</a>
 
        <?php
        $role = $_SESSION['role'];
        if ($role === 'Super User'): ?>      
        <a href="manage_users.php" data-target="user"><i class="bi bi-people"></i> Users</a>
        <?php endif; ?>
 
        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#asset" aria-expanded="true" aria-controls="asset">
            <i class="bi bi-pc-display"></i>
            <span>Asset <i class="bi bi-chevron-down"></i> </span>
        </a>
        <ul id="asset" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item ms-3">
                <a href="#" class="sidebar-link fs-6" data-target="stocktable">Stock</a>
            </li>
            <li class="sidebar-item ms-3">
                <a href="#" class="sidebar-link fs-6" data-target="inusetable">Active</a>
            </li>
            <li class="sidebar-item ms-3">
                <a href="#" class="sidebar-link fs-6">Accessories</a>
            </li>
            <li class="sidebar-item ms-3">
                <a href="#" class="sidebar-link fs-6">Complementary</a>
            </li>
        </ul>
        <a href="home" data-target="checkout"><i class="bi bi-layers"></i> Checkout </a>
        <a href="home"><i class="bi bi-archive"></i> Return </a>
       
    </div>
            
    <div class="header" id="header">
        <div class="icons">
            <div class="dropdown">
                <i class="profile-avatar me-5"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data>
                    <?php echo $_SESSION['initials']; ?>
                </i>
                <ul class="dropdown-menu mt-3" aria-labelledby="profileDropdown">
                    <p class="profile ms-3 mt-2" style="text-align:left; margin-bottom: 0px;"><b><?php echo htmlspecialchars($name); ?></b></p>
                    <p class="profile ms-3" style="text-align:left; margin-top: 0px;"><?php echo htmlspecialchars($role); ?></p>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" id="prof" href="#" data-target="view_profile"><i class="fas fa-user-alt"></i>View Profile</a></li>
                    <li><a class="dropdown-item" id="prof" href="#"><i class="fas fa-lock"></i>Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                
                </ul>
            </div>
        </div>
    </div>
    <div class="content" id="page-content">
        <h1>Welcome to Dashboard, <?php echo htmlspecialchars($name); ?>!</h1>
    </div>  
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    document.getElementById('home-link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        window.location.href = 'dashboard.php'; // Redirect to dashboard.php
        });
    </script>
</body>
</html>
<?