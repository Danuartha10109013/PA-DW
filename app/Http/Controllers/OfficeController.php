<?php

namespace App\Http\Controllers;

use App\Http\Repository\OfficeRepository;
use App\Http\Repository\ShiftRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfficeController extends Controller
{
    private $officeRepository;
    private $shiftRepository;

    public function __construct(OfficeRepository $officeRepository, ShiftRepository $shiftRepository)
    {
        $this->officeRepository = $officeRepository;
        $this->shiftRepository = $shiftRepository;
    }

    public function index()
    {
        $offices = $this->officeRepository->getAll();
        $office = $this->officeRepository->getAll();
        $shift = $this->shiftRepository->getAll();
        return view('backoffice.office.index', compact(['office', 'shift']));
    }

    public function create(Request $request)
    {
        $office = $this->officeRepository->store($request);
        return redirect()->back()->with('success', 'Kantor telah ditambahkan');
    }

    public function detail($id)
    {
        $office = $this->officeRepository->getById($id);
        return view('backoffice.office.detail', compact('office'));
    }

    public function update(Request $request, $id)
    {
        $office = $this->officeRepository->update($id, $request);
        $shift = $this->shiftRepository->update($id, $request);
        return redirect()->back()->with('success', 'Kantor telah diperbarui');
    }

    public function delete($id)
    {
        $office = $this->officeRepository->delete($id);
        return redirect()->back()->with('success', 'Kantor telah dihapus');
    }

    public function generate()
    {
        $office = $this->officeRepository->generate();
        return redirect()->back()->with('success', 'Generate ulang qrcode');
    }

    public function qrcode(){
        $office = $this->officeRepository->getAll();
        return view('qrcode.index',compact('office'));
    }

    public function download()
    {
        $office = $this->officeRepository->getAll();
        return response()->download(storage_path('app/public/qrcode/' . $office->qrcode . '.png'));
    }
}
