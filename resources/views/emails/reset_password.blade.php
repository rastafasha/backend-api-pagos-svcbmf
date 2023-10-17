@component('mail::message')
# Cambio de Contrase単a
Resetea o cambia tu contrase単a.
@component('mail::button', ['url' => 'https://www.svcbmf.org/pagossvc/#/change-password?token='.$token])
<!--@component('mail::button', ['url' => 'http://localhost:4200/#/change-password?token='.$token])-->
Cambiar Contrase単a
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
