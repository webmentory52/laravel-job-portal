<x-mail::message>
    # Hello {{ $company->name }}

    {!! nl2br(e($message)) !!}

    Thanks,
    **{{ config('app.name') }} Admin Team**
</x-mail::message>
