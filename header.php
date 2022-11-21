<nav>
    <input type="checkbox" id="check">
    <label for="check" class="check-button">
        <i class="fas fa-bars"></i>
    </label>
    <?php

    switch($_SESSION["typeID"]){
        case 1: 
            echo "<label class='logo'><a href='student.php'>School Logo</a></label>";
            break;

        case 2:
            echo "<label class='logo'><a href='teacher.php'>School Logo</a></label>";
            break;

        case 3:
            echo "<label class='logo'><a href='admin.php'>School Logo</a></label>";
            break;

        default: # if user is not logged in, redirect them to the login page.
            header('Location: index.php');
    }

    echo "<ul>";

        #checking to see if user is logged in or not
        switch($_SESSION["typeID"]){
            case 1: 
                echo"<li><a href='student.php'>Home</a></li>";
                echo "<li><a href='clubs.php'>Choose Clubs</a></li>";
                echo "<li><a href='passives/logout.php'>Sign OUT</a></li>";

                break;

            case 2:
                echo "<li><a href='teacher.php'>Home</a></li>";
                echo "<li><a href='teacher-post-message.php'>Post Message</a></li>";
                echo "<li><a href='passives/logout.php'>Log OUT</a></li>";

                break;

            case 3:
                echo "<li><a href='admin.php'>Users</a></li>";
                echo "<li><a href='create-clubs.php'>Clubs/Activities</a></li>";
                echo "<li><a href='student-selections.php'>Student Selections</a></li>";
                echo "<li><a href='supervisors.php'>Supervisors</a></li>";
                echo "<li><a href='admin-view-messages.php'>View Messages</a></li>";

                echo "<li><a href='passives/logout_admin.php'>Log OUT</a></li>";
                break;

            default: # if user is not logged in, redirect them to the login page.
                echo "<li><a href='passives/logout.php'>Log IN</a></li>";
                header('Location: index.php');
        }
    ?>

</nav>