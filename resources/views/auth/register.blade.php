<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Consent -->
            <div >
                <div>Declaration of consent</div>
                <div class="rounded-md border-2 p-2 mt-2">
                    <div>Declaration of consent in accordance with GDPR for the processing of data by the Düsseldorf University of Applied Sciences</div>
                    <div class="mt-2">For information on the scope of the processing of personal data, please refer to the <a href="{{ route('privacy') }}" class="underline">privacy policy</a>.</div>
                    <div class="mt-2">Right of withdrawal</div>
                    <div class="mt-2">The undersigned has the right to revoke this consent at any time without giving a reason with effect for the future. An e-mail to the person responsible according to the imprint is sufficient for this. The legality of the processing carried out on the basis of the consent up to the point of revocation is not affected by the revocation.</div>
                    <div class="mt-2">Consequences of not signing</div>
                    <div class="mt-2">The undersigned has the right not to agree to this declaration of consent - however, since CpVulGuard relies on the collection and processing of the data specified in the privacy policy, failure to sign would preclude use of the service.</div>
                    <div class="mt-2">Consent of the person concerned</div>
                    <div class="mt-2">By clicking on the following checkbox I consent to the collection and processing of my data by the Düsseldorf University of Applied Sciences voluntarily within the meaning of the <a href="{{ route('privacy') }}" class="underline">privacy policy</a> and I confirm that I have been informed about the data processing and my rights.</div>
                </div>
                <div class="flex items-start justify-start mt-2">
                    <x-label for="consent" value="Consent to terms:" />
                    <x-input id="consent" class="block mt-1 ml-4" type="checkbox" name="consent" required autofocus />
                </div>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
