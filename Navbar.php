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
        padding: 10px;
    }
    .navbar a{
        color: white;
        text-decoration: none;
        font-size: 20px;
    }
    .navbar-collapse ul{
        display: flex;
        gap: 10px;
    }
    .navbar-collapse ul li{
        list-style: none;
    }
    .navbar-collapse ul li a {
        text-decoration: none;
        color: white;
    }
</style>
<nav class="navbar mynavbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">blood-bank Management System</a>

    <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="adminhome.php">Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="deletea.php">Delete Records</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="updatea.php">Update Information</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="adminstock.php">Review Stocks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="requests.php">Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminlogout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
