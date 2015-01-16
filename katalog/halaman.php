<?php
	echo "<div class='wrapper-navigasi'>";
	if(!empty($_GET['cari'])) {//navigasi Halaman
		//jika melakukan pencarian tombol navigasi tidak tampil
	}
	if(!empty($_GET['kat'])) {
		
	}
	else{
		$jumPage = ceil($jumData/$BarisPerHal);
		echo "<div class='navigasi'>";
		if ($NoHal > 1) echo  "<a class='page' href='$baselink&page=".($NoHal-1)."'>&lt;&lt;</a>";
		$showPage=0;
		for($page = 1; $page <= $jumPage; $page++){
			if ((($page >= $NoHal - 3) && ($page <= $NoHal + 3)) || ($page == 1) || ($page == $jumPage)) {   
				if (($showPage == 1) && ($page != 2))
				echo "..."; 
				if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
				echo "...";
				if ($page == $NoHal)
				echo " <span class='selected'>".$page."</span> ";
				else 
				echo " <a class='page' href='$baselink&page=".$page."'>".$page."</a> ";
				$showPage = $page;          
			}
		}
	if ($NoHal < $jumPage) echo "<a class='page' href='$baselink&page=".($NoHal+1)."'>&gt;&gt;</a>";
	echo "</div>";
	}
	echo "</div>";



?>
