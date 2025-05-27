<?php

namespace App\Http\Controllers;

use App\Http\Repository\AbsentRepository;
use App\Http\Repository\OfficeRepository;
use App\Http\Repository\ShiftRepository;
use App\Http\Repository\UserRepository;
use App\Models\Absent;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $user = $this->userRepository->getByAuth();

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $hadir = null;
        $sakit = null;
        $izin = null;
        $cuti = null;
        $wfh = null;

        if ($bulan && $tahun) {

            // Membuat startDate sebagai instance Carbon
            $startDate = Carbon::createFromDate($tahun, $bulan, 1);
            // Menghitung endDate dengan fungsi endOfMonth()
            $endDate = $startDate->copy()->endOfMonth()->format('Y-m-d');
            // Format startDate agar konsisten
            $startDate = $startDate->format('Y-m-d');

            // get day from start date
            $carbonStartDate = Carbon::parse($startDate);
            $startDay = $carbonStartDate->format('d');

            // get day from end date
            $carbonEndDate = Carbon::parse($endDate);
            $endDay = $carbonEndDate->format('d'); 

            $hadir = $absents->where('status', 'hadir')->count();
            $sakit = $absents->where('status', 'sakit')->count();
            $izin = $absents->where('status', 'izin')->count();
            $cuti = $absents->where('status', 'cuti')->count();
            $wfh = $absents->where('status', 'wfh')->count();
        } else {
            $startDate = null;
            $endDate = null;
        }

        return view('backoffice.absent.index', compact(['absents', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti', 'wfh', 'startDate', 'endDate', 'user']));
    }

    public function report(Request $request)
    {
        $absents = $this->absentRepository->getAll($request);

        $users = User::where('role_id', 2)->get();

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($bulan && $tahun) {

            // Membuat startDate sebagai instance Carbon
            $startDate = Carbon::createFromDate($tahun, $bulan, 1);
            // Menghitung endDate dengan fungsi endOfMonth()
            $endDate = $startDate->copy()->endOfMonth()->format('Y-m-d');
            // Format startDate agar konsisten
            $startDate = $startDate->format('Y-m-d');

            // get day from start date
            $carbonStartDate = Carbon::parse($startDate);
            $startDay = $carbonStartDate->format('d');

            // get day from end date
            $carbonEndDate = Carbon::parse($endDate);
            $endDay = $carbonEndDate->format('d'); 
        } else {
            $startDate = null;
            $endDate = null;
        }

        return view('backoffice.report.report', compact([
            'absents', 
            'bulan', 
            'tahun',
            'users',
            'startDate',
            'endDate',
        ]));

    }

    // modul karyawan
    public function create()
    {
        $shifts = $this->shiftRepository->getAll();
        $user = $this->userRepository->getByAuth();
        $absentToday = $this->absentRepository->getAbsenTodayByUserId();
        return view('backoffice.karyawan.absent.index', compact('shifts', 'user', 'absentToday'));
    }

    public function wfhCreate()
    {
        $shifts = $this->shiftRepository->getAll();
        $user = $this->userRepository->getByAuth();
        $absentToday = $this->absentRepository->getAbsenTodayByUserId();
        return view('backoffice.karyawan.absent.wfh', compact('shifts', 'user', 'absentToday'));
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
            // 'shift_id' => 'required',
            'qrcode' => 'required',
        ], [
            // 'shift_id.required' => 'Shift harus diisi',
            'qrcode.required' => 'Qr code harus diisi',
        ]);

        $qrcode = $request->qrcode;
        $getOffice = $this->officeRepository->getByQrcode($qrcode);
        $shift = 1;
        $getShift = $this->shiftRepository->getById($shift);
        $jam = now()->format('H:i:s');
        $checkAbsenToday = $this->absentRepository->getAbsenTodayByUserId();

        // cek qrcode di table office
        $offices = $this->officeRepository->getAll();
        // foreach ($offices as $item) {
            if ($qrcode == $offices->qrcode) {
                // cek jika user tidak ada di table absen
                if (!$checkAbsenToday) {
                    $this->absentRepository->jamMasuk($request, $getOffice, $getShift);
                    return redirect('/backoffice/absen')->with('success', 'Absen Masuk Berhasil');
                } else {
                    if ($checkAbsenToday->jam_pulang != null) {
                        return redirect('/backoffice/absen')->with('success', 'Absen Berhasil');
                    } else {
                        if ($jam < $getShift->end) {
                            // return redirect('/backoffice/absen')->with('error', 'Anda belum waktunya pulang');
                            return redirect('/backoffice/absen')->with('home-early', 'Anda belum waktunya pulang');
                        } else {
                            if ($qrcode == $getOffice->qrcode) {
                                $this->absentRepository->jamPulang();
                                return redirect('/backoffice/absen')->with('success', 'Presensi Pulang Berhasil');
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
        // }

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

    public function homeEarly(Request $request)
    {
        $checkAbsenToday = $this->absentRepository->getAbsenTodayByUserId();
        if ($checkAbsenToday) {
            if ($checkAbsenToday->jam_pulang != null) {
                return redirect('/backoffice/absen')->with('success', 'Presensi Berhasil');
            }

            $absent = $this->absentRepository->getAbsenTodayByUserId();
            $absent->end = now();
            $absent->home_early = $request->home_early;
            // dd($absent);
            $absent->save();

            return redirect('/backoffice/absen')->with('success', 'Presensi Pulang Cepat Berhasil');
        }
    }

    public function wfhStore(Request $request)
    {
        $getOffice = $this->officeRepository->getAll();
        $shift = 1;
        $getShift = $this->shiftRepository->getById($shift);
        $jam = now()->format('H:i:s');
        $checkAbsenToday = $this->absentRepository->getAbsenTodayByUserId();
        if ($request->has('bukti_absent')) {
            $image = $request->input('bukti_absent');
            
            // Decode Base64
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageData = base64_decode($image);

            // Buat nama file unik
            $fileName = 'bukti_absent_' . Auth::user()->id . '_' . now()->timestamp . '.jpg';

            // Simpan file
            $filePath = 'bukti_absent/' . $fileName;
            Storage::disk('public')->put($filePath, $imageData);

            // Simpan path ke request agar bisa dipakai repository
            $request->merge(['bukti_absent_file' => $filePath]);
        }

        if (!$checkAbsenToday) {
            $this->absentRepository->jamMasukWFH($request, $getOffice, $getShift);
            return redirect('/backoffice/wfh')->with('success', 'Absen Berhasil');
        } else {
            if ($checkAbsenToday->jam_pulang != null) {
                return redirect('/backoffice/wfh')->with('success', 'Absen Berhasil');
            } else {
                if ($jam < $getShift->end) {
                    return redirect('/backoffice/wfh')->with('error', 'Anda belum waktunya pulang');
                } else {
                    $this->absentRepository->jamPulang();
                    return redirect('/backoffice/wfh')->with('success', 'Presensi Pulang Berhasil');
                }
            }
        }
    }

    public function detail($id)
    {
        $absent = $this->absentRepository->getById($id);
        return view('backoffice.karyawan.absent.detail', compact('absent'));
    }
    // end modul karyawan

    public function pdfBulanTahun(Request $request, $bulan, $tahun)
    {
        $absents = $this->absentRepository->getAll($request);
        $office = $this->officeRepository->getAll();

        $bulan = $bulan;
        $tahun = $tahun;

        $pdf = Pdf::loadView('backoffice.absent.pdf', compact(['absents', 'office', 'bulan', 'tahun']));
        // stream absent bulan tahun
        return $pdf->stream('absent.pdf');
    }

    public function pdf(Request $request)
    {
        $absents = $this->absentRepository->getAll($request);
        $office = $this->officeRepository->getAll();

        $bulan = null;
        $tahun = null;

        $pdf = Pdf::loadView('backoffice.absent.pdf', compact(['absents', 'office', 'bulan', 'tahun']));

        // stream pdf
        return $pdf->stream('absent.pdf');
    }

    public function reportPdfBulanTahun(Request $request, $bulan, $tahun)
    {
        $absents = $this->absentRepository->getAll($request);
        $office = $this->officeRepository->getAll();

        $bulan = $bulan;
        $tahun = $tahun;

        $users = User::where('role_id', 2)->get();
        // Membuat startDate sebagai instance Carbon
        $startDate = Carbon::createFromDate($tahun, $bulan, 1);
        // Menghitung endDate dengan fungsi endOfMonth()
        $endDate = $startDate->copy()->endOfMonth()->format('Y-m-d');
        // Format startDate agar konsisten
        $startDate = $startDate->format('Y-m-d');

        $pdf = Pdf::loadView('backoffice.report.pdf', compact(['absents', 'users', 'startDate', 'endDate', 'office', 'bulan', 'tahun']));
        // stream absent bulan tahun
        return $pdf->stream('absent.pdf');
    }
}
