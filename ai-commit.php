<?php

// Load Composer
require __DIR__ . '/vendor/autoload.php';

use Gemini\Laravel\Facades\Gemini;

// Ambil diff
$diff = shell_exec("git diff --cached");

// Kalau kosong, diff working tree
if (!$diff) {
    $diff = shell_exec("git diff");
}

if (!$diff) {
    echo "NO_CHANGES";
    exit;
}

$prompt = "
Buat commit message singkat, profesional, dan jelas berdasarkan perubahan kode berikut.
Gunakan format Conventional Commits jika cocok.

Perubahan:
$diff
";

$result = Gemini::generativeModel(model: 'gemini-2.0-flash')
    ->generateContent($prompt);

$msg = trim($result->text());

echo $msg ?: "update: minor changes";
