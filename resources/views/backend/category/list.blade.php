@extends('layouts.admin_master')
@section('admin_main_content')
<div class="row">

</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <h5 class="card-header">All Categories</h5>
            <div class="table-responsive text-nowrap">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL. No.</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
@forelse ($categories as $key=> $category)
<tr>
    <td>
        <h6 class="text-sm">{{$categories->firstItem()+$key }}</h6>
    </td>
    <td>
      <p>{{ $category->name }}</p>
    </td>
    <td>
        <p>{{ $category->slug }}</p>
    </td>
    <td>
        <div class="form-check form-switch toggle-switch">
            <input class="form-check-input change_status" type="checkbox" id="toggleSwitch2" {{$category->status ? 'checked':''}} data-category-id="{{ $category->id }}">
          </div>
    </td>
    <td>
        <div class="action">
            <a href="{{ route('category.edit',$category->id) }}" class="btn-sm main-btn info-btn btn-hover btn btn-success">
                <box-icon name='edit'></box-icon>
            </a>

            <button  class="btn-sm main-btn info-btn btn-hover btn btn btn-danger">
              <box-icon class="delete_btn " name='trash' type='solid' ></box-icon>
            <form action="{{ route('category.delete',$category->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
            </button>
          </div>
      </td>
  </tr>
@empty
<tr>
    <td colspan='5' class="text-center text-danger"><strong>No Data Found!</strong></td>
</tr>
@endforelse
                </tbody>
              </table>
            </div>
          </div>
    </div>

    <div class="col-lg-4">

            <div class="card mb-4">
              <h5 class="card-header">{{ isset($editdata) ? 'Update Category' : 'Create New Category'}}</h5>

            <form action="{{ isset($editdata) ? route('category.update',$editdata->id) : route('category.store') }}" method="POST">
                @isset($editdata)
@method('PUT')
                @endisset
             @csrf
              <div class="card-body">
                    <div>
                      <label for="defaultFormControlInput" class="form-label">Category Name</label>
                      <input type="text" name="name" class="form-control" style="margin-bottom: 20px" value="{{ isset($editdata) ? $editdata->name : ''}}
                      " >
                      @error('name')
<p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
           <button type="submit" class="btn btn-primary btn-lg w-100">{{ isset($editdata) ? 'Update Category' : 'Create New Category'}}</button>
            </form>


              </div>

            </div>



</div>
    </div>
</div>
@endsection


@push('additional_js')
<script src="{{ asset('backend/assets/js/sweetalert2@11.js') }}"></script>
<script>

$('.delete_btn').on('click',function(){
    Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    $(this).next('form').submit();
  }
});

})
</script>
<script>
    $('.change_status').on('change',function(){
        $.ajax({
            url:"{{ route('category.change_status') }}",
            method:"GET",
            data:{
                category_id:$(this).data('category-id')
            },
            success:function(res){
                Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Status Changed Successfully",
  showConfirmButton: false,
  timer: 1500
});
            }
        })
         })
</script>

@endpush


