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
        @if ($kode == 1)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal SPM</th>
                        <th>Nomor SPM</th>
                        <th>Jenis SPM</th>
                        <th>Jumlah Pengajuan</th>
                        <th>Nama Pihak Ketiga/ Perusahaan/ Penyedia</th>
                        <th>Status SPM</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spms as $index => $spm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $spm->tanggal->format('d M Y') }}</td>
                        <td>{{ $spm->nomor }}</td>
                        <td>{{ $spm->jenis }}</td>
                        <td>{{ number_format($spm->jumlah, 0, ',', '.'), }}</td>
                        <td>{{ $spm->penyedia }}</td>
                        <td style="text-transform: uppercase;">{{ $spm->status_ajukan }}</td>
                        <td>
                            @if(!empty($spm->dokumen_list) && is_array($spm->dokumen_list))
                                @foreach($spm->dokumen_list as $doc)
                                    <div>
                                        <a href="{{ route('preview.pdf', ['dn' => $spm->nomor, 'file' => $doc['file']]) }}" target="_blank">
                                            {{ $doc['nama'] ?? $spm->nomor }}
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @elseif ($kode == 2)

        {{-- Kode 2 --}}
        <div class="table-container">
            <h2>PEMERINTAH KABUPATEN TABALONG</h2>
            <h3>{{ Auth()->user()->name_instansi}}</h3>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">INSTANSI</th>
                        <th colspan="2">SP2D</th>
                        <th colspan="4">POTONGAN PAJAK & DEDUCTION</th>
                        <th rowspan="2">NPWP BENDAHARA/REKANAN</th>
                        <th rowspan="2">NAMA BENDAHARA/REKANAN</th>
                        <th rowspan="2">NTPN</th>
                        <th rowspan="2">TANGGAL BAYAR</th>
                    </tr>
                    <tr>
                        <th>NOMOR</th>
                        <th>NILAI BELANJA (BRUTO)</th>
                        <th>PPN</th>
                        <th>PAJAK LAINNYA</th>
                        <th>POTONGAN</th>
                        <th>NILAI NETTO</th>
                    </tr>
                    <tr>
                        <th>(1)</th>
                        <th>(2)</th>
                        <th>(3)</th>
                        <th>(4)</th>
                        <th>(5)</th>
                        <th>(6)</th>
                        <th>(7)</th>
                        <th>(8)</th>
                        <th>(9)</th>
                        <th>(10)</th>
                        <th>(11)</th>
                        <th>(12)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spms as $index => $spm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $spm->instansi ?? '-' }}</td>
                        <td>{{ $spm->nomor_sp2d ?? '-' }}</td>
                        <td>Rp. {{ number_format((float)($spm->jumlah ?? 0), 0, ',', '.') }}</td>
                        <td>
                            Rp. {{ number_format((float)($spm->ppn ?? 0), 0, ',', '.') }}
                            @if(!empty($spm->id_biling_ppn))
                                <br><small>Billing: {{ $spm->id_biling_ppn }}</small>
                            @endif
                        </td>
                        <td>
                            @if(!empty($spm->pajak_lain_items) && is_array($spm->pajak_lain_items))
                                @foreach($spm->pajak_lain_items as $pItem)
                                    <div>
                                        <strong>{{ $pItem['jenis'] ?? '-' }}:</strong> 
                                        Rp. {{ number_format((float)($pItem['jumlah'] ?? 0), 0, ',', '.') }}
                                        @if(!empty($pItem['id_biling']))
                                            <br><small>Billing: {{ $pItem['id_biling'] }}</small>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                {{ $spm->pajak_lain ?? '-' }} (Rp. {{ number_format((float)($spm->jumlah_pajak_lain ?? 0), 0, ',', '.') }})
                            @endif
                        </td>
                        <td>
                            @if(!empty($spm->potongan_items) && is_array($spm->potongan_items))
                                @foreach($spm->potongan_items as $pot)
                                    <div>
                                        <strong>{{ $pot['jenis'] ?? '-' }}:</strong> 
                                        Rp. {{ number_format((float)($pot['jumlah'] ?? 0), 0, ',', '.') }}
                                    </div>
                                @endforeach
                            @else
                                {{ $spm->potongan ?? '-' }} (Rp. {{ number_format((float)($spm->jumlah_potongan ?? 0), 0, ',', '.') }})
                            @endif
                        </td>
                        <td><strong>Rp. {{ number_format((float)($spm->jumlah_netto ?? 0), 0, ',', '.') }}</strong></td>
                        <td>{{ $spm->npwp_bendahara ?? '-' }}</td>
                        <td>{{ $spm->penyedia ?? '-' }}</td>
                        <td>{{ $spm->ntpn ?? '-' }}</td>
                        <td>{{ $spm->tanggal_bayar_pajak ? $spm->tanggal_bayar_pajak->format('d M Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Kode 2 End --}}
        @endif
    </body>

</html>