@if ($errors->any())
<div class="alert alert-danger mt-5">
  <h3>入力エラーがあります</h3>
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif