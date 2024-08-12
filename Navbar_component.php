<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        overflow-x: hidden;
    }
    .navbar {
        background-color:transparent;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        padding: 10px;
        left: 0;
        width: 100%;
    }
    .navbar a{
        color: white;
        text-decoration: none;
        font-size: 20px;
    }
    .navbar-collapse form ul{
        display: flex;
        gap: 10px;
    }
    .navbar-collapse form ul li{
        list-style: none;
    }
    .navbar-collapse form ul li a {
        text-decoration: none;
        color: white;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top p-md-3">
    <a class="navbar-brand" href="index.php">blood-bank Management System</a>

    <div class="collapse navbar-collapse" id="mynavbar">
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link mnav" href="index.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mnav" href="register.php">User Registration</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link mnav" href="adminlogin.php">Admin Login</a>
                </li>
            </ul>
        </form>
    </div>
</nav>