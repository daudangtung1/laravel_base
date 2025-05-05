<div class="form-group">
    <label for="{{ $id }}">{{ $title }}</label>
    <input
        type="{{ $type }}"
        class="form-control" id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}"
        value="{{ $value ?? '' }}">
</div>