<?php

namespace App\Http\Controllers;

use App\Http\Repository\AbsentRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $absentRepository;

    public function __construct(AbsentRepository $absentRepository)
    {
        $this->absentRepository = $absentRepository;
    }

    public function index(Request $request)
    {

        if (Auth::user()->role_id == 2) {
            return redirect('/backoffice/beranda/home/');
        }   elseif (Auth::user()->role_id == 3) {
            return redirect('/backoffice/report');
        }   else {

            $getAbsenTodays = $this->absentRepository->getAbsenToday();    
            $users = User::get();
            $getUserNoAbsen = User::where('role_id', '!=', 1)->whereNotIn('id', $getAbsenTodays->pluck('user_id'))->get();
            $countUserNoAbsen = $getUserNoAbsen->count();
            $totalUser = User::where('role_id',2)->count();
            $countAbsenToday = $this->absentRepository->countAbsenToday();
            $countCutiToday = $this->absentRepository->countCutiToday();
            $countIzinToday = $this->absentRepository->countIzinToday();
            $countSakitToday = $this->absentRepository->countSakitToday();
            $countWFHToday = $this->absentRepository->countWFHToday();

            $category = $request->category;
            if ($category == 'cuti') {
                $absens = $this->absentRepository->getCutiToday();
            } elseif ($category == 'wfh') {
                $absens = $this->absentRepository->getWFHToday();
            } else if ($category == 'izin') {
                $absens = $this->absentRepository->getIzinToday();
            } else if ($category == 'sakit') {
                $absens = $this->absentRepository->getSakitToday();
            } else if ($category == 'belum-hadir') {
                $absens = $getUserNoAbsen;
            } else {
                $absens = $this->absentRepository->getAbsenToday();
            }

            return view('backoffice.dashboard.index', compact('countAbsenToday', 'countWFHToday', 'countCutiToday', 'countIzinToday', 'countSakitToday', 'countUserNoAbsen', 'category', 'absens','totalUser'));
        }

    }
    public function indexkaryawan(Request $request)
    {

            return view('backoffice.karyawan.index');

    }
}
