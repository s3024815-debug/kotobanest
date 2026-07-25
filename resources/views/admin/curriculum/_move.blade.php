@foreach(['up' => '↑', 'down' => '↓'] as $direction => $symbol)
<form method="POST" action="{{ route('admin.curriculum.move') }}">@csrf
<input type="hidden" name="type" value="{{ $type }}"><input type="hidden" name="id" value="{{ $id }}"><input type="hidden" name="direction" value="{{ $direction }}">
<button class="kb-btn kb-soft" title="Move {{ $direction }}">{{ $symbol }}</button></form>
@endforeach
