<?php 
	//Include Koneksi
	error_reporting(E_ALL ^ E_DEPRECATED);
	mysql_connect("localhost","root","") or die ("Koneksi Gagal");
	mysql_select_db("db_tamu") or die ("Database Tidak Terakses");

	//Membuat Query
	$k=mysql_query("select * from rekapjual");
	$q=mysql_query("select date_format(tanggal,'%b') as bulan from rekapjual");
?>

<!-- File yang diperlukan dalam membuat chart -->
<script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
    
<script type="text/javascript">
$(function () {
    $('#view').highcharts({
        title: {
            text: 'Data Tamu per bulan',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php while($r=mysql_fetch_array($q)){ echo "'".$r["bulan"]."',";}?>]
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Jumlah ',
            data: [<?php while($t=mysql_fetch_array($k)){ echo $t["total"].",";}?>]
        }]
    });
});
</script>

<div id="view" style="min-width: 310px; height: 400px; margin: 0 auto"></div>