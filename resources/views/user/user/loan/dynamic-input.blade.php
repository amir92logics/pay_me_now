@foreach ($inputs as $key => $field)
    <div class="col-sm-6 mb-1">
        <label>{{ $field['field_level'] ?? 'Optional' }}</label>
        <input type="{{ $field['type'] }}" class="form-control" placeholder="Enter {{ $field['field_level'] }}" name="{{ $field['field_name'] ?? $key }}" {{ $field['validation'] ?? '' }}>
    </div>
@endforeach
