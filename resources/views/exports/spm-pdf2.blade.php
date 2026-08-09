<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPM PDF</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
                word-wrap: break-word;
                white-space: normal;
            }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
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
                    <td>{{ $spm->status_ajukan }}</td>
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
    </body>

</html>