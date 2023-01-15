@extends('layouts.app')

@section('title')
Online shopping | My Residences
@endsection

@section('content')
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">My Residences</h3>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success" id="alert">
    <p>{{ $message }}</p>
</div>
@endif
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-7">
                <!-- Billing Details -->

                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Residence</h3>
                    </div>
                    <form method="POST" action="{{ route('addResidence', Auth::user()->name) }}">
                        @csrf
                        <div class="form-group">

                            <label for="name" class="col-md-4 col-form-label text-md-end" c>{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="input" name="address"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end" id="LabelInput">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="input" name="city"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end" id="LabelInput">{{ __('Postal Code') }}</label>

                            <div class="col-md-6">
                                <input id="postalCode" type="text" class="input" name="postalCode"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end" id="LabelInput">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <select class="inputSelectCountry" class="inputSelectCountry" name="country" id="country">
                                    <option value="UK">United Kingdom</option>
                                    <option value="PT">Portugal</option>
                                    <option value="US">United States</option>
                                    <option value="FR">French</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="buttonRegister">
                                    {{ __('Insert Address') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="section-title">
                    <h4 class="title" id="myResidencesSection">My Residences</h4>
                </div>
                <table class="table" style="margin-top: 10px">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Country</th>
                            <th scope="col">Postal Code</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residence as $residences)
                        <tr>
                            <td>{{ $residences->address }}</td>
                            <td>{{ $residences->city }}</td>
                            <td>{{ $residences->country }}</td>
                            <td>{{ $residences->postalCode }}</td>
                            <td>
                                <form action="{{ route('deleteResidence', [Auth::user()->name, $residences->id]) }}" method="POST">
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="buttonDelete">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                {!! $residence->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>

@endsection