<div class="form-group">
    <label for="fabric">Fabric</label>
    <select class="form-select" name="fabric">
        <option value="Red">Select Fabric</option>
        @foreach ($productsFilters['fabricArray'] as $fabric)
            <option @if (old('fabric', $product->fabric) == $fabric || $product->fabric == $fabric) selected @endif>{{ $fabric }}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="sleeve">Sleeve</label>
    <select class="form-select" name="sleeve">
        <option value="Red">Select sleeve</option>
        @foreach ($productsFilters['sleeveArray'] as $sleeve)
            <option @if (old('sleeve', $product->sleeve) == $sleeve || $product->sleeve == $sleeve) selected @endif>{{ $sleeve }}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="pattern">Pattern</label>
    <select class="form-select" name="pattern">
        <option value="Red">Select pattern</option>
        @foreach ($productsFilters['patternArray'] as $pattern)
            <option @if (old('pattern', $product->pattern) == $pattern || $product->pattern == $pattern) selected @endif>{{ $pattern }}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="fit">Fit</label>
    <select class="form-select" name="fit">
        <option value="Red">Select fit</option>
        @foreach ($productsFilters['fitArray'] as $fit)
            <option @if (old('fit', $product->fit) == $fit || $product->fit == $fit) selected @endif> {{ $fit }}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="occasion">Accasion</label>
    <select class="form-select" name="occasion">
        <option value="Red">Select occasion</option>
        @foreach ($productsFilters['occasionArray'] as $occasion)
            <option @if (old('occasion', $product->occasion) == $occasion || $product->occasion == $occasion) selected @endif>{{ $occasion }}</option>
        @endforeach

    </select>
</div>
