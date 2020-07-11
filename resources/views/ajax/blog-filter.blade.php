<table class="table">
   <tr>
        <th> BLog Title </th> 
        <th> Blog Description </th> 
        <th> Categories </th> 
        <th> Created Date  </th> 
        <th> Event Status </th>  
   </tr>

   <tbody>
       @foreach($data as $value) 
            <tr>
                <th> {{ $value->title }}</th>
                <th> {{ $value->description }}</th>
                <th> {{ $value->categories() }}</th>
                <th> {{ $value->created_at }}</th>
                <th> {{ $value->is_active == 1 ? 'Active' : 'In-active' }}</th>
            </tr>
       @endforeach
   </tbody>
</table>