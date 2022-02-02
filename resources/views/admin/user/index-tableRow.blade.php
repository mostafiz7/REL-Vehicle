<tr class="table-row content align-middle">
  <td class="serial w-30px-min text-center">{{ $index+1 }}</td>
  <td class="name">{{ $user->name }}</td>
  <td class="email">{{ $user->email }}</td>
  <td class="username">{{ $user->username }}</td>
  <td class="status text-center">
    @if ( $user->active )
      <span class="bg-success text-white py-1 px-5 brd-3">Active</span>
    @else
      <span class="bg-danger text-white py-1 px-5 brd-3">Not-Active</span>
    @endif
  </td>
  <td class="role">{{ $user->role->name ?? '- - -' }}</td>
  <td class="dept">
    {{ $user->employee->department->short_name ?? ($user->employee->department->name ?? '- - -') }}
  </td>
  <td class="action text-center">
    {{-- {{ route('user.single.show', $user->uid) }} --}}
    {{-- <a href="#" 
      class="user-single-show btn btn-primary fz-20 p-0 px-6 brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show User Details">
        <i class="fa fa-eye"></i>
      </span>
    </a> --}}

    @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryEdit') )
      <a href="{{ route('user.single.edit', $user->uid) }}" 
        class="user-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit User">
          <i class="fa fa-pencil"></i>
        </span>
      </a>
    @endif

    {{-- @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryDelete') )
      <a href="{{ route('user.single.delete', $user->uid) }}"
        onclick="return confirm('Are you sure to delete this user?');"
        class="delete-user btn btn-danger fz-20 p-0 px-7 brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete User">
          <i class="fa fa-trash"></i>
        </span>
      </a>
    @endif --}}
  </td>
</tr>