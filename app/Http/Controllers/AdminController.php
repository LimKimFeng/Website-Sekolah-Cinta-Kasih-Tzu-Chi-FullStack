<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Candidate;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function dashboard()
    {
        $candidates = Candidate::with('user', 'profile', 'documents')->latest()->paginate(10);
        return view('admin.dashboard', compact('candidates'));
    }

    public function verify($id)
    {
        $candidate = Candidate::with('user', 'profile', 'documents')->findOrFail($id);
        return view('admin.verify', compact('candidate'));
    }

    public function updateStatus(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'status' => 'required|in:draft,submitted,verified,accepted,rejected',
            'exam_date_date' => 'nullable|date',
            'exam_date_time' => 'nullable',
        ]);

        $examDate = null;
        if ($request->exam_date_date && $request->exam_date_time) {
            $examDate = $request->exam_date_date . ' ' . $request->exam_date_time;
        } elseif ($request->exam_date_date) {
             $examDate = $request->exam_date_date . ' 00:00:00';
        }

        $candidate->update([
            'status' => $request->status,
            'exam_date' => $examDate,
        ]);

        // Email Notification Logic
        $pdfPath = null;
        if ($request->status == 'verified' && $candidate->exam_date) {
            // Generate PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.exam_card', compact('candidate'));
            $pdfPath = storage_path('app/public/exam_card_' . $candidate->registration_number . '.pdf');
            $pdf->save($pdfPath);
        }

        // Send Email
        try {
            \Illuminate\Support\Facades\Mail::to($candidate->user->email)->send(new \App\Mail\StatusUpdateMail($candidate, $pdfPath));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            // Log::error($e->getMessage());
        }

        Alert::success('Berhasil', 'Status berhasil diperbarui dan notifikasi dikirim.');
        return redirect()->route('admin.dashboard');
    }
}
