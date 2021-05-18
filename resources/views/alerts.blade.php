@if (session('alert-ok'))
<div class="alert alert-card alert-success text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h5>{!! session('alert-ok') !!}</h5>
</div>
<div class="row mb-4"></div>
@endif

@if (session('alert-fail'))
<div class="alert alert-card alert-danger text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h5>{!! session('alert-fail') !!}</h5>
</div>
<div class="row mb-4"></div>
@endif

@if (session('alert-alert'))
<div class="alert alert-card alert-warning text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h5>{!! session('alert-alert') !!}</h5>
</div>
<div class="row mb-4"></div>
@endif