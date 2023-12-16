<div class="form-group">
    <label for="fabric">Fabric</label>
    <select class="form-select" name="fabric">
        <option value="Red">Select Fabric</option>
        @foreach ($productsFilters['fabricArray'] as $fabric)
            <option value="{{$fabric}}">{{$fabric}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="sleeve">Sleeve</label>
    <select class="form-select" name="sleeve">
        <option value="Red">Select sleeve</option>
        @foreach ($productsFilters['sleeveArray'] as $sleeve)
            <option value="{{$sleeve}}">{{$sleeve}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="pattern">Pattern</label>
    <select class="form-select" name="pattern">
        <option value="Red">Select pattern</option>
        @foreach ($productsFilters['patternArray'] as $pattern)
            <option value="{{$pattern}}">{{$pattern}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="fit">Fit</label>
    <select class="form-select" name="fit">
        <option value="Red">Select fit</option>
        @foreach ($productsFilters['fitArray'] as $fit)
            <option value="{{$fit}}">{{$fit}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="occasion">Accasion</label>
    <select class="form-select" name="occasion">
        <option value="Red">Select occasion</option>
        @foreach ($productsFilters['occasionArray'] as $occasion)
            <option value="{{$occasion}}">{{$occasion}}</option>
        @endforeach

    </select>
</div>
