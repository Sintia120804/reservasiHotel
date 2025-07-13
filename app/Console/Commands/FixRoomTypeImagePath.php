<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SintiaRoomType;
use Illuminate\Support\Facades\File;

class FixRoomTypeImagePath extends Command
{
    protected $signature = 'fix:roomtype-image-path';
    protected $description = 'Perbaiki path image pada sintia_room_types agar sesuai dengan file di storage';

    public function handle()
    {
        $roomTypes = SintiaRoomType::all();
        $fixed = 0;
        foreach ($roomTypes as $roomType) {
            if ($roomType->image) {
                $filename = basename($roomType->image);
                $expectedPath = 'room_types/' . $filename;
                $publicPath = public_path('storage/room_types/' . $filename);
                if (file_exists($publicPath) && $roomType->image !== $expectedPath) {
                    $roomType->image = $expectedPath;
                    $roomType->save();
                    $fixed++;
                    $this->info("Fixed: {$roomType->name} => $expectedPath");
                }
            }
        }
        $this->info("Selesai. Jumlah path yang diperbaiki: $fixed");
    }
} 