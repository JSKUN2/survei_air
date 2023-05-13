<?php 
    $koneksi = mysqli_connect("localhost", "root", "", "survei_air");

    $sql = "SELECT Sair, berwarna, berbau, berasa FROM user";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) { 
        $berwarnaYa = 0;
        $berwarnaTidak = 0;
        $berasaYa = 0;
        $berasaTidak = 0;
        $berbauYa = 0;
        $berbauTidak = 0;
        while($row = $result->fetch_assoc()) {
            $konten = $row["Sair"];
            if ($konten == "PAM") {
                $berwarna = $row["berwarna"];
                $berbau = $row["berbau"];
                $berasa = $row["berasa"];

                if($berwarna == "Ya"){$berwarnaYa++;}
                if($berwarna == "Tidak"){$berwarnaTidak++;}
                if($berasa == "Ya"){$berasaYa++;}
                if($berasa == "Tidak"){$berasaTidak++;}
                if($berbau == "Ya"){$berbauYa++;}
                if($berbau == "Tidak"){$berbauTidak++;}
            }
        }
        $total = $berwarnaYa+$berwarnaTidak+$berasaYa+$berasaTidak+$berbauTidak+$berbauYa;
        $berwarnaYa = ($berwarnaYa/$total)*100;
        $berwarnaTidak = ($berwarnaTidak/$total)*100;
        $berasaYa = ($berasaYa/$total)*100;
        $berasaTidak = ($berasaTidak/$total)*100;
        $berbauYa = ($berbauYa/$total)*100;
        $berbauTidak = ($berbauTidak/$total)*100;
        $pam = array(
            array('label' => 'Berwarna', 'value' => $berwarnaYa),
            array('label' => 'Tidak Berwarna', 'value' => $berwarnaTidak),
            array('label' => 'Berasa', 'value' => $berasaYa),
            array('label' => 'Tidak Berasa', 'value' => $berasaTidak),
            array('label' => 'Berbau', 'value' => $berbauYa),
            array('label' => 'Tidak Berbau', 'value' => $berbauTidak)
        );
        $jsonpam = json_encode($pam);

    } else {
        echo "Tidak ada hasil yang ditemukan";
    }

    $koneksi->close();
?>