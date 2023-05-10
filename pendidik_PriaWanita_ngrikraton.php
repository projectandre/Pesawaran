<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negeri Katon Pendidikan Pria dan Wanita</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #FBFBFB;

        }



        .hrJudul {
            width: 100px;
            border-top: 3px solid black;
        }
    </style>

</head>

<body>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2><b>Jumlah Pendidikan Pria dan Wanita Kec Negeri Kraton</b></h2>
            <hr class="hrJudul">
        </div>
    </div>

    <div class="thumbnail">
        <div class="col-sm-6">
            <canvas id="myChartL"></canvas>
        </div>

        <div class="col-sm-6">
            <canvas id="myChartP"></canvas>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        // URL endpoint
        <?php

        $headers = [
            "Talent-token: PJ4HFKOK9BRMFEECJL1YJ3R7DX9V92J7XI4BY9IL",
            "Talent-secret: etM3OpDZZyUs43z03RNLGtaCm4bJn5sWWRMwB3Lqn8Z41AlU7qSY6mfqSottH6AI6BBh0Q8idnotTOziXxpUJ0NY1KpiRoowvfZrO0DQzbpgZOsXC70IGxZj3PB46b6pIb4BDm804FYKw8A5pSBljhJhwsErZ92zIgRdFFFh9xyo7tlwx4LUW7JSkRFe4te26KCIjjK2TjGkxGVcbm96dJHkWsgfwDRo1bjG46osHKbPOzI69xDZKiow86Zw8Pn3kQyiRE50TEttvJgIMV3lDRNfCyZXzY5UgDSnd98d4jiV",
        ];

        // buat request
        // API yang digunakan adalah NewsAPI : https://newsapi.org/

        $ch = curl_init();

        // curl_se($toptch, CURLOPT_URL, "https://newsapi.org/v2/top-headlines?category=general&country=id&apiKey=8642ac8d640f4a3c98046ce6e84b294e");
        curl_setopt($ch, CURLOPT_URL, 'https://talent.pesawarankab.go.id/api_v01/akses/jumlah/pendidikan');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



        $data = curl_exec($ch);

        // ubah response
        $data = json_decode($data, true);
        $data = $data['data'];
        curl_close($ch);

        // var_dump($data);

        ?>

        const labels = [ // ['januari','februari']
            <?php
            $a = 0;
            foreach ($data as $dt) {
                if ($dt['nama_kecamatan'] === "Negeri Katon") {
                    $a++;
                    echo " ' " .  $dt['jenis_pendidikan'] . " ' ";
                    echo ',';

                    if ($a == 10) {
                        break;
                    }
                }
            }
            ?>

        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pendidikan Pria di Kecamatan Negeri Keaton',
                backgroundColor: 'skyblue',
                borderColor: 'orange',
                data: [
                    <?php
                    $b = 0;
                    foreach ($data as $dt) {
                        if ($dt['nama_kecamatan'] === "Negeri Katon") {
                            echo $dt['laki'];
                            echo ',';

                            if ($b == 10) {
                                break;
                            }
                        }
                        $b++;
                    }
                    ?>
                ],
            }]
        };

        const config = {
            type: 'bar', // doughnut, bar, line
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Data Pendidikan Pria"
                    }
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('myChartL'),
            config
        );




        const labelsP = [ // ['januari','februari']
            <?php
            $a = 0;
            foreach ($data as $dt) {
                if ($dt['nama_kecamatan'] === "Negeri Katon") {

                    echo " ' " .  $dt['jenis_pendidikan'] . " ' ";
                    echo ',';

                    if ($a == 10) {
                        break;
                    }
                    $a++;
                }
            }
            ?>

        ];

        const dataP = {
            labels: labelsP,
            datasets: [{
                label: 'Jumlah Pendidikan Wanita di Kecamatan Negeri Kraton',
                backgroundColor: 'Orange',
                borderColor: 'orange',
                data: [
                    <?php
                    $b = 0;
                    foreach ($data as $dt) {

                        if ($dt['nama_kecamatan'] === "Negeri Katon") {
                            $b++;
                            echo $dt['perempuan'];
                            echo ',';

                            if ($b == 10) {
                                break;
                            }
                        }
                    }
                    ?>
                ],
            }]
        };

        const configP = {
            type: 'bar', // doughnut, bar, line
            data: dataP,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Data Pendidikan Wanita"
                    }
                }
            }
        };

        var myChartP = new Chart(
            document.getElementById('myChartP'),
            configP
        );
    </script>
</body>

</html>