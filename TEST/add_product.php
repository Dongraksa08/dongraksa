<form action="save_product.php" method="post" enctype="multipart/form-data">
    ชื่อสินค้า: <input type="text" name="pname" required><br>
    ราคา: <input type="number" name="pprice" required><br>
    รูปภาพสินค้า: <input type="file" name="pimage" accept="image/*" required><br>
    <button type="submit" name="Submit">บันทึกสินค้า</button>
</form>