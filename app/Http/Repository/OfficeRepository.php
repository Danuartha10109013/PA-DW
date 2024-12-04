<?php

namespace App\Http\Repository;

use App\Models\Office;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfficeRepository
{
    public function getAll()
    {
        try {
            return Office::orderBy('id', 'desc')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getById($id)
    {
        try {
            return Office::find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByQrCode($qrcode)
    {
        try {
            return Office::where('qrcode', $qrcode)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store($data)
    {
        try {
            $office = new Office();
            $office->name = $data->name;
            $office->address = $data->address;
            $office->qrcode = Str::random(40);

            if ($data->file('image')) {
                $file = $data->file('image');
                $path = Storage::disk('public')->put('office', $file);
                $office->image = $path;
            }
            $office->save();

            return $office;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        try {
            $office = Office::find($id);
            $office->name = $data->name;
            $office->address = $data->address;
            if ($data->file('image')) {
                if ($office->image) {
                    Storage::disk('public')->delete($office->image);
                }
                $file = $data->file('image');
                $path = Storage::disk('public')->put('office', $file);
                $office->image = $path;
            }
            $office->save();

            return $office;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $office = Office::find($id);
            if ($office->image) {
                Storage::disk('public')->delete($office->image);
            }
            $office->delete();
            return $office;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generate($id)
    {
        try {
            $office = Office::find($id);
            $office->qrcode = Str::random(40);

            // $filename = 'qrcode/office/' . $office->qrcode . '.png';
            // if (Storage::disk('public')->exists($filename)) {
            //     Storage::disk('public')->delete($filename);
            // }
            // QrCode::format('png')->size(500)->generate($office->qrcode, public_path($filename));


            // base64
            // $qrcode = QrCode::format('png')->generate($office->qrcode);
            // Storage::disk('public')->put('qrcode/office/' . $office->qrcode . '.png', $qrcode);

            $office->save();

            return $office;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function download($id)
    {
        try {
            $office = Office::find($id);
            
            // public path
            QrCode::format('png')->size(500)->generate($office->qrcode, public_path('qrcode/office/' . $office->qrcode . '.png'));
            
            
            // $qrcode = QrCode::size(500)->generate($office->qrcode);
            // return response($qrcode)->header('Content-Type', 'image/png');


        } catch (\Throwable $th) {
            throw $th;
        }
    }
}