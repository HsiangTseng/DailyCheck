<html>
<body>

<h1>Login Pratice</h1>

<form action="/check_login" method="post" target="_blank">
  @csrf
  <label for="id">User id:</label>
  <input type="text" id="id" name="id"><br><br>
  <label for="pwd">User pwd:</label>
  <input type="text" id="pwd" name="pwd"><br><br>
  <input type="submit" value="Submit">
</form>


</body>
</html>
