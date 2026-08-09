<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class SslVerifyCommand extends Command
{
   /**
     * Nama dan signature command
     */
    protected $signature = 'ssl:verify {filename} {--content=}';

    /**
     * Deskripsi command
     */
    protected $description = 'Generate SSL verification file in /.well-known/pki-validation/';

    /**
     * Jalankan perintah
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $content  = $this->option('content');

        $dir = public_path('.well-known/pki-validation');

        // Buat folder jika belum ada
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $path = $dir . '/' . $filename;

        // Buat file
        File::put($path, $content);

        $this->info("✅ File verifikasi dibuat: {$path}");
        $this->info("🔗 Akses via: ".config('app.url')."/.well-known/pki-validation/{$filename}");
    }

}
