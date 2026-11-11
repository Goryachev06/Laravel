@csrf

<div class="mb-3">
    <label for="name" class="form-label">Название</label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror" 
           id="name" 
           name="name" 
           value="{{ old('name', $capital->name ?? '') }}" 
           required 
           maxlength="255">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="short_info" class="form-label">Краткая информация</label>
    <textarea class="form-control @error('short_info') is-invalid @enderror" 
              id="short_info" 
              name="short_info" 
              rows="3" 
              required 
              maxlength="1000">{{ old('short_info', $capital->short_info ?? '') }}</textarea>
    @error('short_info')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="detailed_info" class="form-label">Подробная информация</label>
    <textarea class="form-control @error('detailed_info') is-invalid @enderror" 
              id="detailed_info" 
              name="detailed_info" 
              rows="6" 
              required>{{ old('detailed_info', $capital->detailed_info ?? '') }}</textarea>
    @error('detailed_info')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Фотография</label>
    <input type="file" 
           class="form-control @error('photo') is-invalid @enderror" 
           id="photo" 
           name="photo" 
           accept="image/jpeg,image/jpg,image/png" 
           {{ isset($capital) ? '' : 'required' }}>
    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($capital) && $capital->photo)
        <div class="mt-2">
            <small>Текущее фото:</small><br>
            <img src="{{ asset('storage/' . $capital->photo) }}" 
                 alt="{{ $capital->name }}" 
                 style="max-width: 200px;" 
                 class="mt-1 rounded">
        </div>
    @endif
</div>

<button type="submit" class="btn btn-primary">{{ $submitText ?? 'Сохранить' }}</button>
<a href="{{ route('capitals.index') }}" class="btn btn-secondary">Отмена</a>