<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Cuti Diluar Tanggungan Negara</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/js/bootstrap.min.css'); ?>">
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .lelang {
            margin-right: 30px;
        }



        hr.new4 {
            border: 1px solid black;
        }

        .foot p {
            margin-left: 500px;
        }
    </style>
</head>

<body>

    <div style="text-align:left">
        <img src="<?= base_url() ?>assets/jawatengah1.png" alt="logo">
    </div>
    <div style="text-align:center">
        <h4>PEMERINTAH PROVINSI JAWA TENGAH</h4>
        <h4>SEKRETARIAT DPRD</h4>
        <h6>Jl. Pahlawan No. 9 Telepon (024) 8311174 Fax. Semarang
            <hr class="new4">
        </h6>
    </div>

    <p>Lampiran&nbsp;&nbsp;&nbsp; : 1 (Satu) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
    <p>Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Surat Izin Cuti Diluar Tanggungan Negara </p>
    <br>
    <p>Nama: <?= $row['nama'] ?></p>
    <p>Jabatan: <?= $row['jabatan'] ?></p>
    <p>Perihal: <?= $row['keterangan'] ?></p>
    <p>Izin tidak masuk mulai: <?= $row['mulai_cuti'] ?></p>
    <p>Sampai dengan: <?= $row['akhir_cuti'] ?></p>


    <p>Demikian Surat Izin Cuti Diluar Tanggungan Negara ini dibuat untuk dapat digunakan sebagaimana mestinya.
    </p>
    <div class="foot">
        <?php
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('d-m-Y');
        ?>
        <p>Semarang,<?php echo $now; ?> <br><br><br><br><b>pimpinan</b></p>
    </div>
</body>

</html>