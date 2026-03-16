<?php

namespace App\Http\Requests;

use App\Models\Registration;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $registrationId = $this->route('registration')?->id;

        $roomRule = function ($attr, $value, $fail) use ($registrationId) {
            if (!$value) return;
            $room = Room::find($value);
            if (!$room) return;

            if ($room->status === 'maintenance') {
                $fail("Kamar {$room->room_number} sedang dalam maintenance.");
                return;
            }

            if ($room->status === 'occupied') {
                // Saat edit: boleh memilih kamar yang memang milik registrasi ini
                $isOwn = $registrationId && Registration::where(function ($q) use ($value) {
                    $q->where('room_id_1', $value)->orWhere('room_id_2', $value);
                })->where('id', $registrationId)->exists();

                if (!$isOwn) {
                    $fail("Kamar {$room->room_number} sudah terisi / occupied.");
                }
            }
        };

        return [
            'room_id_1'                => ['nullable', 'exists:rooms,id', $roomRule],
            'room_id_2'                => ['nullable', 'exists:rooms,id', 'different:room_id_1', $roomRule],
            'number_of_persons'        => 'nullable|integer|min:1|max:100',
            'number_of_rooms'          => 'nullable|integer|min:1|max:100',
            'room_type'                => 'nullable|string|max:50',
            'receptionist'             => 'nullable|string|max:100',
            'name'                     => 'required|string|max:255',
            'profession'               => 'nullable|string|max:100',
            'company'                  => 'nullable|string|max:255',
            'nationality'              => 'nullable|string|max:100',
            'id_passport_number'       => 'nullable|string|max:50',
            'birth_date'               => 'nullable|date|before:today',
            'address'                  => 'nullable|string|max:500',
            'phone'                    => 'nullable|string|max:20',
            'mobile_phone'             => 'nullable|string|max:20',
            'email'                    => 'nullable|email|max:255',
            'member_number'            => 'nullable|string|max:50',
            'arrival_time_only'        => 'nullable|date_format:H:i',
            'arrival_date'             => 'nullable|date',
            'departure_date'           => 'nullable|date|after_or_equal:arrival_date',
            'safety_deposit_box_number' => 'nullable|string|max:50',
            'issued_by'                => 'nullable|string|max:100',
            'issued_date'              => 'nullable|date',
            'payment_method'           => 'nullable|string|max:50',
            'payment_amount'           => 'nullable|numeric|min:0',
            'payment_reference'        => 'nullable|string|max:100',
            'payment_notes'            => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                 => 'Nama tamu wajib diisi.',
            'departure_date.after_or_equal' => 'Tanggal keberangkatan harus setelah atau sama dengan tanggal kedatangan.',
            'birth_date.before'             => 'Tanggal lahir harus sebelum hari ini.',
            'email.email'                   => 'Format email tidak valid.',
            'room_id_2.different'           => 'Kamar kedua tidak boleh sama dengan kamar pertama.',
        ];
    }

    public function attributes(): array
    {
        return [
            'room_id_1'   => 'Kamar 1',
            'room_id_2' => 'Kamar 2',
            'name'        => 'Nama',
            'profession' => 'Pekerjaan',
            'company'     => 'Perusahaan',
            'nationality' => 'Kebangsaan',
            'id_passport_number' => 'No. KTP / Paspor',
            'birth_date'  => 'Tanggal Lahir',
            'address' => 'Alamat',
            'phone'       => 'Telepon',
            'mobile_phone' => 'Handphone',
            'email'       => 'Email',
            'member_number' => 'No. Member',
            'arrival_date'    => 'Tanggal Kedatangan',
            'departure_date'  => 'Tanggal Keberangkatan',
            'safety_deposit_box_number' => 'Nomor Kotak Deposit',
            'issued_by'   => 'Dikeluarkan Oleh',
            'issued_date' => 'Tanggal',
        ];
    }
}
