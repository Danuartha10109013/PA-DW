<?php

namespace App\Http\Controllers;

use App\Http\Repository\OfficeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfficeController extends Controller
{
    private $officeRepository;

    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    public function index()
    {
        $offices = $this->officeRepository->getAll();
        return view('backoffice.office.index', compact('offices'));
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
        return redirect()->back()->with('success', 'Kantor telah diperbarui');
    }

    public function delete($id)
    {
        $office = $this->officeRepository->delete($id);
        return redirect()->back()->with('success', 'Kantor telah dihapus');
    }

    public function generate($id)
    {
        $office = $this->officeRepository->generate($id);
        return view('backoffice.office.generate', compact('office'))->with('success', 'Generate ulang qrcode');
    }

    public function download($id)
    {
        // $office = $this->officeRepository->download($id);

        $office = $this->officeRepository->getById($id);

        $qrcode = QrCode::format('png')->size(500)->generate($office->qrcode);
        dd($qrcode);

        Storage::disk('public')->put('qrcode/office/' . $office->qrcode . '.png', $qrcode);

        return redirect()->back()->with('success', 'Download qrcode');
    }
}
