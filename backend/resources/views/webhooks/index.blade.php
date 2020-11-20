@extends('layouts.app')
@section('title', 'paypay履歴確認')

@section('content')
<h1>paypay履歴確認</h1>

<table class="table">
  <tr>
    <th>{{__('validation.attributes.id')}}</th>
    <th>{{__('validation.attributes.content')}}</th>
    <th>{{__('validation.attributes.created_at')}}</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($webhooks as $webhook)
    <tr>
      <td>
        {{ $webhook->id }}
      </td>
      <td>
        <pre>
          <code>
            {{ $webhook->content }}
          </code>
        </pre>
      </td>
      <td>
        {{ $webhook->created_at }}
      </td>
    </tr>
  @endforeach
</table>
{{ $webhooks->appends(request()->input())->links() }}
@endsection

{{-- CORSの確認 --}}
{{-- @section('script')
<script type="module">
$.ajax({
  // url: "https://127.0.0.1/api/webhooks",
  url: "https://420a98e7eda1.ngrok.io/api/webhooks",
  // url: "https://localhost/api/webhooks",
  type: "post",
  contentType: "application/json",
  data: JSON.stringify({a: "a", b: "b", c: "c", d: "d","url": "https://syncer.jp/"}),
  dataType: "json",
})
</script>
@endsection --}}