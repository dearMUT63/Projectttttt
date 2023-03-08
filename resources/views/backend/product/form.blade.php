<label for="product_name">Product Name</label>
<input value="{{ $product->product_name }}"type="text" name="product_name" id="product_name" class="form-control" required>



<label for="product_image" >Product image</label>
<div class="preview">
    <img id="file-ip-1-preview">
  </div>
<input onchange="showImage(event);" type="file" name="product_image" id="product_image" class="form-control" required>
<label for="product_image" >Product Description</label>




<label for="product_description">Product Description</label>
<textarea name="product_description" id="product_description" rows="4" class="form-control" required>{{ $product->product_description }}</textarea>
<label for="product_price">Product Price</label>
<input value="{{ $product->product_price }} "type="number" name="product_price" min="1" id="product_price"class="form-control" required>

<script>
    function showImage(event) {
        if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
</script>

