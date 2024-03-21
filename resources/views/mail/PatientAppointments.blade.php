<x-mail::message>
 Hello Mr OR Miss {{ $PatientAppointment->name }} <br>

لقد تم تاكيد موعد الحجز للدكتور {{ $PatientAppointment->doctor->name }}
<br>
يرجي القدوم في الموعد المحدد وهو {{ $PatientAppointment->appointment }}

{{--  <x-mail::button :url="''">
Button Text
</x-mail::button>  --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
