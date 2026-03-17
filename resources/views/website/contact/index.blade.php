@extends('website.layouts.master2')

@section('styles')
    <style>

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Bold.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowL';
            src: url("{{ asset('storage/font/Now-Light.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowM';
            src: url("{{ asset('storage/font/Now-Medium.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowTh';
            src: url("{{ asset('storage/font/Now-Thin.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        .head{
            font-family: "NowM", sans-serif;
            font-size: 36px;
        }
        .para{
            font-family: "NowR", sans-serif;
            font-size: 20px;
            line-height: 30px;
        }


         @media (max-width: 768px) {
            .head{
            font-size: 30px;
        }
            .para{
                font-size: 15px;
            }
        }
        
        
        .section1{
            margin-bottom : 250px;
        }



    </style>

@endsection

@section('content')


<div class="container my-5 py-3 ">
    <div class="row justify-content-center section1">
      <!-- Text Section -->
      <div class="col-md-6 mb-4">
        <h2 class="head text-dark">{{__('contact.welcome_message')}}</h2>
        <p class="text-muted para">
          {{__('contact.contact_us_message_1')}}
        </p>
        <p class="text-muted para">
            {{__('contact.contact_us_message_2')}}
        </p>
        <p class="mt-3 para">{{__('contact.contact_email')}}</p>
      </div>

      <!-- Form Section -->
      <div class="col-md-6">
        <div class="p-4 shadow rounded bg-white">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="full_name" class="form-label">{{__('contact.full_name')}}</label>
                    <input
                        type="text"
                        class="form-control @error('full_name') is-invalid @enderror"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name') }}"
                        placeholder="{{ __('contact.full_name') }}"
                        required
                    >
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{__('contact.email')}}</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="mail@company.com"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{__('contact.phone_number')}}</label>
                    <div class="input-group">
                        <select
                            class="form-select @error('country_code') is-invalid @enderror"
                            name="country_code"
                            id="country_code"
                            style="max-width: 100px;"
                            required
                        >
                            <option value="">Code</option>
                                <option value="EG" {{ old('country_code') == 'EG' ? 'selected' : '' }}>EG (+20)</option>
                                <option value="US" {{ old('country_code') == 'US' ? 'selected' : '' }}>US (+1)</option>
                                <option value="SA" {{ old('country_code') == 'SA' ? 'selected' : '' }}>SA (+966)</option>
                                <option value="AE" {{ old('country_code') == 'AE' ? 'selected' : '' }}>AE (+971)</option>
                                <option value="UK" {{ old('country_code') == 'UK' ? 'selected' : '' }}>UK (+44)</option>
                                <option value="FR" {{ old('country_code') == 'FR' ? 'selected' : '' }}>FR (+33)</option>
                                <option value="DE" {{ old('country_code') == 'DE' ? 'selected' : '' }}>DE (+49)</option>
                                <option value="IN" {{ old('country_code') == 'IN' ? 'selected' : '' }}>IN (+91)</option>
                        </select>
                        <input
                            type="tel"
                            class="form-control @error('phone') is-invalid @enderror"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="000 000 0000"
                            required
                        >
                    </div>
                    @error('country_code')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inquiry" class="form-label">{{__('contact.inquiry')}}</label>
                    <textarea
                        class="form-control @error('inquiry') is-invalid @enderror"
                        id="inquiry"
                        name="inquiry"
                        rows="4"
                        placeholder="{{ __('contact.leave_message') }}"
                        required
                    >{{ old('inquiry') }}</textarea>
                    @error('inquiry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">{{__('contact.send_message')}}</button>
            </form>

        </div>
      </div>
    </div>
  </div>
@endsection
