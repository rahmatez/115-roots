@component('mail::message')
# Reply from Suicide Squad 11.5

Hello {{ $contactMessage->name }},

{!! nl2br(e($replyBody)) !!}

Thanks,<br>
{{ config('app.name') }}

---
*Your original message:*

**Subject:** {{ $contactMessage->subject }}

{{ $contactMessage->message }}
@endcomponent
