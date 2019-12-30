@extends('layout.dashboard_v2')
@section('content')

<div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>Table <span class="semi-bold">Styles</span></h4>
          <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="reload"></a>
          </div>
        </div>
        <div class="grid-body ">
          <table class="table table-hover table-condensed" id="brands-datatable">
            <thead>
              <tr>
                <th style="">ID</th>
                <th style="">Brand Name</th>
                <th style="">Description</th>
                <th class="text-center" style="">Logo</th>
                <th style="">Action</th>
                {{-- <th style=""></th> --}}
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')
    <script src="/custom/datatable-extra.js" type="text/javascript" defer></script>
    <script src="/custom/brands-index.js" type="text/javascript" defer></script>
@show
