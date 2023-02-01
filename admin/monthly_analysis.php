<?php $title = "Monthly Analysis"; ?>
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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        <div class="card-header">
                            <h3 class="card-title">Yearly Analysis</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Analysis</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart2"></canvas>
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
    const NUMBER_CFG = <?= json_encode($electric_model->get_usage_year()) ?>;


    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Dataset 1',
            data: NUMBER_CFG,
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
            }
        },
    };

    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, config);

    const NUMBER_CFG2 = <?= json_encode($electric_model->get_usage_month()['watt']) ?>;
    const labels2 = <?= json_encode($electric_model->get_usage_month()['day']) ?>;

    const data2 = {
        labels: labels2,
        datasets: [{
            label: 'Dataset 1',
            data: NUMBER_CFG2,
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
        }]
    };

    const config2 = {
        type: 'line',
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
            }
        },
    };

    const ctx2 = document.getElementById('barChart2').getContext('2d');
    new Chart(ctx2, config2);
</script>