@extends("shoptheme")
@section("content")

        <!-- Page Content  -->
    <br>
        <h1 class="mb-4">Messages</h1>
    <br>
   
    
    <button id="hide" class="btn btn-primary" onclick="window.print()">&nbsp;Print&nbsp;</button>
    <br>
    
   @if(count($msg)>0)
    <table class="table table-stripped  table-responsive  ">
    <thead class="thead-dark">
    <tr class="dark">
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">SUBJECT</th>
      <th scope="col">MESSAGE</th>
      <th scope="col">DATE RECIEVED</th>
    </tr>
  </thead>
  <tbody>
        @foreach($msg as $di)
    <tr>   
      <td>{{ $di->id }}</td>
      <td>{{ $di->name }}</td>
      <td>{{ $di->mail }}</td>
      <td>{{ $di->sub }}</td>
      <td>{{ $di->msg}}</td>
      <td>{{ $di->created_at->format('d-m-Y') }}</td>
    </tr>
        @endforeach
  </tbody>
  </table>
  @else
  <p class="text-dark"><h4>Nil</h4></p>
  @endif
@endsection