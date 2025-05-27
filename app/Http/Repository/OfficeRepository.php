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
            return Office::orderBy('id', 'desc')->first();
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

    public function generate()
    {
        try {
            $office = Office::first();
            Storage::disk('public')->delete('qrcode/' . $office->qrcode . '.png');
            $office->qrcode = Str::random(40);
            $qrcode = QrCode::format('png')->size(500)->generate($office->qrcode);
            Storage::disk('public')->put('qrcode/' . $office->qrcode . '.png', $qrcode);
            $office->save();

            return $office;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function download()
    {
        try {
            $office = Office::first();
            
            // public path
            QrCode::format('png')->size(400)->generate('http://127.0.0.1:8000/qrcode/' . $office->qrcode . '.png', public_path('qrcode/office/' . $office->qrcode . '.png'));
            // QrCode::format('png')->size(400)->generate($office->qrcode, public_path('qrcode/office/' . $office->qrcode . '.png'));
            
            
            // $qrcode = QrCode::size(500)->generate($office->qrcode);
            // return response($qrcode)->header('Content-Type', 'image/png');


        } catch (\Throwable $th) {
            throw $th;
        }
    }
}