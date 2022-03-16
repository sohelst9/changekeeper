<div class="select_option mb-0 clearfix">
    <select class="abc">
        <option data-display="All Categories">Select A Category</option>
        @foreach ($categories as $category)
            <option value="1">{{ $category->category_name }}</option>
        @endforeach
    </select>
</div>
