<label for="inputEmail3" class="col-sm-3 control-label">@lang('site.level')</label>
<div class="col-sm-8">
    <select onchange="lessons()" id="level" class="form-control levels @error('level_id') {{  'is-invalid'  }} @enderror" id="inputLevels" name="level_id">
        <option value="" disabled selected>-- @lang('site.Choose the level') --</option>
        @foreach ($levels as $level)
        <option value="{{ $level->id }}" {{  $level_id->id ?? 0 ==  $level->id ? 'selected' : '' }} > {{ app()->getLocale() == 'ar' ? $level->title_ar : $level->title_en }} </option>
        @endforeach
    </select>
    @error('level_id')
        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
    @enderror
</div>
