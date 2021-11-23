@extends('layouts.app')

{{--@section('title', 'Add New Parts-Categories')--}}

@section('content')
<div class="Page Parts-Categories New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Parts Categories</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="partsCategories-new-area overlay-scrollbar">
            <div class="row">
              <div class="col-md-6">
                <form method="post" action="{{ route('vehicle.parts.categories') }}"
                      name="addPartsCategoryForm" id="addPartsCategoryForm" class="partsCategory-form new mx-md-3 p-20 pb-0">
                  @csrf

                  <div class="fz-20 fw-bold mb-30 pb-5 bb-1">
                    Add New Category:
                  </div>

                  {{--Category-Name--}}
                  <div class="mb-30 name">
                    <label for="" class="required w-100 mr-15"><span>Category Name</span></label>
                    <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Radiator" value="{{ old('name') }}" />

                    @if ( $errors->has('name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>

                  {{--Description--}}
                  <div class="mb-30 description">
                    <label for="" class="w-100 mr-15"><span>Description</span></label>
                    <input type="text" name="description" id="description" class="form-control border-secondary brd-3 @error('description') is-invalid @enderror" value="{{ old('description') }}" />

                    @if ( $errors->has('description') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('description') }}
                      </div>
                    @endif
                  </div>


                  {{--Submit--}}
                  <div class="my-50 submit">
                    <div class="">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div>

                </form>
              </div>

              {{--Show All Parts-Category--}}
              <div class="col-md-6">
                <div class="mx-md-3 p-20 pb-0">
                  <div class="h-auto fz-20 fw-bold pb-5">
                    Category Lists:
                  </div>

                  <table class="table table-bordered border-secondary-1 table-hover parts-category-table">
                    <thead class="category-header text-center">
                      <tr class="category-row bb-0">
                        <th scope="col" class="serial bb-0">SL#</th>
                        <th scope="col" class="category-name bb-0">Name</th>
                        <th scope="col" class="category-description bb-0">Description</th>
                      </tr>
                    </thead>

                    <tbody class="category-body">
                      @if ( $category_all )
                        @foreach ( $category_all as $index => $category )
                          <tr class="category-row">
                            <td class="serial text-center">{{ $index+1 }}</td>
                            <td class="category-name">{{ $category->name }}</td>
                            <td class="category-description">{{ $category->description }}</td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div> {{-- ./page-content-area --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
  </div> {{-- ./container --}}
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