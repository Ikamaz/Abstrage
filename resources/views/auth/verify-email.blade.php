<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('მადლობა რეგისტრაციის გავლისთვის! კალათაში პროდუქციის ჩამატებამდე, გთხოვთ დაადასტუროთ თქვენი ელფოსტაზე გამოგზავნილი ბმულზე ერთი დაწკაპუნებით, რომელიც ახლახან გამოგიგზავნეთ. თუ ელფოსტა არ მიგიღიათ, ჩვენ გამოგიგზავნით სხვა მეილს ამის არარსებობის შემთხვევაში გთხოვთ შეამოწმოთ SPAM საქაღალდე.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('ახალი დამადასტურებელი ბმული გაიგზავნა იმ ელ.ფოსტის მისამართზე, რომელიც მიუთითეთ რეგისტრაციისას.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('ელფოსტის ლინკის ხელახლა გაგზავნა') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-md text-gray-600 hover:text-gray-1000 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('გასვლა') }}
            </button>
        </form>
    </div>
</x-guest-layout>
