@extends('layouts.app')
@section('title', 'ユーザー管理')

@section('content')
<h1>ユーザー管理</h1>
<a href="/users/create" class="btn btn-primary mb-3">ユーザー新規登録</a>
<table class="table">
  @foreach ($users as $user)
  <tr>
    <th>{{__('validation.attributes.name')}}</th>
    <td>{{$user->name}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.email')}}</th>
    <td>{{$user->email}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.permission')}}</th>
    <td>{{$user->permission_jp}}</td>
  </tr>
  <tr>
    <th></th>
    <td>
      <a href="/users/{{$user->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      <a href="/users/{{$user->id}}/edit_pass" class="btn btn-sm btn-primary">パスワード変更</a>
      @if ($user->permission <= \App\User::BROWSING)
      <form action="/users/{{$user->id}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
      </form>
      @endif
    </td>
  </tr>
  <tr>
    <th></th>
    <td></td>
  </tr>
  @endforeach
</table>
{{ $users->appends(request()->input())->links() }}
@endsection