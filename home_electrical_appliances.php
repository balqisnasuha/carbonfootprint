<?php $title = "Home Electrical Appliances"; ?>
<?php include "layout/header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            WHAT DO YOU HAVE IN YOUR HOUSE?
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" placeholder="Select Date" readonly value="<?= date("d F Y") ?>">
                                                    <div class=" input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php foreach ($electric_model->get_all_device() as $electric) : ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="electrical_appliances[]" id="device-<?= $electric['device_id'] ?>" value="<?= $electric['device_id'] ?>">
                                                        <label class="form-check-label" for="device-<?= $electric['device_id'] ?>">
                                                            <?= $electric['device_name'] ?>
                                                        </label>
                                                    </div>
                                                    <div class="form-group d-none" id="device-<?= $electric['device_id'] ?>-value">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Duration (hrs):</span>
                                                            </div>
                                                            <input type="number" class="form-control" name="duration[]" id="duration-<?= $electric['device_id'] ?>" placeholder="Duration" min="0" max="24" value="0" step="0.5" onkeyup="calculate_power_uses()">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <span id="message"></span>
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            TOTAL POWER USES (kW) :
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="small-box bg-info pb-3 align-items-center justify-content-center">
                                                <div class="inner">
                                                    <h4 class="text-center mt-3">
                                                        <span id="total-power-uses">0</span> kW
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <button type="button" class="btn btn-primary">CALCULATE CARBON EMISSION</button> -->
                                        <!-- modal button -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="calculate_carbon_emission()">
                                            CALCULATE CARBON EMISSION
                                        </button>
                                        <!-- modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">CARBON EMISSION</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3 class="text-uppercase text-center">carbon emission in your household is:</h3>
                                                        <!-- circle-progress bar -->
                                                        <div class="row">
                                                            <div class="col-4 offset-4">
                                                                <div class="card-info">
                                                                    <div class="card-body">
                                                                        <div class="small-box bg-info pb-3 align-items-center justify-content-center">
                                                                            <div class="inner">
                                                                                <h4 class="text-center mt-3">
                                                                                    <span id="after_c">0</span>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- end circle-progress -->
                                                        <h3>HOW TO REDUCE YOUR CARBON EMISSION?</h3>
                                                        <ol>
                                                            <li>Reduce your electricity consumption by unplugging appliances when not in use.</li>
                                                            <li>Use energy efficient appliances and light bulbs.</li>
                                                            <li>Use a programmable thermostat to reduce energy use when no one is home.</li>
                                                            <li>Turn off the lights when you leave a room.</li>
                                                            <li>Use a clothesline to dry your clothes.</li>
                                                            <li>Use a fan instead of an air conditioner.</li>
                                                            <li>Use a microwave instead of an oven.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                ELECTRICITY CONSUMPTION
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-default2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>DEVICE Name</th>
                                            <th>POWER</th>
                                            <th>TIME (HOUR)</th>
                                            <th>AMOUNT WATT</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $user_id = $_SESSION['user'];
                                        $sql = "SELECT * FROM electric_usage JOIN electric_device ON usage_device_id = device_id WHERE usage_user_id = '$user_id' AND usage_status = '1' AND usage_deleted_at IS NULL";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['device_name']; ?></td>
                                                <td><?= $row['usage_power']; ?></td>
                                                <td><?= $row['usage_duration']; ?></td>
                                                <td><?= $row['usage_watt']; ?></td>
                                                <td data-order="<?= strtotime($row['usage_created_at']); ?>">
                                                    <?= date('d-m-Y', strtotime($row['usage_created_at'])); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'layout/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            var id = $(this).val();
            if ($(this).prop("checked") == true) {
                $('#device-' + id + '-value').removeClass('d-none');
            } else {
                $('#device-' + id + '-value').addClass('d-none');
            }
            calculate_power_uses();
        });
    });

    function calculate_power_uses() {
        var total_power_uses = 0;
        var arr_list = [];
        var arr_duration = [];
        $('input[type="checkbox"]').each(function() {
            var id = $(this).val();
            var duration = $('#duration-' + id).val();
            if ($(this).prop("checked") == true) {
                arr_list.push(id);
                arr_duration.push(duration);
            }
        });

        $.ajax({
            url: '<?= base_url('home_electrical_appliances_request.php') ?>',
            type: "POST",
            data: {
                id: arr_list,
                duration: arr_duration,
                action: 'calculate_power_uses'
            },
            dataType: "json",
            success: function(data) {
                $('#total-power-uses').html(data.watt);
                console.log(data);
            },
            error: function(data) {
                console.log(data);
                $('#message').html(data);
            }
        });
    }

    function calculate_carbon_emission() {
        var total_power_uses = 0;
        var arr_list = [];
        var arr_duration = [];
        $('input[type="checkbox"]').each(function() {
            var id = $(this).val();
            var duration = $('#duration-' + id).val();
            if ($(this).prop("checked") == true) {
                arr_list.push(id);
                arr_duration.push(duration);
            }
        });

        $.ajax({
            url: '<?= base_url('home_electrical_appliances_request.php') ?>',
            type: "POST",
            data: {
                id: arr_list,
                duration: arr_duration,
                action: 'calculate_carbon_emission'
            },
            dataType: "json",
            success: function(data) {
                $('#total-carbon-emission').html(data.watt);
                var before_c = data.watt * 0.622;
                before_c = before_c.toFixed(2);
                $('#after_c').html(before_c);
                console.log(data);
            },
            error: function(data) {
                console.log(data);
                $('#message').html(data);
            }
        });
    }
</script>