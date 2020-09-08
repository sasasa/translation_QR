@extends('layouts.app')
@section('title', 'メニューアイテム編集')

@section('content')
<h1>メニューアイテム編集</h1>

@include('components.errorAll')

<form action="/items/{{$item->id}}" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  @method('PATCH')

  <div class="form-group">
    <label for="item_key">{{__('validation.attributes.item_key')}}:</label>
    <input readonly value="{{old('item_key', $item->item_key)}}" type="text" id="item_key" class="form-control @error('item_key') is-invalid @enderror" name="item_key">
    @error('item_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang">{{__('validation.attributes.lang')}}:</label>
    <input readonly value="{{old('lang', $item->lang_jp)}}" type="text" id="lang_jp" class="form-control" name="lang_jp">
    <input value="{{old('lang', $item->lang)}}" type="hidden" id="lang" name="lang">
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_name">{{__('validation.attributes.item_name')}}:</label>
    <input value="{{old('item_name', $item->item_name)}}" type="text" id="item_name" class="form-control @error('item_name') is-invalid @enderror" name="item_name">
    @error('item_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_price">{{__('validation.attributes.item_price')}}:</label>
    <input value="{{old('item_price', $item->item_price)}}" type="text" id="item_price" class="form-control @error('item_price') is-invalid @enderror" name="item_price">
    @error('item_price')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_order">{{__('validation.attributes.item_order')}}:</label>
    <input value="{{old('item_order', $item->item_order)}}" type="text" id="item_order" class="form-control @error('item_order') is-invalid @enderror" name="item_order">
    @error('item_order')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_desc">{{__('validation.attributes.item_desc')}}:</label>
    <textarea rows="10" id="item_desc" class="form-control @error('item_desc') is-invalid @enderror" name="item_desc">{{old('item_desc', $item->item_desc)}}</textarea>
    @error('item_desc')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <img src="/storage/{{$item->image_path}}">
    <label>
      <input type="checkbox" id="delete_image" name="delete_image" value="1" {{old('delete_image') ? 'checked' : ''}}>
      削除する
    </label>
  </div>

  <div class="form-group" id="uploader">
    <label for="upfile">{{__('validation.attributes.image_path')}}:</label>
    <input type="file" id="upfile" class="form-control-file @error('upfile') is-invalid @enderror" name="upfile">
    @error('upfile')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="genre_id">{{__('validation.attributes.genre_id')}}:</label>
    {{ Form::select('genre_id', \App\Genre::optionsForSelectByLang($item->lang), old('genre_id', $item->genre_id), empty($errors->first('genre_id')) ? ['class'=>"form-control", 'id'=>'genre_id'] : ['class'=>"form-control is-invalid", 'id'=>'genre_id']) }}
    @error('genre_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  @foreach ($allergensGroupByLang as $lang => $allergensGroup)
  <div class="form-check allergen {{$lang}}">
  <legend class="small">{{__('validation.attributes.allergen_name')}}:{{\App\Allergen::$selectKeys[$lang]. '('. $lang. ')'}}</legend>
  @foreach ($allergensGroup as $allergen)
    <label class="mr-5 mb-3 form-check-label" for="allergen_{{$allergen->id}}">
      <input name="allergens[]" class="form-check-input" type="checkbox" value="{{$allergen->id}}" id="allergen_{{$allergen->id}}" {{in_array($allergen->id, $allergenIds) ? "checked" : null}}>
      {{$allergen->allergen_name}}
      @if ($allergen->lang !== "ja_JP")
        ({{$allergen->name_jp}})
      @endif
      <img src="/img/allergens/{{$allergen->allergen_key}}.png">
    </label>
  @endforeach
  </div>
  @endforeach

  <button type="submit" class="btn btn-primary">編集</button>
</form>
@endsection


@section('script')
<script type="module">
function uploaderShowHide()
{
    if( $("#delete_image").prop('checked') ) {
        $("#uploader").show()
    } else {
        $("#uploader").hide()
    }
}
$(function(){
    uploaderShowHide()

    $("#delete_image").click(function() {
      uploaderShowHide()
    });

    $("#lang").change(function() {
      $('.allergen').hide()
      $('.allergen input').prop('checked', false)
      $('.' + $("#lang").val()).show()
    })
    $('.allergen').hide()
    if ($("#lang").val() != '') {
      $('.' + $("#lang").val()).show()
    }

});
</script>
@endsection