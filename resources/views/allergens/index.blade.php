@extends('layouts.app')
@section('title', 'アレルギー品目管理')

@section('content')
<h1>アレルギー品目管理</h1>
<a href="/allergens/create" class="btn btn-primary mb-3">アレルギー品目新規登録</a>
<table class="table">
  <tr>
    <th>{{__('validation.attributes.allergen_key')}}</th>
    <th>{{__('validation.attributes.lang')}}</th>
    <th>{{__('validation.attributes.allergen_name')}}</th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($allergens as $allergen)
    <tr>
      <td>
        {{ $allergen->allergen_key }}
      </td>
      <td>
        {{ $allergen->lang_jp }}
      </td>
      <td>
        {{ $allergen->allergen_name }}
      </td>
      <td>
        <a href="/allergens/{{$allergen->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      </td>
      <td>
        <form action="/allergens/{{$allergen->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $allergens->appends(request()->input())->links() }}
@endsection

@section('script')
<script type="module">
$(function(){
    $(".btn-del").click(function() {
        if(confirm("本当に削除してもよろしいですか？")) {
        } else {
            //cancel
            event.preventDefault();
            return false;
        }
    });
});
</script>
@endsection