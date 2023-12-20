<div class="right-section">
    <!-- Nav Section -->
    <div class="nav">
        <button id="menu-btn">
            <span class="material-icons-sharp">
                menu
            </span>
        </button>

        <div class="dark-mode">
            <span class="material-icons-sharp active">
                light_mode
            </span>
            <span class="material-icons-sharp">
                dark_mode
            </span>
        </div>

        <div class="profile">
            <div class="info">
                <p>Hey, <b><?=$user?></b></p>
                <small class="text-muted">Admin</small>
            </div>
            <div class="profile-photo">
                <!-- <img src="<?=base_url()?>assets/image/profile/profil0.jpg" alt="profile-photo"> -->
            </div>
        </div>
    </div>
    <!-- End of Nav Section -->

    <!-- Company/App Profile Section -->
    <div class="app-profile">
        <div class="logo">
            <h2>Go<span class="primary">Complaint</span></h2>
            <p>Admin Web Application</p>
        </div>
    </div>
    <!-- End of Company/App Profile Section -->

    <!-- Total Complaint Section -->
    <div class="tot-complaint">
        <div class="header">
            <h2>
                Total Complaint <?=$year?>
            </h2>
            <span class="material-icons-sharp">
                summarize
            </span>
        </div>
        <div class="data-tot-complaint" onclick="window.location = '<?=base_url()?>'">
            <div class="icon">
                <span class="material-icons-sharp">
                    article
                </span>
            </div>

            <div class="content">
                <div class="info">
                    <h2>All Complaint </h2>
                    <b><?=$tot_complaint?> Complaint</b>
                </div>
            </div>
        </div>
        <div class="data-tot-complaint" onclick="window.location = '<?=base_url()?>?filter=urgent'">
            <div class="icon">
                <span class="material-icons-sharp">
                    article
                </span>
            </div>

            <div class="content">
                <div class="info">
                    <h2>Urgent </h2>
                    <b class="primary"><?=$tot_urgent?> Complaint</b>
                </div>
            </div>
        </div>
        <div class="data-tot-complaint" onclick="window.location = '<?=base_url()?>?filter=not_urgent'">
            <div class="icon">
                <span class="material-icons-sharp">
                    article
                </span>
            </div>

            <div class="content">
                <div class="info">
                    <h2>Not Urgent </h2>
                    <b class="text-muted"><?=$tot_not_urgent?> Complaint</b>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Total Complaint Section -->
</div>