<html>
    @foreach($requests as $request)
            <tr>
              <td>{{$request->User}}</td>
            </tr>
    @endforeach
</html>