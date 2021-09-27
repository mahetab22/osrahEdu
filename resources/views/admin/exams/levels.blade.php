<label for="inputEmail3" class="col-sm-3 control-label">@lang('site.level')</label>
<div class="col-sm-8">
    <select onchange="lessons()" id="level" class="form-control levels @error('level') {{  'is-invalid'  }} @enderror" id="inputName1" name="level">
        <option value="" disabled selected>-- @lang('site.Choose the level') --</option>
        @foreach ($levels as $level)
        <option value="{{ $level->id }}" > {{ app()->getLocale() == 'ar' ? $level->title_ar : $level->title_en }} </option>
        @endforeach
    </select>
    @error('level')
        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
    @enderror
</div>
