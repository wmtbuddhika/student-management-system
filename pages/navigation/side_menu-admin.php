<ul class="x-navigation">
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
    <li class="xn-openable active">
    <li class="xn-openable">
        <a href="#"><span class="fa fa-registered"></span>Registration Management</a>
        <ul>
            <li><a href="../../tutor-management.php"><span class="fa fa-inbox"></span>Tutor Management</a></li>
            <li><a href="../../student-management.php"><span class="fa fa-file-text"></span> Student Management</a></li>
            <li><a href="../../batch-management.php"><span class="fa fa-file-text"></span> Batch Management</a></li>
            <li><a href="../../module-management.php"><span class="fa fa-file-text"></span> Module Management</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-dribbble"></span>Student Management</a>
        <ul>
            <li><a href="../../student-allocation.php"><span class="fa fa-adjust"></span>Student Allocation</a></li>
        </ul>
    </li>
    </li>
</ul>