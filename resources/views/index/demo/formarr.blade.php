<form action="/index/demo/formarr" method="post">
    <input type="text" name="key[]">
    <input type="text" name="key[]">
    <input type="text" name="key[]">
    <input type="text" name="key[]">
    <input type="text" name="_token" value="{{csrf_token()}}">
    <input type="submit">
</form>