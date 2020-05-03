<ul class="x-navigation">
    <li class="">
        <a href="../../home.php">Student Management System</a>
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
                <div class="profile-data-title">Student</div>
            </div>
        </div>
    </li>

    <li><a> </a></li>
    <li class="page-title">
        <a style="color: yellowgreen">Resources</a>
    </li>

    <li><a href="../../chat-management.php"><span class="fa fa-television"></span>Messenger</a></li>
    <li><a href="../../meeting-management.php"><span class="fa fa-calendar"></span>Meetings</a></li>
    <li><a href="../../document-management.php"><span class="fa fa-file"></span>File Uploads</a></li>
    <li><a href="../../blog-management.php"><span class="fa fa-terminal"></span>Blogger</a></li>
</ul>