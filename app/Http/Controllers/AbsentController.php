<?php

namespace App\Http\Controllers;

use App\Http\Repository\AbsentRepository;
use App\Http\Repository\OfficeRepository;
use App\Http\Repository\ShiftRepository;
use App\Http\Repository\UserRepository;
use App\Models\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    private $absentRepository;
    private $shiftRepository;
    private $userRepository;
    private $officeRepository;

    public function __construct(AbsentRepository $absentRepository, ShiftRepository $shiftRepository, UserRepository $userRepository, OfficeRepository $officeRepository)
    {
        $this->absentRepository = $absentRepository;
        $this->shiftRepository = $shiftRepository;
        $this->userRepository = $userRepository;
        $this->officeRepository = $officeRepository;
    }

    public function index(Request $request)
    {
        $absents = $this->absentRepository->getAll($request);
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $hadir = null;
        $sakit = null;
        $izin = null;
        $cuti = null;

        if ($bulan && $tahun) {
            $hadir = $absents->where('status', 'hadir')->count();
            $sakit = $absents->where('status', 'sakit')->count();
            $izin = $absents->where('status', 'izin')->count();
            $cuti = $absents->where('status', 'cuti')->count();
        }

        return view('backoffice.absent.index', compact(['absents', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti']));
    }

    // modul karyawan
    public function create()
    {
        $shifts = $this->shiftRepository->getAll();
        $user = $this->userRepository->getByAuth();
        $absentToday = $this->absentRepository->getAbsenTodayByUserId();
        return view('backoffice.karyawan.absent.index', compact('shifts', 'user', 'absentToday'));
    }

    public function self(Request $request)
    {
        $absents = $this->absentRepository->getByAuth($request);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $hadir = null;
        $sakit = null;
        $izin = null;
        $cuti = null;

        if ($bulan && $tahun) {
            $hadir = $absents->where('status', 'Absen')->count();
            $sakit = $absents->where('status', 'sakit')->count();
            $izin = $absents->where('status', 'izin')->count();
            $cuti = $absents->where('status', 'cuti')->count();
        }

        return view('backoffice.karyawan.absent.self', compact(['absents', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti']));
    }

    public function store(Request $request)
    {
        // custom message validate
        $request->validate([
            'shift_id' => 'required',
            'qrcode' => 'required',
        ], [
            'shift_id.required' => 'Shift harus diisi',
            'qrcode.required' => 'Qr code harus diisi',
        ]);

        $qrcode = $request->qrcode;
        $getOffice = $this->officeRepository->getByQrcode($qrcode);
        $shift = $request->shift_id;
        $getShift = $this->shiftRepository->getById($shift);
        $jam = now()->format('H:i:s');
        $checkAbsenToday = $this->absentRepository->getAbsenTodayByUserId();

        // cek qrcode di table office
        $offices = $this->officeRepository->getAll();
        foreach ($offices as $item) {
            if ($qrcode == $item->qrcode) {
                // cek jika user tidak ada di table absen
                if (!$checkAbsenToday) {
                    $this->absentRepository->jamMasuk($request, $getOffice);
                    return redirect('/backoffice/absen')->with('success', 'Absen Masuk Berhasil');
                } else {
                    if ($checkAbsenToday->jam_pulang != null) {
                        return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');
                    } else {
                        if ($jam < $getShift->end) {
                            return redirect('/backoffice/absen')->with('error', 'Anda belum waktunya pulang');
                        } else {
                            if ($qrcode == $getOffice->qrcode) {
                                $this->absentRepository->jamPulang();
                                return redirect('/backoffice/absen')->with('success', 'Absen Pulang Berhasil');
                            } else {
                                return redirect('/backoffice/absen')->with('error', 'Qr code tidak sesuai');
                            }
                        }
                    }
                }

                // $shift = $this->shiftRepository->getById($item->shift_id);
                // $user = $this->userRepository->getByAuth();
                // $absent = new Absent();
                // $absent->user_id = $user->id;
                // $absent->shift_id = $shift->id;
                // $absent->office_id = $item->id;
                // $absent->status = 'Absen';
                // $absent->save();

                // return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');
            } else {
                return redirect('/backoffice/absen')->with('error', 'Qr code tidak sesuai');
            }
        }

        // $qrcode = QrCode::first();
        // $qr = $request->qrcode;
        // $data = $qrcode->qrcode;
        // $checkAbsenToday = $this->absenRepository->getAbsenTodayByUserId();

        // if ($qr == $data) {


        //     if ($checkAbsenToday) {

        //         if ($checkAbsenToday->jam_pulang != null) {
        //             return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');
        //         }

        //         $this->absenRepository->jamPulang();
        //         return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');

        //     }

        //     $this->absenRepository->jamMasuk($request);
        //     return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');

        // } else {
        //     return redirect()->back()->with('qrCodeInvalid', 'Absen gagal qr code tidak sesuai');
        // }
    }

    public function detail($id)
    {
        $absent = $this->absentRepository->getById($id);
        return view('backoffice.karyawan.absent.detail', compact('absent'));
    }
    // end modul karyawan
}
