<label for="inputEmail3" class="col-sm-3 control-label">@lang('site.lesson')</label>
<div class="col-sm-8">
    <select class="form-control levels @error('lesson_id') {{  'is-invalid'  }} @enderror" id="inputLessons" name="lesson_id">
        <option value="" disabled selected>-- @lang('site.Choose the lesson') --</option>
        @foreach ($lessons as $lesson)
        <option value="{{ $lesson->id }}" {{  $lesson_id->id ?? 0 ==  $lesson->id ? 'selected' : '' }} > {{ app()->getLocale() == 'ar' ? $lesson->title_ar : $lesson->title_en }} </option>
        @endforeach
    </select>
    @error('lesson_id')
        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
    @enderror
</div>
