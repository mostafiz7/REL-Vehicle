@extends('layouts.app')

{{--@section('title', 'Create Vehicle-Parts New Purchase')--}}

@section('content')
<div class="Page Vehicle-Parts-Purchase New">
  <div class="page-wrapper">
    <div class="new-parts-purchase-page">
      <div class="container-fluid">
        <div class="page-content">
          <div class="page-header">
            <h4 class="title">Parts New Purchase</h4>
          </div>


          <div class="page-body">



          </div> {{-- ./page-body --}}
        </div> {{-- ./page-content --}}
      </div> {{-- ./container --}}
    </div> {{-- ./page-name --}}
  </div> {{-- ./page-wrapper --}}
</div> {{-- ./Page View-Name --}}
@endsection



@section('custom-script')
<script>

	// Showing Session Error or Success Message
	let sessionError = null, sessionSuccess = null;

  @if ( session('error') )
    sessionError = @json( session('error') );
  @elseif ( session('success') )
    sessionSuccess = @json( session('success') );
  @endif

	if( sessionError ){
		Swal.fire({
			icon: 'error',
			title: 'Oops! Sorry.',
			text: sessionError,
		});
	} else if( sessionSuccess ){
		Swal.fire({
			icon: 'success',
			title: 'Thank You!',
			text: sessionSuccess,
		});
	}

</script>
@endsection