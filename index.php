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
                <input type="number" name="num" class="input input-num" placeholder="Jumlah nama" value="<?php if (isset($_POST['num'])) echo $_POST['num']; ?>">
                <input type="submit" name="generate" value="Generate" class="input-btn">
                <hr>
                <!-- Create input form -->
                <?php
                if (isset($_POST['generate'])) {
                    $n = $_POST['num'];

                    for ($i = 0; $i < $n; $i++)
                        echo '<input type="text" name="nama' . $i . '" class="input input-name" placeholder="Nama"><br>';
                    echo '<hr>';
                }
                ?>
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
                    $n = $_POST['num'];
                    // Push nama ke dalam array
                    for ($i = 0; $i < $n; $i++)
                        array_push($arrname, strtoupper($_POST['nama' . $i]));

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
                    $n = $_POST['num'];
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
                // Set default timezone
                date_default_timezone_set('Asia/Jakarta');

                // hari bulan tahun Jam.Menit.Detik
                $date = date("d M Y H.i.s");
                echo 'Pengacakan dilakukan pada ' . $date . ' WIB.';
                ?>
            </p>
        </div>
    </div>
</body>

</html>