<label for="inputEmail3" class="col-sm-3 control-label">@lang('site.lesson')</label>
<div class="col-sm-8">
    <select class="form-control levels @error('lesson') {{  'is-invalid'  }} @enderror" id="inputName1" name="lesson">
        <option value="" disabled selected>-- @lang('site.Choose the lesson') --</option>
        @foreach ($lessons as $lesson)
        <option value="{{ $lesson->id }}" > {{ app()->getLocale() == 'ar' ? $lesson->title_ar : $lesson->title_en }} </option>
        @endforeach
    </select>
    @error('lesson')
        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
    @enderror
</div>
