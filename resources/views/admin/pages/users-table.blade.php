@php
// Assuming you have a $users variable containing the user data retrieved from the database
$count = 1;
@endphp
@php
    $userType = auth()->user()->role_id;
@endphp

@foreach ($users as $user)
<tr>
  <td>{{ $count++ }}</td>
  <td class="py-1">
    <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}" />
  </td>
  <td>{{ $user->firstname }}</td>
  <td>{{ $user->lastname }}</td>
  <td>{{ $user->role->name }}</td>
  <td>{{ $user->email }}</td>
  <td>{{ $user->phone }}</td>
  <td>{{ $user->created_at->format('d M Y') }}</td>
  
  <td>
    @if ($userType == '1' || $userType == '4')
    <div class="btn-group">
      <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false">Action</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('user.edit', ['id' => $user->id]) }}">Edit</a>
        @if ($userType == '4')
        <a class="dropdown-item" class="btn btn-danger"
          onclick="return confirm('Are you sure you want to delete this user?')"
          href="{{ route('user.delete', ['id' => $user->id]) }}"style="color: red;">Delete</a>
          @endif
      </div>
    </div>
    @else 
    @endif
  </td>
</tr>
@endforeach