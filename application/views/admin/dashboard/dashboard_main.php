<script>
    $(function () {
        $("#dataviews").DataTable({ 
            "autoWidth": true,
            "pagingType": "numbers",
            "lengthChange": false
        });
    });
 
</script>

<main>
    <!-- Page Title -->
    <h1>
        <?=$title?>
    </h1>

    <!-- Analysis Section -->
    <div class="analysis-section">
        <h2>Analysis for <span class="primary"><?=$year?></span></h2>
        <div class="analysis">
            <!-- Note: Could be automaticly generate based on data in database -->
            <div class="complaint-open" onclick="window.location = '<?=base_url()?>?status=o'">
                <div class="status stationary">
                    <div class="info">
                        <h3>
                            Complaint Open
                        </h3>
                        <h1>
                            <?=$tot_open?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="complaint-on-working" onclick="window.location = '<?=base_url()?>?status=p'">
                <div class="status warning">
                    <div class="info">
                        <h3>
                            Complaint On Working
                        </h3>
                        <h1>
                            <?=$tot_on_working?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="complaint-success" onclick="window.location = '<?=base_url()?>?status=y'">
                <div class="status success">
                    <div class="info">
                        <h3>
                            Complaint Success
                        </h3>
                        <h1>
                            <?=$tot_success?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="complaint-close" onclick="window.location = '<?=base_url()?>?status=n'">
                <div class="status danger">
                    <div class="info">
                        <h3>
                            Complaint Closed
                        </h3>
                        <h1>
                            <?=$tot_closed?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Analysis Section -->

    <!-- Data Complaint Table Section -->
    <div class="data-table">
        <!-- Note: Could be automaticly generate based on data in database -->
        <h2>Latest Complaint</h2>
        <table id="dataviews" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fullname</th>
                    <th>Complaint</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Prediction</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Cahyadi Yoga</td>
                    <td>Aduh ternyata di jalan raya deket rumah saya banyak berlubang</td>
                    <td>INFRASTRUKTUR</td>
                    <td>Jl Baru</td>
                    <td>Urgent</td>
                    <td>
                        <?php
                            $data = 'P';
                            if($data=='P'){ ?>
                                <b class="warning">
                                    On Working
                                </b>
                        <?php
                            }else if($data=='Y'){ ?>
                                <b class="success">
                                    Success
                                </b>
                        <?php
                            }else if($data=='N'){ ?>
                                <b class="danger">
                                    Closed
                                </b>
                        <?php                                
                            }else { ?>
                                <b>
                                    Open
                                </b>
                        <?php
                            }
                        ?>
                    </td>
                    <td>2023-12-12</td>
                    <td>
                        <?php
                            if($data=='O'){ ?>
                                <button class="data-icon bg-working" onclick="window.location" title="Progressing Complaint">
                                <i class="fa-solid fa-spinner"></i>
                                </button>
                        <?php
                            }else if($data=='P'){ ?>
                                <button class="data-icon bg-success" onclick="window.location" title="Success Complaint">
                                <i class="fa-solid fa-check"></i>
                                </button>
                        <?php
                            }?>
                        <button class="data-icon bg-closed" onclick="window.location" title="Closed Complaint">
                            <i class="fas fa-xmark "></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- End of Data Complaint Table Section -->
</main>