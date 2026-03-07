<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\QueueTicket;

class QueueController extends Controller
{
    // Show the public facing page
    public function index()
    {
        $services = Service::all();
        return view('index', compact('services'));
    }

    // Show the admin facing page
    public function admin()
    {
        $services = Service::all();
        return view('admin', compact('services'));
    }

    // API: Take a new queue ticket
    public function take(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id'
        ]);

        $service = Service::findOrFail($request->service_id);
        
        // Find the last queue number for today
        $lastTicket = QueueTicket::where('service_id', $service->id)
            ->whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastTicket) {
            // Extract the numeric part (e.g. from A001 -> 1)
            $lastNumber = (int) substr($lastTicket->queue_number, 1);
            $nextNumber = $lastNumber + 1;
        }

        $formattedNumber = $service->code . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $ticket = QueueTicket::create([
            'service_id' => $service->id,
            'queue_number' => $formattedNumber,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'ticket' => $ticket,
            'message' => 'Antrian berhasil diambil: ' . $formattedNumber
        ]);
    }

    // API: Call the next queue for a service
    public function callForService(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id'
        ]);

        $nextTicket = QueueTicket::where('service_id', $request->service_id)
            ->where('status', 'pending')
            ->orderBy('id', 'asc')
            ->first();

        if (!$nextTicket) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada antrian.'
            ]);
        }

        // Optional: mark previously called tickets as completed if they are from the same service
        // depending on your exact business logic. Here we just simple call it.
        QueueTicket::where('status', 'called')->update(['status' => 'completed']);

        $nextTicket->update([
            'status' => 'called',
            'called_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'ticket' => $nextTicket,
            'message' => 'Memanggil antrian: ' . $nextTicket->queue_number
        ]);
    }

    // API: Get the currently active/called ticket and all queue summary
    public function getStatus()
    {
        $calledTicket = QueueTicket::with('service')
            ->where('status', 'called')
            ->orderBy('called_at', 'desc')
            ->first();

        $services = Service::all()->map(function($s) {
            $pendingCount = QueueTicket::where('service_id', $s->id)->where('status', 'pending')->count();
            return [
                'id' => $s->id,
                'name' => $s->name,
                'code' => $s->code,
                'pending_count' => $pendingCount
            ];
        });

        return response()->json([
            'active' => $calledTicket,
            'summary' => $services
        ]);
    }
}
