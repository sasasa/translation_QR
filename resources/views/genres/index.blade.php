@extends('layouts.app')
@section('title', 'ジャンル管理')

@section('content')
<h1>ジャンル管理</h1>
<a href="/genres/create" class="btn btn-primary mb-3">ジャンル新規登録</a>
<table class="table">
  <tr>
    <th>{{__('validation.attributes.genre_key')}}</th>
    <th>{{__('validation.attributes.lang')}}</th>
    <th>{{__('validation.attributes.genre_name')}}</th>
    <th>{{__('validation.attributes.genre_order')}}</th>
    <th>{{__('validation.attributes.parent_id')}}</th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($genres as $genre)
    <tr class="colored" data-hash="{{$genre->hash}}">
      <td>
        {{ $genre->genre_key }}
      </td>
      <td>
        {{ $genre->lang_jp }}
      </td>
      <td>
        {{ $genre->genre_name }}
      </td>
      <td>
        {{ $genre->genre_order }}
      </td>
      <td>
        {{ $genre->parent ? $genre->parent->genre_name.'【'.$genre->parent->lang_jp.'】' : '無し'}}
      </td>
      <td>
        <a href="/genres/{{$genre->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      </td>
      <td>
        <form action="/genres/{{$genre->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $genres->appends(request()->input())->links() }}
@endsection

@section('script')
<script type="module">
function hashBytes(i32) {
    return [
        (i32 & 0xFF000000) >>> 24,
        (i32 & 0x00FF0000) >>> 16,
        (i32 & 0x0000FF00) >>> 8,
        (i32 & 0x000000FF) >>> 0,
    ];
}
function toHex(b) {
    let str = b.toString(16);
    if (2 <= str.length) {
        return str;
    }

    return "0" + str;
}
function toColorCode(bytes) {
    return "#" + toHex(bytes[0]) + toHex(bytes[1]) + toHex(bytes[2]);
}
function brightness(r, g, b) {
    return Math.floor(((r * 299) + (g * 587) + (b * 114)) / 1000);
}


$(function(){
  $(".colored").each((idx, element)=>{
      let crc32 = $(element).data('hash')
        // 文字列をハッシュ化
      let bg = hashBytes(Number(crc32));

      // 反転色
      let fc = [
          ~bg[0] & 0xff,
          ~bg[1] & 0xff,
          ~bg[2] & 0xff,
      ];

      // 背景とフォントの明るさ計算
      let bgL = brightness(bg[0], bg[1], bg[2]);
      let fcL = brightness(fc[0], fc[1], fc[2]);

      // 背景とフォントの明度差が125未満なら、フォント色は白または黒にする。
      // (明度差が大きい方を採用)
      if (Math.abs(bgL - fcL) < 125) {
          fc[0] = fc[1] = fc[2] = ((0xff - bgL) > bgL) ? 0xff : 0x00;
      }

      // スタイル用の色コード文字列に成形。
      let bgCode = toColorCode(bg);
      let fcCode = toColorCode(fc);

      $(element).css('background-color', bgCode).css('color', fcCode)
  })
  





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