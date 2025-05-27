<?php

namespace App\Http\Repository;

use App\Models\Absent;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class AbsentRepository
{
    public function getAll($data)   
    {
        try {

            $absents = Absent::orderBy('date', 'desc')->where('status', '!=', 'tidak hadir');

            $bulan = $data->bulan;
            $tahun = $data->tahun;

            if ($bulan && $tahun) {
                $absents->whereMonth('date', $bulan)->whereYear('date', $tahun);
            }

            if (Auth::user()->role_id == 1) {
                return $absents->get();
            } else {
                return $absents->where('user_id', Auth::user()->id)->get();
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByAuth($data)
    {
        try {

            $absents = Absent::where('user_id', Auth::user()->id)->orderBy('id', 'desc');

            $bulan = $data->bulan;
            $tahun = $data->tahun;

            if ($bulan && $tahun) {
                $absents->whereMonth('date', $bulan)->whereYear('date', $tahun);
            }

            return $absents->get();

            // return Absent::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    

    public function getAbsenToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'hadir')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countAbsenToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'hadir')->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getCutiToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'cuti')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countCutiToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'cuti')->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public function getIzinSakitToday()
    // {
    //     try {
    //         return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'izin')->where('status', 'sakit')->get();
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    // public function countIzinSakitToday()
    // {
    //     try {
    //         return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'izin')->Where('status', 'sakit')->count();
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    public function getIzinToday() 
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'izin')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countIzinToday() 
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'izin')->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getSakitToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'sakit')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countSakitToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'sakit')->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getWFHToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'wfh')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countWFHToday()
    {
        try {
            return Absent::whereDate('date', now()->format('Y-m-d'))->where('status', 'wfh')->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAbsenTodayByUserId()
    {
        try {
            return Absent::where('user_id', Auth::user()->id)->whereDate('date', now()->format('Y-m-d'))->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getById($id)
    {
        try {
            return Absent::find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        try {
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jamMasuk($request, $office, $getShift)
    {
        try {
            $waktuMasuk = $getShift->start;
            $timeValidasi = date('H:i:s', strtotime($waktuMasuk) + 600);

            $absen = new Absent;
            $absen->user_id = Auth::user()->id;
            $absen->office_id = $office->id;
            $absen->shift_id = 1;
            $absen->start = now();
            $absen->status = 'hadir';
            $absen->type = 'wfo';
            if (now()->format('H:i:s') > $timeValidasi) {
                $absen->status_absent = 'telat';
            } else {
                $absen->status_absent = 'tepat waktu';
            }
            $absen->date = now()->format('Y-m-d');
            $absen->save();
            return $absen;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jamPulang()
    {
        try {
            $absen = $this->getAbsenTodayByUserId(Auth::user()->id);
            $absen->end = now();
            $absen->save();
            return $absen;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jamMasukWFH($request, $office, $getShift)
    {
        // dd($request->all());
        try {
            $waktuMasuk = $getShift->start;
            $timeValidasi = date('H:i:s', strtotime($waktuMasuk) + 600);

            if ($request->status == "hadir") {
                $absen = new Absent;
                $absen->user_id = Auth::user()->id;
                $absen->office_id = $office->id;
                $absen->shift_id = 1;
                $absen->start = now();
                $absen->status = 'wfh';
                $absen->bukti_absent = $request->bukti_absent_file;
                $absen->type = 'wfh';
                if (now()->format('H:i:s') > $timeValidasi) {
                    $absen->status_absent = 'telat';
                } else {
                    $absen->status_absent = 'tepat waktu';
                }
                $absen->date = now()->format('Y-m-d');
                $absen->save();
                // dd($absen);
                return $absen;
            } elseif ($request->status == "izin") {
                $absen = new Absent;
                $absen->user_id = Auth::user()->id;
                $absen->status = 'izin';
                $absen->date = now()->format('Y-m-d');
                $absen->save();
                return $absen;
            } elseif ($request->status == "tidak hadir") {
                $absen = new Absent;
                $absen->user_id = Auth::user()->id;
                $absen->status = 'tidak hadir';
                $absen->date = now()->format('Y-m-d');
                $absen->save();
                return $absen;
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jamMasukWFHOri($request, $office, $getShift)
    {
        try {
            $waktuMasuk = $getShift->start;
            $timeValidasi = date('H:i:s', strtotime($waktuMasuk) + 600);

            $absen = new Absent;
            $absen->user_id = Auth::user()->id;
            $absen->office_id = $office->id;
            $absen->shift_id = 1;
            $absen->start = now();
            $absen->status = 'wfh';
            $absen->type = 'wfh';
            if (now()->format('H:i:s') > $timeValidasi) {
                $absen->status_absent = 'telat';
            } else {
                $absen->status_absent = 'tepat waktu';
            }
            $absen->date = now()->format('Y-m-d');
            $absen->save();
            return $absen;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}