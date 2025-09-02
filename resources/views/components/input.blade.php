@props(['label'=>null,'name','type'=>'text','value'=>null,'required'=>false])
<div>
  @if($label)<label class="label" for="{{ $name }}">{{ $label }}</label>@endif
  <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
         @class(['input']) @if($required) required @endif>
  @error($name) <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
</div>
