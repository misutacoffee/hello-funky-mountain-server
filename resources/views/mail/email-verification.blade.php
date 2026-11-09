<x-mail::message>
# Verify Your Email Address

Hello {{ $name }},

Thank you for registering!

Please verify your email address by clicking the button below.

<x-mail::button :url="$url" color="primary">
    Verify Email Address
</x-mail::button>

If you did not create an account, no further action is required.

Thanks,

{{ config('app.name') }}
</x-mail::message>