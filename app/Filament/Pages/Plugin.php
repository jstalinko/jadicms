<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Filament\Notifications\Notification;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\File;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class Plugin extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?int $navigationSort = 7;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::PuzzlePiece;
    protected static string|UnitEnum|null $navigationGroup = 'Customize';
    protected static ?string $navigationLabel = 'Plugins';

    // Kita tidak lagi menggunakan view custom, Filament akan merender view tabel
    protected  string $view = 'filament.pages.plugin'; 
    
    // Properti ini akan menampung data plugin
    public array $plugins = [];

    public function mount(): void
    {
        // 1. Dapatkan daftar direktori plugin
        $pluginDirectories = File::directories(base_path('plugins'));
        $pluginsData = [];

        // 2. Loop melalui setiap direktori dan baca plugin.json
        foreach ($pluginDirectories as $dir) {
            $pluginName = basename($dir);
            $jsonPath = $dir . '/plugin.json';

            if (File::exists($jsonPath)) {
                $config = json_decode(File::get($jsonPath), true);
                
                // Cek status aktif/nonaktif menggunakan fungsi yang Anda sediakan
                $statusKey = 'plugin_' . strtolower($pluginName) . '_status';
                // Asumsi fungsi get_option tersedia dan mengembalikan nilai
                $status = function_exists('j_get_option') ? 
                          j_get_option($statusKey, 'disabled') : 
                          'disabled';
                
                $pluginsData[] = [
                    'directory_name' => $pluginName, // Kunci unik untuk aksi
                    'plugin_name' => $config['plugin_name'] ?? 'N/A',
                    'plugin_desc' => $config['plugin_desc'] ?? 'N/A',
                    'version' => $config['version'] ?? 'N/A',
                    'author_name' => $config['author_name'] ?? 'N/A',
                    'status' => $status,
                    'status_key' => $statusKey,
                ];
            }
        }

        $this->plugins = $pluginsData;
    }

    // Metode ini diperlukan oleh InteractsWithTable, tapi kita gunakan data array, bukan Eloquent
    protected function getTableQuery(): ?Builder
    {
        // Karena kita tidak menggunakan model Eloquent, kita kembalikan null
        return null; 
    }
    
    // Metode untuk menyediakan data ke tabel
    protected function getTableData(): array
    {
        return $this->plugins;
    }

    // Konfigurasi Tabel
    protected function table(Table $table): Table
    {
        return $table
        ->records(fn() => $this->plugins)
            ->columns([
                TextColumn::make('plugin_name')
                    ->label('Plugin Name')
                    ->searchable(query: fn (Builder $query, string $search) => $query->where('plugin_name', 'like', "%$search%")),
                TextColumn::make('plugin_desc')
                    ->label('Description'),
                TextColumn::make('version')
                    ->label('Version')
                    ->badge(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'enabled' => 'success',
                        'disabled' => 'danger',
                        default => 'warning',
                    }),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('toggle_status')
                    ->label(fn (array $record): string => $record['status'] === 'enabled' ? 'Disable' : 'Enable')
                    ->color(fn (array $record): string => $record['status'] === 'enabled' ? 'danger' : 'success')
                    ->icon(fn (array $record): string => $record['status'] === 'enabled' ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(fn (array $record) => $this->togglePluginStatus($record)),
            ]);
    }

    // Metode untuk mengubah status plugin
    public function togglePluginStatus(array $record): void
    {
        $newStatus = $record['status'] === 'enabled' ? 'disabled' : 'enabled';
        $key = $record['status_key'];

        // Panggil fungsi j_set_option
        if (function_exists('j_set_option')) {
            j_set_option($key, $newStatus);
            
          Notification::make('plugin_activated')->success()->title("Plugin **{$record['plugin_name']}** Enabled!")->send();
        } else {
          Notification::make('plugin_deactivated')->success()->title("Plugin **{$record['plugin_name']}** Disabled!")->send();
        }

        // Muat ulang data untuk menampilkan status terbaru
        $this->mount();
    }
}