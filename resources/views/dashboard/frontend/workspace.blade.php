<html>
  @if (Session::has('User'))
    <p>{{Session::get('User')}}</p>
  @endif
  @if (Session::has('Stock'))
    <p>{{Session::get('Stock')}}</p>
  @endif
</html>