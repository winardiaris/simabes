<?php
require_once ('../../../libs/jpgraph/jpgraph.php');
require_once ('../../../libs/jpgraph/jpgraph_pie.php');
include ('../../../inc/koneksi.php');

$qry_kt="SELECT id_rak, nm_rak FROM br_rak";
$kt=mysql_query($qry_kt) or die (mysql_error());
$x_ = "";
$y_ = "";
while($data=mysql_fetch_object($kt)){
	$id=$data->id_rak;
		$a = mysql_query(" SELECT SUM( IF(  id_rak LIKE  '$data->id_rak',  id_rak , 0 ) ) AS  rak FROM  br_data ");
			while($b = mysql_fetch_array($a)){
				$rak = $b['rak'];
				$x_ = $x_ . "," . $rak; // $x_ menjadi ,ini,ini,ini dst
			}
}
$c = mysql_query("SELECT nm_rak FROM br_rak");
while($d = mysql_fetch_array($c)){
	$kt = $d['nm_rak'];
	$y_ = $y_ . "," . $kt; // $Y_ menjadi ,ini,ini,ini dst
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
$graph->title->Set("Data Stok Barang per Rak Penyimpanan");
$graph->SetBox(true);


// Create
$p1 = new PiePlot($data_x);
$graph->Add($p1);
$p1->SetLegends($data_y);
$p1->ShowBorder();
$p1->SetColor('black');
$graph->Stroke();
?>



