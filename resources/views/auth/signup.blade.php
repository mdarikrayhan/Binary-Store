@extends('layouts.app')

@section('title', 'Sign Up - Binary Store')

@section('content')
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="{{ asset('uploads/images/logo.svg') }}" alt="Binary Store">
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form class="space-y-6" action="{{ route('auth.signup.post') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- First Name -->
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-900">First name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-900">Last name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name" autocomplete="family-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="sm:col-span-3">
                        <label for="phone" class="block text-sm font-medium text-gray-900">Phone</label>
                        <div class="mt-2">
                            <input type="tel" name="phone" id="phone" autocomplete="tel"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="new-password"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm
                            Password</label>
                        <div class="mt-2">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>

                    <!-- Division -->
                    <div class="sm:col-span-3">
                        <label for="division" class="block text-sm font-medium text-gray-900">Division</label>
                        <div class="mt-2">
                            <select id="division" name="division"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option value="">Select Division</option>
                            </select>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="sm:col-span-3">
                        <label for="district" class="block text-sm font-medium text-gray-900">District</label>
                        <div class="mt-2">
                            <select id="district" name="district"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>

                    <!-- Upazila -->
                    <div class="sm:col-span-3">
                        <label for="upazila" class="block text-sm font-medium text-gray-900">Upazila</label>
                        <div class="mt-2">
                            <select id="upazila" name="upazila"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                disabled>
                                <option value="">Select Upazila</option>
                            </select>
                        </div>
                    </div>

                    <!-- Zip Code -->
                    <div class="sm:col-span-3">
                        <label for="zipcode" class="block text-sm font-medium text-gray-900">Zip code</label>
                        <div class="mt-2">
                            <select id="zipcode" name="zipcode"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                disabled>
                                <option value="">Select Zip Code</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        up</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="/signin" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        // Load JSON data from Laravel public folder
        const divisionData = @json(json_decode(file_get_contents(public_path('json/divisions.json')), true));
        const districtData = @json(json_decode(file_get_contents(public_path('json/districts.json')), true));
        const upazilaData = @json(json_decode(file_get_contents(public_path('json/upazilas.json')), true));
        const postalCodeData = @json(json_decode(file_get_contents(public_path('json/postcodes.json')), true));

        console.log(postalCodeData);
        const divisionSelect = document.getElementById('division');
        const districtSelect = document.getElementById('district');
        const upazilaSelect = document.getElementById('upazila');
        const postalCodeSelect = document.getElementById('zipcode');

        // Populate Divisions
        divisionData.divisions.forEach(division => {
            const option = document.createElement('option');
            option.value = division.id;
            option.textContent = division.name;
            divisionSelect.appendChild(option);
        });

        divisionSelect.addEventListener('change', function () {
            const selectedDivisionId = this.value;
            districtSelect.innerHTML = '<option value="">Select District</option>';
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            postalCodeSelect.innerHTML = '<option value="">Select Zip Code</option>';

            districtSelect.disabled = true;
            upazilaSelect.disabled = true;
            postalCodeSelect.disabled = true;

            if (selectedDivisionId) {
                const districts = districtData.districts.filter(d => d.division_id === selectedDivisionId);
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
                districtSelect.disabled = false;
            }
        });

        districtSelect.addEventListener('change', function () {
            const selectedDistrictId = this.value;
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            postalCodeSelect.innerHTML = '<option value="">Select Zip Code</option>';

            upazilaSelect.disabled = true;
            postalCodeSelect.disabled = true;

            if (selectedDistrictId) {
                const upazilas = upazilaData.upazilas.filter(u => u.district_id === selectedDistrictId);
                upazilas.forEach(upazila => {
                    const option = document.createElement('option');
                    option.value = upazila.id;
                    option.textContent = upazila.name;
                    upazilaSelect.appendChild(option);
                });
                upazilaSelect.disabled = false;
            }
        });

        upazilaSelect.addEventListener('change', function () {
            const selectedUpazilaName = this.options[this.selectedIndex].textContent;
            postalCodeSelect.innerHTML = '<option value="">Select Zip Code</option>';
            postalCodeSelect.disabled = true;

            if (selectedUpazilaName) {
                const postalCodes = postalCodeData.postcodes.filter(p => p.upazila === selectedUpazilaName);
                postalCodes.forEach(postalCode => {
                    const option = document.createElement('option');
                    option.value = postalCode.postCode;
                    option.textContent = `${postalCode.postOffice} - ${postalCode.postCode}`;
                    postalCodeSelect.appendChild(option);
                });
                postalCodeSelect.disabled = false;
            }
        });
    </script>
@endsection