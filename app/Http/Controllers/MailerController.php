<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DynamicMailerService;
use App\Models\MailerSetting;
use Illuminate\Support\Facades\Log;
use App\Mail\GenericMail;
use Illuminate\Support\Facades\Mail;

class MailerController extends Controller
{
    //
    public function index()
    {
        $config = MailerSetting::latest()->first();
        return view('mailer.index', compact('config'));
    }

    public function save(Request $request)
    {
        try {
            $validated = $request->validate([
                'mail_mailer' => 'required|string',
                'mail_host' => 'required|string',
                'mail_port' => 'required',
                'mail_username' => 'required|string',
                'mail_password' => 'required|string',
                'mail_encryption' => 'required|string',
                'mail_from_address' => 'required|email',
                'mail_from_name' => 'required|string',
            ]);

            MailerSetting::updateOrCreate([], $validated);

            return back()->with('success', 'Mailer configuration saved successfully!');
        }

        //enable this for log debuging
        // catch (\Illuminate\Validation\ValidationException $e) {
        //     \Log::error('Validation failed', $e->errors());
        //     throw $e;
        // }
        catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Example API endpoint for sending mail
    public function send(Request $request, DynamicMailerService $mailer)
    {
        try {
            Log::channel('mail_logs')->info('📩 Test mail send requested', [
                'input' => $request->all(),
            ]);

            $validated = $request->validate([
                'to' => 'nullable|email',
                'subject' => 'nullable|string',
                'title' => 'nullable|string',
                'body' => 'nullable|string',
            ]);

            $mailArray = [
                'message' => $validated['body'],
                'title' => $validated['title'],
            ];

            // ✅ Use Mailable instead of raw body
            Mail::to($validated['to'])->send(
                new GenericMail($validated['subject'], $validated['body'], $mailArray)
            );

            Log::channel('mail_logs')->info('✅ Mail send result', [
                'to'        => $validated['to'],
                'subject'   => $validated['subject'],
                'success'   => true,
                'timestamp' => now()->toDateTimeString(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Mail sent successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::channel('mail_logs')->error('❌ Validation failed during test mail send', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::channel('mail_logs')->error('💥 Unexpected error during test mail send', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unexpected error while sending mail.',
            ], 500);
        }
    }
}
