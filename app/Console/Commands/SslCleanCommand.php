<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SslCleanCommand extends Command
{
    /**
     * Nama dan signature command.
     */
    protected $signature = 'ssl:clean';

    /**
     * Deskripsi command.
     */
    protected $description = 'Hapus folder .well-known setelah SSL selesai diverifikasi';

    /**
     * Jalankan perintah.
     */
    public function handle()
    {
        $dir = public_path('.well-known');

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            $this->info("🗑️ Folder .well-known berhasil dihapus: {$dir}");
        } else {
            $this->warn("⚠️ Folder .well-known tidak ditemukan.");
        }

        return 0;
    }
}
