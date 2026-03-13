<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Room;

class RegistrationController extends Controller
{
    /** Ambil semua kamar dikelompokkan per lantai untuk dropdown */
    private function getRoomsForDropdown(?Registration $excludeReg = null): \Illuminate\Support\Collection
    {
        return Room::orderBy('room_number')->get()->groupBy('floor');
    }

    public function index(Request $request)
    {
        $query = Registration::with(['room1', 'room2'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('room1', fn($r) => $r->where('room_number', 'like', "%$search%"))
                    ->orWhereHas('room2', fn($r) => $r->where('room_number', 'like', "%$search%"));
            });
        }

        if ($request->filled('date')) {
            $query->where('arrival_date', $request->date);
        }

        if ($request->boolean('staying')) {
            $query->currentlyStaying();
        }

        $registrations = $query->paginate(15)->withQueryString();

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        $roomsByFloor = $this->getRoomsForDropdown();
        $roomTypes    = ['Standard', 'Superior', 'Deluxe', 'Suite', 'Executive'];
        return view('registrations.create', compact('roomsByFloor', 'roomTypes'));
    }

    public function store(RegistrationRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('arrival_date') && $request->filled('arrival_time_only')) {
            $data['arrival_time'] = $request->arrival_date . ' ' . $request->arrival_time_only . ':00';
        }

        $registration = Registration::create($data);

        return redirect()
            ->route('registrations.show', $registration)
            ->with('success', 'Data registrasi berhasil disimpan!');
    }

    public function show(Registration $registration)
    {
        $registration->load(['room1', 'room2']);
        return view('registrations.show', compact('registration'));
    }

    public function edit(Registration $registration)
    {
        $roomsByFloor = $this->getRoomsForDropdown($registration);
        $roomTypes    = ['Standard', 'Superior', 'Deluxe', 'Suite', 'Executive'];
        return view('registrations.edit', compact('registration', 'roomsByFloor', 'roomTypes'));
    }

    public function update(RegistrationRequest $request, Registration $registration)
    {
        $data = $request->validated();

        if ($request->filled('arrival_date') && $request->filled('arrival_time_only')) {
            $data['arrival_time'] = $request->arrival_date . ' ' . $request->arrival_time_only . ':00';
        }

        $registration->update($data);

        return redirect()
            ->route('registrations.show', $registration)
            ->with('success', 'Data registrasi berhasil diperbarui!');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('registrations.index')
            ->with('success', 'Data registrasi berhasil dihapus!');
    }

    public function print(Registration $registration)
    {
        $registration->load(['room1', 'room2']);
        return view('registrations.print', compact('registration'));
    }
}
