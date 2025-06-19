<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactFormController 
{
    /**
     * Display contact form page
     */
    public function index(): View
    {
        $packages = ContactForm::getPackageOptions();
        return view('contact.index', compact('packages'));
    }

    /**
     * Store contact form submission
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'package_interest' => 'required|in:' . implode(',', array_keys(ContactForm::getPackageOptions())),
            'message' => 'nullable|string|max:1000',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor telepon harus diisi',
            'package_interest.required' => 'Pilih paket yang diminati',
            'package_interest.in' => 'Paket yang dipilih tidak valid',
            'message.max' => 'Pesan maksimal 1000 karakter',
        ]);

        try {
            $contactForm = ContactForm::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'package_interest' => $validated['package_interest'],
                'message' => $validated['message'] ?? null,
                'status' => ContactForm::STATUS_NEW,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.',
                'data' => [
                    'id' => $contactForm->id,
                    'whatsapp_link' => $contactForm->whatsapp_link
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Thank you page after form submission
     */
    public function thankYou(): View
    {
        return view('contact.thank-you');
    }
}
