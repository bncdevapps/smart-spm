<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan SPM</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 10px;
                /* Font ukuran kecil */
                margin: 0;
                padding: 0;
            }

            .table-container {
                width: 100%;
                margin: 20px auto;
                padding: 0;
            }

            h2 {
                margin-bottom: 0px;
                padding-bottom: 0px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 0 auto;
            }

            th,
            td {
                padding: 5px 10px;
                text-align: left;
                border: 1px solid #ddd;
                /* Warna border abu-abu terang */
                /* word-wrap: break-word; */
                word-wrap: break-word !important;
                word-break: break-word !important;
                /* Membuat teks wrap */
                white-space: normal !important;
                /* Pastikan semua teks terbungkus */
            }

            th {
                background-color: #1d3a3a;
                /* Warna hijau gelap solid */
                color: #fff;
                /* Teks putih */
                text-transform: uppercase;
                font-size: 9px;
                /* Ukuran font kecil */
                text-align: center;
            }

            td {
                font-size: 10px;
                /* Ukuran font normal */
            }

            tr:nth-child(even) td {
                background-color: #edebeb;
                /* Tetap putih */
            }

            tr:nth-child(odd) td {
                background-color: #fff;
                /* Tetap putih */
            }
        </style>
    </head>

    <body>
      
        <div class="table-container" style="text-align: center">
                            <h2>PEMERINTAH KABUPATEN TABALONG</h2>
                            <h3>DAFTAR PENGUJI</h3>
                            <p>Tanggal Cetak {{ $tanggal_cetak }}</p>
                       
            <table>
                <thead>
                    <tr>
                       
                        <th>No.</th>                                     
                        <th>Nomor SP2D</th>
                        <th>Tanggal</th>
                        <th>Jenis SP2D</th>
                        <th>Bruto</th>
                        <th>Potongan</th>
                        <th>Netto</th>
                        <th>Nama SKPD</th>
                        <th>Nama Pihak ke-3</th>    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spms as $index => $spm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $spm->nomor_sp2d }}</td>
                        <td>{{ date('d M Y', strtotime($spm->tanggal)) }}</td>
                        <td>{{ $spm->jenis }}</td>
                         <td>Rp{{ number_format($spm->jumlah, 0, ',', '.'), }}</td>
                                    <td>Rp{{ number_format($spm->ppn + $spm->jumlah_pajak_lain + $spm->jumlah_potongan, 0, ',', '.'), }}</td>
                                    <td>Rp{{ number_format($spm->jumlah_netto, 0, ',', '.'), }}</td>
                                    <td>{{ $spm->instansi }}</td>
                                    <td>{{ $spm->penyedia }}</td>                                
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>       
    </body>

</html>