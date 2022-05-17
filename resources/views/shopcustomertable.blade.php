@extends("shoptheme")
@section("content")

        <!-- Page Content  -->
    <br>
        <h1 class="mb-4">Customer Details</h1>
    <br>
   
    <button id="hide" class="btn btn-primary" onclick="window.print()">&nbsp;Print&nbsp;</button>
    <br>
    <br>
   
    <table class="table table-stripped  table-responsive  ">
    <thead class="thead-dark">
    <tr class="dark">
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">PHONE NUMBER</th>
      <th scope="col">DATE JOINED</th>
    </tr>
  </thead>
  <tbody>
        @foreach($cust as $di)
    <tr>   
      <td>{{ $di->id }}</td>
      <td>{{ $di->c_name }}</td>
      <td>{{ $di->c_mail }}</td>
      <td>{{ $di->c_phone }}</td>
      <td>{{ $di->created_at->format('d-m-Y') }}</td>
    </tr>
        @endforeach
  </tbody>
  </table>
@endsection