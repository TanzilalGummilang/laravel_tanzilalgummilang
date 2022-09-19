@extends('layouts.master')
@section('title')
  Dashboard
@endsection

@section('main-content')
  <div class="main-content">

    <div class="content-wrapper">
      <div class="row same-height">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header mt-2 mb-2">
              <h4>@yield('title')</h4>
            </div>
            <div class="card-body mb-1">

              <h5 class="mb-3 mt-1">PT Terakorp Indonesia</h5>
              <h6 class="fw-normal">Soal Coding Test screening.teramedik.com</h6>
              <h6 class="fw-normal">Screening Web Programmer</h6>
              <h6 class="fw-normal">Soal B</h6>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
