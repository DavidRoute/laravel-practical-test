@component('mail::message')
# {{ $form->title }}

I've invited you to fill out a form:

@component('mail::button', ['url' => ''])
Fill Out Form
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
