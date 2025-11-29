<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Candidate;
use App\Models\CandidateProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateController extends Controller
{
    public function dashboard()
    {
        $candidate = Auth::user()->candidate;
        return view('student.dashboard', compact('candidate'));
    }

    public function biodata()
    {
        $candidate = Auth::user()->candidate;
        $profile = $candidate->profile;
        Session::put('biodata_load_time', now());
        return view('student.biodata', compact('candidate', 'profile'));
    }

    public function updateBiodata(Request $request)
    {
        // Time-Based Validation (Strict Mode > 60s) - Disabled
        // $loadTime = Session::get('biodata_load_time');
        // if (!$loadTime || now()->diffInSeconds($loadTime) < 60) {
        //     Alert::error('Error', 'Terlalu cepat! Mohon periksa kembali data Anda sebelum menyimpan.');
        //     return back();
        // }

        $request->validate([
            'nisn' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'religion' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $candidate = Auth::user()->candidate;

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        CandidateProfile::updateOrCreate(
            ['candidate_id' => $candidate->id],
            $data
        );

        if ($candidate->status === 'draft') {
            $candidate->update(['status' => 'submitted']);
        }

        Alert::success('Berhasil', 'Biodata berhasil disimpan.');
        return redirect()->route('student.dashboard');
    }

    public function payment()
    {
        return view('student.payment');
    }

    public function uploadPayment(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        $candidate = Auth::user()->candidate;

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            $candidate->documents()->create([
                'file_type' => 'payment_proof',
                'file_path' => $path,
            ]);

            // Update status if needed, or just notify admin
            // For now, let's keep status as submitted or change to payment_uploaded if we had that status
            // TSD says: Admin mencocokkan bukti transfer -> Input Tanggal Ujian -> Status berubah jadi payment_verified.
            // So status remains submitted until admin verifies.
        }

        Alert::success('Berhasil', 'Bukti pembayaran berhasil diupload.');
        return redirect()->route('student.dashboard');
    }
}
