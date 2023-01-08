@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Admin Interface</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/admin/banUser"><button type="" class="buttonBanUser">
                    {{ __('Ban User') }}
                </button></a>
            </div>
            <div class="col">
                <a href="/admin/removeProducts"><button type="submit" class="buttonRegister">
                    {{ __('Remove Products') }}
                </button></a></div>
        </div>
    </div>
@endsection
