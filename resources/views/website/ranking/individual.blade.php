@extends('website.layouts.master2') {{-- أو أي Layout تستخدمه --}}

@section('title', 'Individual Rankings')


@section('content')
<div class="container py-5 mb-5">
    <h1 class="mb-4">Individual Rankings</h1>

    <div class="row g-4">

        {{-- Individual --}}
        <div class="col-12">
            <h3>Individual</h3>
            <p></p>
        </div>

        {{-- Salespeople --}}
        <div class="col-12">
            <h3>Salespeople</h3>
            <p></p>
        </div>

        {{-- Broker --}}
        <div class="col-12">
            <h3>Broker</h3>
            <p></p>
        </div>

        {{-- CEO’s --}}
        <div class="col-12 mb-5 pb-5">
            <h3>CEO’s</h3>
            <p></p>
        </div>

    

    </div>
</div>
@endsection
