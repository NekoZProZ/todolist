<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Print Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body>
    <h1>History Lelang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>User</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($clara as $nelson) {
            ?>
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $nelson->nama_barang ?></td>
                <td><?= $nelson->tgl_lelang ?></td>
                <td><?= $nelson->nama_lengkap ?></td>
                <td><?= $nelson->penawaran_harga ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
