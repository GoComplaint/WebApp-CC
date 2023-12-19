<aside>
    <div class="toggle">
        <div class="logo">
            <!-- <img src="<?=base_url()?>assets/image/content/logo1.png" alt="Asthito"> -->
        </div>
        <div class="logo-name">
            <h2>Go<span class="primary">Complaint</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">
                close
            </span>
        </div>
    </div>

    <div class="sidebar">
        <!-- Note: Could be automaticly generate based on data in database -->
        <a href="" class="<?=$current_page=='dashboard'?'active':''?>">
            <span class="material-icons-sharp">
                dashboard
            </span>
            <h3>Dashboard</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">
                logout
            </span>
            <h3>Log Out</h3>
        </a>
    </div>
</aside>