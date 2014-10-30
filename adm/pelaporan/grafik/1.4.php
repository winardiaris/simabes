<?php
require_once ('../../../libs/jpgraph/jpgraph.php');
require_once ('../../../libs/jpgraph/jpgraph_pie.php');
include ('../../../inc/koneksi.php');


$qry_rak="SELECT id_rak, nm_rak FROM br_rak";
$rak=mysql_query($qry_rak) or die (mysqli_error());
$x_ = "";
$y_ = "";
while($data=mysql_fetch_object($rak)){
	$id=$data->id_rak;
		$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_rak FROM  `br_data` WHERE  `id_rak`='$id'");
			while($b = mysql_fetch_array($a)){
				$jml = $b['jml_rak'];
				$x_ = $x_ . "," . $jml; // $x_ menjadi ,ini,ini,ini dst
			}
}
$c = mysql_query("SELECT nm_rak FROM br_rak ");
while($d = mysql_fetch_array($c)){
	$kua = $d['nm_rak'];
	$y_ = $y_ . "," . $kua; // $Y_ menjadi ,ini,ini,ini dst
}
$x_ = substr($x_,1,strlen($x_)-1); //data $x_ adalah dimulai setelah angka 1 dari variabel $x_ sejumlah seluruh data $x_ dikurangi 1 (karena yang 1 adalah koma tanpa isi didepan)
$y_ = substr($y_,1,strlen($y_)-1); //data $x_ adalah dimulai setelah angka 1 dari variabel $x_ sejumlah seluruh data $x_ dikurangi 1 (karena yang 1 adalah koma tanpa isi didepan)


//echo $x_;
//echo $y_;


$data_x = explode("," , $x_);
$data_y = explode("," , $y_);


// Create the Pie Graph. 
$graph = new PieGraph(500,450);
$graph->SetShadow(); 
$theme_class=new UniversalTheme;
$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->Set("Data Barang per Rak Penyimpanan");
$graph->SetBox(true);


// Create
$p1 = new PiePlot($data_x);
$graph->Add($p1);
$p1->SetLegends($data_y);
$p1->ShowBorder();
$p1->SetColor('black');
//$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3','#8B6914','#1A1A1A','#B03737','#B0A437','#E5E5E5'));
$graph->Stroke();
?>



