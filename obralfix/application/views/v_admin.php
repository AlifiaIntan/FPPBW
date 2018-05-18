
<h1 align="center">Welcome</h1>
<p align="center"><a href="<?php echo base_url('login/logout'); ?>">Logout</a></p>

<html>
<head>
    <title>Homepage</title>
</head>

<body>

    <table width='80%' border=1>

    <tr>
        <th>Name</th> <th>Email</th> <th>date</th> <th>Subject</th>  <th>Message</th> <th>Update</th>
    </tr>
    <?php
        foreach($users as $c){
        ?>
        <tr>
          <td><?php echo $c->name ?></td>
          <td><?php echo $c->email ?></td>
          <td><?php echo $c->date ?></td>
          <td><?php echo $c->subject ?></td>
          <td><?php echo $c->message ?></td>
          <td>
                <?php echo anchor('admin/edit/'.$c->id,'Edit'); ?>
                <?php echo anchor('admin/hapus/'.$c->id,'Hapus'); ?>
          </td>
        </tr>
        <?php } ?>
    </table>

    <?php echo anchor('admin/export','Export ke Excel'); ?>
    <!-- load library jquery dan highcharts -->
<script src="<?php echo base_url();?>asset/javascript/jquery.js"></script>
<script src="<?php echo base_url();?>asset/javascript/highcharts.js"></script>
<!-- end load library -->

<?php
    /* Mengambil query report*/
    foreach($users as $result){
        $date[] = $result->date; //ambil bulan
        $value[] = (float) $result->id; //ambil nilai
    }
    /* end mengambil query*/
    
?>

<!-- Load chart dengan menggunakan ID -->
<div id="report"></div>
<!-- END load chart -->

<!-- Script untuk memanggil library Highcharts -->
<script type="text/javascript">
$(function () {
    $('#report').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Report Statistik',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Data Pengunjung',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($date);?>
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
             }
          },
        series: [{
            name: 'Report Data',
            data: <?php echo json_encode($value);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
        </script>
</body>
</html>
