<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        overflow-x: hidden;
    }
    .navbar {
        background-color: transparent;
        display: flex;
        padding: 10px;
        justify-content: space-between;
        align-items: center;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        font-size: 20px;
    }

    .navbar-collapse form ul {
        display: flex;
        gap: 10px;
    }

    .navbar-collapse form ul li {
        list-style: none;
    }

    .navbar-collapse form ul li a {
        text-decoration: none;
        color: white;
    }
</style>
<nav class="navbar mynavbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">blood-bank Management System</a>

    <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav mr-auto"></ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="userdashboard.php">Home</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="joinus.php">Join Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="userstock.php">Make Request</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            </ul>
        </form>
    </div>
</nav>