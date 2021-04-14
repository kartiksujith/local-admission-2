
 <div class="col-md-12">
        <div class="form-group">
          <style>
            th,td {
                text-align: center;
                border: 2px solid #000000;
            }
            .table_content{
              color: black;
              background: white;
              width: 100%;
              font-size: 15px;
              border: 2px solid #000000;
            }

          </style>
          <div class="col-md-12">
          <table class="table_content">
            <thead>
              <tr>
                <th style="font-size: 18px;" colspan="7">List of Students</th>
              </tr>
           </thead>
            <thead>
              <tr>
                <th>Sr.no</th>
                <th>Dte id</th>
                <th>Name</th>
                <th>Photo</th>
              </tr>
            </thead>
            <tbody>
                  @foreach($users as $key => $user)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$user->dte_id}}</td>
                <td style="white-space: nowrap;">{{$user->name_on_marksheet}}</td>
                <td><img src="{{ asset('/public/uploads/'.$user->dte_id.'_'.$user->hash.'/'.$user->photo_path) }}" height="100" width="80"></td>
              </tr>
               @endforeach
            </tbody>
          </table>
            </div>
        </div>
      </div>
</div>