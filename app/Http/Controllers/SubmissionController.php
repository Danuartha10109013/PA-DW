<?php

namespace App\Http\Controllers;

use App\Http\Repository\SubmissionRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    private $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    // cuti
    public function cuti(Request $request)
    {
        if(Auth::user()->role_id == 2){
            $user = User::find(Auth::user()->id);
            $submissions = $this->submissionRepository->getAllByTypeCuti($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $cuti = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $cuti = $submissions->where('type', 'cuti')->count();
            }
            return view('backoffice.submission.cuti.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti', 'user']));

        }else{

            $users = User::where('role_id', 2)->get();
            $submissions = $this->submissionRepository->getAllByTypeCuti($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $cuti = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $cuti = $submissions->where('type', 'cuti')->count();
            }
            return view('backoffice.submission.cuti.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti', 'users']));
        }
    }

    public function storeCuti(Request $request)
    {
        $submission = $this->submissionRepository->storeCuti($request);
        return redirect('/backoffice/cuti')->with('success', 'Cuti telah ditambahkan');
    }

    public function updateCuti(Request $request, $id)
    {
        $submission = $this->submissionRepository->update($request, $id);
        return redirect('/backoffice/cuti')->with('success', 'Cuti telah diubah');
    }

    public function deleteCuti($id)
    {
        $submission = $this->submissionRepository->delete($id);
        return redirect('/backoffice/cuti')->with('success', 'Cuti telah dihapus');
    }

    public function confirmCuti($id)
    {
        $submission = $this->submissionRepository->getById($id);
        $user = $submission->user;

        if (12 - $user->countCutiPerTahun($user->id, date('Y')) >= $submission->total_day) {
            $submission = $this->submissionRepository->confirm($id);
            return redirect('/backoffice/cuti')->with('success', 'Cuti telah disetujui');
        } else {
            $submission->status = 'Ditolak';
            $submission->status_description = 'Sisa cuti karyawan ' . (12 - $user->countCutiPerTahun($user->id, date('Y'))) . ' hari sedangkan pengajuan ' . $submission->total_day . ' hari';
            $submission->save();
            return redirect()->back()->with('error', 'Sisa cuti karyawan ' . (12 - $user->countCutiPerTahun($user->id, date('Y'))) . ' hari sedangkan pengajuan ' . $submission->total_day . ' hari');
        }

    }

    public function rejectCuti(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect('/backoffice/cuti')->with('success', 'Cuti telah ditolak');
    }

    public function adjustCuti(Request $request, $id)
    {
        $submission = $this->submissionRepository->update($request, $id);
        return redirect('/backoffice/cuti')->with('success', 'Pengajuan cuti telah disesuaikan');
    }

    public function updateStatusDescriptionCuti(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect('/backoffice/cuti')->with('success', 'Keterangan ditolak telah diubah');
    }

    // wfh
    public function wfh(Request $request)
    {
        if(Auth::user()->role_id == 2){
            $user = User::find(Auth::user()->id);
            $submissions = $this->submissionRepository->getAllByTypeWFH($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $wfh = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $wfh = $submissions->where('type', 'wfh')->count();
            }
            return view('backoffice.submission.wfh.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'wfh', 'user']));
        }else{

            $users = User::where('role_id', 2)->get();
            $submissions = $this->submissionRepository->getAllByTypeWFH($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $wfh = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $wfh = $submissions->where('type', 'wfh')->count();
            }
            return view('backoffice.submission.wfh.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'wfh', 'users']));
        }
    }

    public function storeWFH(Request $request)
    {
        $submission = $this->submissionRepository->storeWFH($request);
        return redirect()->back()->with('success', 'WFH telah ditambahkan');
        // return redirect('/backoffice/wfh')->with('success', 'WFH telah ditambahkan');
    }

    public function updateWFH(Request $request, $id)
    {
        $submission = $this->submissionRepository->update($request, $id);
        return redirect()->back()->with('success', 'WFH telah diubah');
        // return redirect('/backoffice/wfh')->with('success', 'WFH telah diubah');
    }

    public function deleteWFH($id)
    {
        $submission = $this->submissionRepository->delete($id);
        return redirect()->back()->with('success', 'WFH telah dihapus');
        // return redirect('/backoffice/wfh')->with('success', 'WFH telah dihapus');
    }

    public function confirmWFH($id)
    {
        $submission = $this->submissionRepository->confirm($id);
        return redirect()->back()->with('success', 'WFH telah disetujui');
        // return redirect('/backoffice/wfh')->with('success', 'WFH telah disetujui');
    }

    public function rejectWFH(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect()->back()->with('success', 'WFH telah ditolak');
        // return redirect('/backoffice/wfh')->with('success', 'WFH telah ditolak');
    }

    public function adjustWFH(Request $request, $id)
    {
        $submission = $this->submissionRepository->update($request, $id);
        return redirect()->back()->with('success', 'Pengajuan wfh telah disesuaikan');
        // return redirect('/backoffice/wfh')->with('success', 'Pengajuan wfh telah disesuaikan');
    }

    public function updateStatusDescriptionWFH(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect()->back()->with('success', 'Keterangan ditolak telah diubah');
        // return redirect('/backoffice/wfh')->with('success', 'Keterangan ditolak telah diubah');
    }

    // izin-sakit
    public function izinSakit(Request $request)
    {
        if(Auth::user()->role_id == 2){
            $user = User::find(Auth::user()->id);
            $submissions = $this->submissionRepository->getAllNonTypeCuti($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $cuti = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $cuti = $submissions->where('type', 'cuti')->count();
            }
    
            return view('backoffice.submission.izin-sakit.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti', 'user'])); 
        }else{

            $users = User::where('role_id', 2)->get();
            $submissions = $this->submissionRepository->getAllNonTypeCuti($request);
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $hadir = null;
            $sakit = null;
            $izin = null;
            $cuti = null;
    
            if ($bulan && $tahun) {
                $sakit = $submissions->where('type', 'sakit')->count();
                $izin = $submissions->where('type', 'izin')->count();
                $cuti = $submissions->where('type', 'cuti')->count();
            }
    
            return view('backoffice.submission.izin-sakit.index', compact(['submissions', 'bulan', 'tahun', 'hadir', 'sakit', 'izin', 'cuti', 'users'])); 
        }
    }

    public function storeIzinSakit(Request $request)
    {
        $submission = $this->submissionRepository->storeNonTypeCuti($request);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah ditambahkan');
    }

    public function updateIzinSakit(Request $request, $id)
    {
        // dd($request->all());
        $submission = $this->submissionRepository->update($request, $id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah diubah');
    }

    public function deleteIzinSakit($id)
    {
        $submission = $this->submissionRepository->delete($id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah dihapus');
    }

    public function confirmIzinSakit($id)
    {
        $submission = $this->submissionRepository->confirm($id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah disetujui');
    }

    public function rejectIzinSakit(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah ditolak');
    }

    public function adjustIzinSakit(Request $request, $id)
    {
        $submission = $this->submissionRepository->update($request, $id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Pengajuan telah disesuaikan');
    }

    public function updateStatusDescriptionIzinSakit(Request $request, $id)
    {
        $submission = $this->submissionRepository->reject($request, $id);
        return redirect('/backoffice/izin-sakit')->with('success', 'Keterangan ditolak telah diubah');
    }

    public function skdPreview($id)
    {
        $submission = $this->submissionRepository->getById($id);
        $file = Storage::disk('public')->get($submission->skd);
        $filename = $submission->user->name . '-' . $submission->start_date . '-' . $submission->end_date . '-skd.pdf';
        return response($file)->header('Content-Type', 'application/pdf')->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

}
