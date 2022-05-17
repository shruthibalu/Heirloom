@extends("dealertheme")
@section("content")
@section("user")
{{$LoggedUserInfo['d_name']}}
@endsection
        <!-- Page Content  -->
    <br>
        <h1 class="mb-4">Selling History</h1>
    <br>
    @if(Session::get('f'))
               <div class="alert alert-danger">
                  {{ Session::get('f') }}
               </div>
    @endif
    @if(Session::get('t'))
               <div class="alert alert-success">
                  {{ Session::get('t') }}
               </div>
    @endif 
        @if(Session::get('fail'))
               <div class="alert alert-warning">
                  {{ Session::get('fail') }}
               </div>
    @endif
    <div class="container">
    
   @if(count($dis)>0)
   <br>
    <button id="hide" class="btn btn-primary" onclick="window.print()">Print</button>
    <br>
    <br>
    <table class="table table-stripped  table-responsive  ">
    <thead class="thead-dark">
    <tr class="dark">
    <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">PRICE</th>
      <th scope="col">IMAGE</th>
      <th scope="col">STATUS</th>
      <th scope="col">ITEM ADDED ON</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
        @foreach($dis as $di)
        <tr>
        <!-- <tr class="table-row" data-href="/details{{$di->id}}{{$di->d_id}}"> -->
       {{csrf_field()}}
      <td>{{ $di->id }}</td>
      <td>{{ $di->di_name }}</td>
      <td>{{ $di->di_desc }}</td>
      <td>{{ $di->di_price }}</td>
      <td><img src="/fetch_image/{{ $di->id }}" width="100px" height="100px" alt="image"></td>
      <th>
      @if($di->di_status=="pending")
      pending
      @elseif($di->di_status=="rejected")
      rejected
      @else
      sold out
      @endif
      </th>
      <td>{{ $di->created_at->format('d-m-Y') }}</td>
    </tr>
        @endforeach
  </tbody>
  </table>
  <br>
  <br>
     
  <form action="/remove{{ $LoggedUserInfo['id'] }}" method="POST">
  {{csrf_field()}}
  <button  class="btn btn-secondary" type="submit">Clear Rejected Items</Button>
  </form>   
  @else
  <p class="text-dark"><h4>No history</h4></p>
  @endif
@endsection