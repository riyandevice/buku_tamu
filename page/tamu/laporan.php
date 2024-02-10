<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$koneksi = new mysqli  ("localhost","root","","db_tamu");
$content ='

<style type="text/css">
	
	.tabel{border-collapse: collapse;}
	.tabel th{padding: 5px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 5px 5px;     }
</style>


';
    $content .= '
<page>
    <h2 style="text-align:center;">LAPORAN TAMU SMKS UNTUNG SURAPATI PASURUAN</h2>
    <br>';


                if (isset($_POST['cetak'])) {
    
                $tgl1 = $_POST['tgl1'];
                $tgl2 = $_POST['tgl2'];

            }

    $content .='
    <span style="margin-left:14px;">Periode : '.date('d F Y', strtotime($tgl1)).' - '.date('d F Y', strtotime($tgl2)).'</span>

    <p></p>
    <table border="1" class="tabel" align="center">
    	
    		<tr>
    			<th>No</th>
    			<th>Tanggal</th>
    			<th>Jam</th>
    			<th>Nama</th>
    			<th>Alamat</th>
    			<th>Ketemu</th>
    			<th>Keperluan</th>
    			<th>Foto</th>
    		</tr>';

    		
    			$tgl4 = date("d-m-Y");
    			

    			if (isset($_POST['cetak'])) {
	
				$tgl1 = $_POST['tgl1'];
				$tgl2 = $_POST['tgl2'];

				$no = 1;


				$sql = $koneksi->query("select * from tb_tamu where tanggal between '$tgl1' and '$tgl2' ");
				while ($data=$sql->fetch_assoc()) {

					 

					$content .='
					<tr>
		    			<td>'.$no++.' </td>
		    			<td> '.date('d F Y', strtotime( $data['tanggal'])).' </td>
		    			<td> '.$data['jam'].' </td>
		    			<td> '.$data['nama'].' </td>
		    			<td width="135"> '.$data['alamat'].' </td>
		    			<td> '.$data['ketemu'].' </td>
                        <td width="145"> '.$data['keperluan'].' </td>
		    			<td> <img src="../../upload/'.$data['foto'].' "  width="75" height="50">  </td>
		    			
		    		</tr>
		    		';
		    		

				}

						
				}else{	
    			

    		
        		$no = 1;
        		$sql = $koneksi->query("select * from tb_tamu ");
        		while ($data=$sql->fetch_assoc()) {
    	
    		$content .='

    		<tr>
    			<td>'.$no++.' </td>
    			<td> '.date('d F Y', strtotime( $data['tanggal'])).' </td>
    			<td> '.$data['jam'].' </td>
    			<td> '.$data['nama'].' </td>
    			<td width="135"> '.$data['alamat'].' </td>
    			<td> '.$data['ketemu'].' </td>
                <td width="145"> '.$data['keperluan'].' </td>
    			<td> <img src="../../upload/'.$data['foto'].' "  width="75" height="50">  </td>

    		</tr>

    		';	
    		
    		}
    		}
    		
    		


$content .=' 	
    </table>

    
</page>';

    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','legger','fr');
	$html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>