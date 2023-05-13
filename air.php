<?php 
    $koneksi = mysqli_connect("localhost", "root", "", "survei_air");

    $sql = "SELECT Sair, berwarna, berbau, berasa FROM user";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) { 
        $sumur = 0;
        $pam = 0;
        while($row = $result->fetch_assoc()) {
            $konten = $row["Sair"];
            if ($konten == "Sumur-Tanah"){$sumur++;}
            if ($konten == "PAM"){$pam++;}
        }
        $total = $sumur+$pam;
        $sumur = ($sumur/$total)*100;
        $pam = ($pam/$total)*100;

        $sumber = array(
            array('label' => 'Air PAM', 'value' => $pam),
            array('label' => 'Air Sumur/Tanah', 'value' => $sumur)
        );
        $jsonsumber = json_encode($sumber);

    } else {
        echo "Tidak ada hasil yang ditemukan";
    }

    $koneksi->close();
?>