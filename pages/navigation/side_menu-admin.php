<ul class="x-navigation">
    <li class="">
        <a href="../../home.php" class="text-center">Student Management System</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <div class="profile">
            <a href="../../home.php">
                <div class="profile-image">
                    <img src="../../assets/images/users/dummy-350x350.png" alt="<?php echo $_SESSION['user_name']; ?>"/>
                </div>
            </a>
            <div class="profile-data">
                <div class="profile-data-name"><?php echo $_SESSION['user_name']; ?></div>
                <div class="profile-data-title">System Administrator</div>
            </div>
        </div>
    </li>

    <li class="page-title">
        <a style="color: yellowgreen">Registrations</a>
    </li>

    <li><a href="../../tutor-management.php"><span class="fa fa-file-text"></span>Tutor Registration</a></li>
    <li><a href="../../student-management.php"><span class="fa fa-file-text"></span> Student Registration</a></li>
    <li><a href="../../batch-management.php"><span class="fa fa-file-text"></span> Batch Registration</a></li>
    <li><a href="../../module-management.php"><span class="fa fa-file-text"></span> Module Registration</a></li>
    <li><a href="../../group-management.php"><span class="fa fa-file-text"></span> Group Registration</a></li>

    <li class="page-title">
        <a style="color: yellowgreen">Allocations</a>
    </li>

    <li><a href="../../student-allocation.php"><span class="fa fa-adjust"></span>Student Allocation</a></li>


    <li class="xn-openable active">
        <li class="xn-openable">
            <a href="#" style="color: yellowgreen"></span>User Resources</a>
            <ul>
                <li><a href="../../chat-management.php"><span class="fa fa-television"></span>Messenger</a></li>
                <li><a href="../../meeting-management.php"><span class="fa fa-calendar"></span>Meetings</a></li>
                <li><a href="../../document-management.php"><span class="fa fa-file"></span>File Uploads</a></li>
                <li><a href="../../blog-management.php"><span class="fa fa-terminal"></span>Blogger</a></li>
            </ul>
        </li>
    </li>
</ul>