<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Random Grouping</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Form -->
        <div class="container-form">
            <h1>Input:</h1>
            <!-- Form input -->
            <form action="index.php" method="post">
                <!-- Input nama, separator \n -->
                <textarea name="nama" id="nama" cols="20" rows="10" placeholder="Input nama"><?php if (isset($_POST['random'])) echo $_POST['nama']; ?></textarea>

                <!-- Input jumlah kelompok -->
                <input type="number" name="groups" class="input input-num" placeholder="Jumlah kelompok" value="<?php if (isset($_POST['groups'])) echo $_POST['groups']; ?>">
                <input type="submit" name="random" value="Randomize" class="input-btn">
            </form>
        </div>

        <!-- Hasil input -->
        <div class="container-result">
            <h1>Result:</h1>
            <!-- Daftar nama yang dimasukan -->
            <div class="name-list">
                <?php
                $arrname = array();
                if (isset($_POST['random'])) {
                    $allname = $_POST['nama'];
                    $arrname = explode("\n", $allname);
                    $n = sizeof($arrname);

                    // Change all element to Upper case
                    for ($i = 0; $i < $n; $i++)
                        $arrname[$i] = ucfirst($arrname[$i]);

                    // Print all value
                    foreach ($arrname as $value)
                        echo $value . ", ";
                }
                ?>
            </div>
            <!-- Cards kelompok -->
            <div class="cards">
                <?php
                if (isset($_POST['random'])) {
                    $n = sizeof($arrname);
                    $groups = $_POST['groups'];
                    $mod = $n % $groups;
                    $nmod = $n - $mod;
                    $k = 0;
                    $modflag = 0; // Flag pembatas mod

                    // Shuffle array
                    shuffle($arrname);

                    while ($k < $n) {
                        for ($i = 1; $i <= $groups; $i++) {
                            // Isi card
                            echo '<div class="card">';
                            // Nomor kelompok
                            echo '<h2>Kelompok ' . $i . '</h2><hr>';
                            // List
                            echo '<ul>';
                            // Pengelompokan Setara
                            // (n-(n%groups) / groups
                            for ($j = 0; $j < $nmod / $groups; $j++) {
                                if ($arrname[$k]) {
                                    echo '<li>' . $arrname[$k] . '</li>';
                                    $k++;
                                }
                            }
                            // Pengelompokan sisa
                            if ($modflag < $mod) {
                                if ($arrname[$k]) {
                                    echo '<li>' . $arrname[$k] . '</li>';
                                    $k++;
                                    $modflag++;
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
            <!-- Date Time -->
            <p class="datetime">
                <?php
                if (isset($_POST['random'])) {
                    // Set default timezone
                    date_default_timezone_set('Asia/Jakarta');

                    // hari bulan tahun Jam.Menit.Detik
                    $date = date("d M Y H.i.s");
                    echo 'Pengacakan dilakukan pada ' . $date . ' WIB.';
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>