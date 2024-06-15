@props(['name'])
@error($name)
    <p class="mt-2 text-sm text-red-600" id="title-error">{{$message}}</p>
@enderror