<x-mail::message>
# Newly created account

Welcome {{$user->name}},
Kindly verify your account

<x-mail::button :url="route('verification.verify', ['id' => $user->id])">
Verify
</x-mail::button>

Thanks,<br>
kyle
</x-mail::message>
