@extends('layouts.student') @section('title','Edit Profile')
@section('content')
<div class="card" style="max-width:720px;margin:auto"><h1>Edit my profile</h1><form method="POST" action="{{ route('account.update') }}">@csrf @method('PATCH')
@foreach(['name'=>'Name','username'=>'Username','country'=>'Country','native_language'=>'Native language'] as $field=>$label)<p><label>{{ $label }}</label><input class="input" name="{{ $field }}" value="{{ old($field,$user->$field) }}"></p>@endforeach
<p><label>Current JLPT</label><select class="select" name="current_jlpt">@foreach(['N5','N4','N3','N2','N1'] as $l)<option @selected(old('current_jlpt',$user->current_jlpt)===$l)>{{ $l }}</option>@endforeach</select></p><p><label>Bio</label><textarea name="bio" rows="5">{{ old('bio',$user->bio) }}</textarea></p>@if($errors->any())<div style="color:#b91c1c">{{ $errors->first() }}</div>@endif<button class="btn">Save profile</button></form></div>
@endsection
