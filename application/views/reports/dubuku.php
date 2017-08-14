<html>
    <head>
        <title><?php echo $formtitle;?></title>
        <style>
            h1,h2,h3{
                text-align: center;
            }
            .commonreport{
                width: 100%;
            }
            .commonreport thead tr th{
                border: 1px solid black;
            }
            .commonreport tbody tr td{
                padding: 10px;
                border-bottom: solid 1px black;

            }
            .number{
                text-align: right;
            }
            .commonreport tfoot tr td{
                padding: 10px;
                border-bottom: solid 1px black;
                font-weight: bold;
            }
         </style>
    </head>
    <body>
        <h1><?php echo $formtitle;?></h1>
        <h3>Tanggal 1 Juli 2017</h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Uraian</th><th>Jumlah</th><th>Nama Petugas</th></tr>
            </thead>
            <tbody>
                <tr><td class="number">1</td><td>Pembayaran SPP</td><td class="number"><?php echo "Rp." . number_format(450000);?></td><td>Risma</td></tr>
                <tr><td class="number">2</td><td>Pembayaran SPP,Buku</td><td class="number"><?php echo "Rp." . number_format(650000);?></td><td>Risma</td></tr>
                <tr><td class="number">3</td><td>Pembayaran DU/PSB</td><td class="number"><?php echo "Rp." . number_format(400000);?></td><td>Risma</td></tr>
                <tr><td class="number">4</td><td>Pembayaran SPP</td><td class="number"><?php echo "Rp." . number_format(450000);?></td><td>Puji</td></tr>

            </tbody>
            <tfoot>
                <tr><td>Total</td><td colspan=2 class="number"><?php echo "Rp." . number_format(450000);?></td><td></td></tr>
            </tfoot>
        </table>
    </body>
</html>