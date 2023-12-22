<script>
    $(function () {
        $("#dataviews").DataTable({ 
            "autoWidth": true,
            "responsive": true,
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
        <table id="dataviews" class="display nowrap" style="width:100%">
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
                <?php 
            if($data_complaint){
                $i=1; foreach ($data_complaint->complaints as $data) { ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$data->username?></td>
                    <td>
                        <?=$data->complaint?> 
                        <br> 
                        <a class="link-file" href="<?=$data->file?>" target="_blank">
                            See files
                        </a>
                    </td>
                    <td><?=$data->category?></td>
                    <td><?=$data->location?></td>
                    <td><?=@$data->prediction > 50?"<b class='primary'>Urgent ($data->prediction%)</b>":"Not Urgent ($data->prediction%)"?></td>
                    <td>
                        <?php
                            if($data->status=='P'){ ?>
                                <b class="warning">
                                    On Working
                                </b>
                        <?php
                            }else if($data->status=='Y'){ ?>
                                <b class="success">
                                    Success
                                </b>
                        <?php
                            }else if($data->status=='N'){ ?>
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
                    <td><?=date('Y-m-d', strtotime($data->createdAt))?></td>
                    <td>
                        <?php
                            if($data->status=='O'){ ?>
                                <button class="data-icon bg-working" onclick="setStatus(<?=$data->id?>, 'P')" title="Progressing Complaint">
                                <i class="fa-solid fa-spinner"></i>
                                </button>
                        <?php
                            }else if($data->status=='P'){ ?>
                                <button class="data-icon bg-success" onclick="setStatus(<?=$data->id?>, 'Y')" title="Success Complaint">
                                <i class="fa-solid fa-check"></i>
                                </button>
                        <?php
                            }else if($data->status=='N'){?>
                                <button class="data-icon bg-open" onclick="setStatus(<?=$data->id?>, 'O')" title="Open Complaint">
                                <i class="fa-regular fa-folder-open"></i>
                                </button>
                        <?php
                            }?>
                        <button class="data-icon bg-closed" <?=$data->status=='N'?'style="display:none"':''?> onclick="setStatus(<?=$data->id?>, 'N')" title="Closed Complaint">
                            <i class="fas fa-xmark "></i>
                        </button>
                    </td>
                </tr>
                <?php   
                $i++; }
            }?>
            </tbody>
        </table>
    </div>
    <!-- End of Data Complaint Table Section -->
</main>

<script type="text/javascript">
    function setStatus(id, status){
        let status_msg;
        const data_post = JSON.stringify({ "id": id, "status": status});
        console.log(data_post);

        if(status.toUpperCase() == 'O'){
            status_msg = 'Open';
        }else if(status.toUpperCase() == 'P'){
            status_msg = 'On Working';
        }else if(status.toUpperCase() == 'Y'){
            status_msg = 'Success';
        }else if(status.toUpperCase() == 'N'){
            status_msg = 'Closed';
        }

        Swal.fire({
            title: 'Set Status',
            text: "Confirm set status to " + status_msg + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#14a44d',
            cancelButtonColor: '#dc4c64',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Confirm'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    type:'PUT',
                    async:false,
                    url:"<?=$this->config->item('api_url')?>/main/status",
                    data:data_post,
                    contentType:'application/json',       
                    processData:false,  
                    cache:false,
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        Swal.fire({
                                icon: 'success',
                                title: 'Set Status',
                                text: 'Status successfully been set!',
                                confirmButtonColor: '#14a44d',
                                confirmButtonText: 'OK',
                                timer: 2000
                            }).then(
                                function () {
                                    location.reload();
                            });
                    },error: function(data){
                        console.log(data);
                        Swal.fire({
                                title: 'Error',
                                text: "There is an error on Server!",
                                icon: 'error',
                                confirmButtonColor: '#dc4c64',
                                confirmButtonText: 'OK',
                                timer: 2000
                        });
                    }
                })
            }
        })
    }
</script>