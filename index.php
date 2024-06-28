<?php
include 'koneksi.php';

// Mengambil data dari tabel `ph_data` dan `mq137_readings`
$sqlPh = "SELECT * FROM ph_data ORDER BY reg_date DESC";
$resultPh = $conn->query($sqlPh);
$phData = [];

if ($resultPh->num_rows > 0) {
    while($row = $resultPh->fetch_assoc()) {
        $phData[] = $row;
    }
}

$sqlAmonia = "SELECT * FROM mq137_readings ORDER BY timestamp DESC";
$resultAmonia = $conn->query($sqlAmonia);
$amoniaData = [];

if ($resultAmonia->num_rows > 0) {
    while($row = $resultAmonia->fetch_assoc()) {
        $amoniaData[] = $row;
    }
}

$lastPh = !empty($phData) ? $phData[0] : null;
$lastAmonia = !empty($amoniaData) ? $amoniaData[0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OneFish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header class="header">
        <div class="container" style="background-color: #00EEFE;">
            <h1 class="header-text">OneFish</h1>
            <div class="containe" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="contens" id="contens">
            <div class="row justify-content-center mt-3">
                <div class="content">
                    <div class="card shadow-sm rounded border" style="background-color: #3141D2;">
                        <div class="card-body text-center" style="color: white;">
                            <h5 class="card-title">pH <img src="img/iconpH.png" alt="pH Icon"></h5>
                            <?php if ($lastPh): ?>
                                <p><?php echo $lastPh['ph']; ?></p>
                            <?php else: ?>
                                <p>Data pH tidak tersedia</p>
                            <?php endif; ?>
                            <img src="img/image.png" alt="wave">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="content">
                    <div class="card shadow-sm rounded border" style="background-color: #0A950A;">
                        <div class="card-body text-center" style="color: white;">
                            <h5 class="card-title">Amonia <img src="img/ammonia.png" alt="Ammonia"></h5>
                            <?php if ($lastAmonia): ?>
                                <p><?php echo $lastAmonia['ppm']; ?></p>
                            <?php else: ?>
                                <p>Data Amonia tidak tersedia</p>
                            <?php endif; ?>
                            <img src="img/image.png" alt="wave">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <h2 class="mode">Mode</h2>
                </div>
                <div>
                    <h2 class="card shadow-sm rounded auto-border">Auto</h2>
                </div>
            </div>
        </div>
        <div id="desktop">
            <div class="desk" id="desk">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>pH</th>
                            <th>Amonia</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($phData as $ph): ?>
                            <tr>
                                <td><?php echo $ph['reg_date']; ?></td>
                                <td><?php echo $ph['ph']; ?></td>
                                <td>-</td>
                                <td>Data pH</td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($amoniaData as $amonia): ?>
                            <tr>
                                <td><?php echo $amonia['timestamp']; ?></td>
                                <td>-</td>
                                <td><?php echo $amonia['ppm']; ?></td>
                                <td>Data Amonia</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </header>

    <script>
        function myFunction(x) {
            x.classList.toggle("change");
            var contens = document.getElementById('contens');
            var desk = document.getElementById('desk');

            if (contens.classList.contains("show")) {
                contens.classList.remove("show");
                desk.classList.remove("show");
            } else {
                contens.classList.add("show");
                desk.classList.contains("show");
                desk.classList.add("show");
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
