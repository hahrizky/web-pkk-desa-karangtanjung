<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use JsonException;
use RuntimeException;

/** Serializes updates to the shared profile JSON and preserves unrelated fields. */
class ProfilDataStore
{
    private function path(): string
    {
        return storage_path('app/profil_data.json');
    }

    public function read(): array
    {
        $path = $this->path();
        if (! File::exists($path)) {
            return [];
        }

        try {
            $data = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('Data profil rusak dan tidak dapat dibaca. File tidak diubah.', 0, $exception);
        }

        if (! is_array($data)) {
            throw new RuntimeException('Format data profil tidak valid. File tidak diubah.');
        }

        return $data;
    }

    /**
     * Apply top-level changes under an exclusive lock and return the prior data.
     * A malformed existing file is deliberately left untouched.
     */
    public function update(array $changes, array $defaults = []): array
    {
        $path = $this->path();
        File::ensureDirectoryExists(dirname($path));
        $lock = fopen($path.'.lock', 'c');
        if ($lock === false) {
            throw new RuntimeException('Tidak dapat mengunci data profil untuk disimpan.');
        }

        try {
            if (! flock($lock, LOCK_EX)) {
                throw new RuntimeException('Tidak dapat mengunci data profil untuk disimpan.');
            }

            $stored = $this->read();
            $previous = array_replace_recursive($defaults, $stored);
            $updated = array_merge($previous, $changes);
            $json = json_encode($updated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
            $temporaryPath = $path.'.'.Str::uuid().'.tmp';

            if (File::put($temporaryPath, $json) === false) {
                File::delete($temporaryPath);
                throw new RuntimeException('Tidak dapat menulis data profil.');
            }

            if (! rename($temporaryPath, $path)) {
                File::delete($temporaryPath);
                throw new RuntimeException('Tidak dapat menyimpan data profil.');
            }

            return $previous;
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }
}
