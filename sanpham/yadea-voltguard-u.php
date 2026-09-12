<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YADEA Voltguard U</title>
  <link rel="icon" href="../image/logo-yadea.svg" type="../image/svg+xml">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #fff;
      height: 100vh;
    }

    .container {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      color: #ff6200;
      text-decoration: none;
      font-size: 16px;
      z-index: 10;
    }

    .product-image {
      width: 55%;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 30px;
      position: relative;
    }

    .bike-image {
      width: 800px;
      height: auto;
      border-radius: 10px;
      object-fit: contain;
    }

    .specs {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
      width: 100%;
      max-width: 500px;
      color: #666;
      font-size: 23px;
    }

    .spec-item {
      text-align: center;
      flex: 1;
    }

    .spec-item span {
      display: block;
      color: #ff6200;
      font-weight: bold;
      margin-top: 5px;
    }

    .nav-buttons {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
    }

    .nav-buttons button {
      background-color: rgba(255, 255, 255, 0.7);
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 18px;
      border-radius: 5px;
      color: #ff6200;
    }

    .product-details {
      width: 45%;
      padding: 40px;
      display: flex;
      flex-direction: column;
    }

    .product-details h1 {
      font-size: 2.8rem;
      color: #000;
    }

    .color-options {
      margin-bottom: 20px;
    }

    .color-options label {
      font-size: 1rem;
      color: #333;
      margin-right: 10px;
    }

    .color-picker {
      display: inline-flex;
      gap: 10px;
      margin-top: 10px;
    }

    .color-box {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      border: 2px solid #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .color-box:hover {
      border-color: #ff6200;
    }

    .price-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .price-section b {
      font-size: 1rem;
      color: #666;
    }

    .price-sp {
      margin-left: auto;
      display: flex;
      align-items: flex-end;
      justify-content: flex-end;
    }

    .price-sp h4 {
      font-size: 1.5rem;
      color: #ff6200;
      margin: 0;
    }

    .buy-now {
      background-color: #ff6200;
      color: #fff;
      border: none;
      padding: 15px 30px;
      font-size: 1.2rem;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s ease;
    }

    .buy-now:hover {
      background-color: #e65c00;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .product-image, .product-details {
        width: 100%;
      }

      .product-details {
        padding: 20px;
      }

      .specs {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>
  <a href="/YADEA" class="back-button">&lt; Trở lại</a>
  <div class="container">
    <div class="product-image">
      <div class="nav-buttons">
        <button onclick="prevColor()">&#10094;</button>
        <button onclick="nextColor()">&#10095;</button>
      </div>
      <img id="bikeImage" src="../image/Anh-sp-ngang-v002-U-1280x880-1.png" alt="YADEA Voltguard U" class="bike-image" />
      <div class="specs">
        <div class="spec-item">Tốc độ<br><span>76 Km/h</span></div>
        <div class="spec-item">Quãng đường<br><span>112 Km</span></div>
        <div class="spec-item">Bảo hành<br><span>30.000 Km</span></div>
      </div>
    </div>
    <div class="product-details">
      <h1>YADEA Voltguard U</h1>
      <div class="color-options">
        <label>Chọn màu sắc:</label>
        <div class="color-picker">
          <input type="radio" id="white" name="color" value="white" checked onchange="changeColor(0)">
          <label for="white" class="color-box" style="background-color: #f0f0f0;"></label>
          <input type="radio" id="black" name="color" value="black" onchange="changeColor(1)">
          <label for="black" class="color-box" style="background-color: #333;"></label>
          <input type="radio" id="gray" name="color" value="gray" onchange="changeColor(2)">
          <label for="gray" class="color-box" style="background-color: #ffffff;"></label>
          <input type="radio" id="red" name="color" value="red" onchange="changeColor(3)">
          <label for="red" class="color-box" style="background-color: #c22222;"></label>
        </div>
        <center><hr width="100%" size="1px"/></center>  
      </div>
      <div class="price-section">
        <b>Số tiền thanh toán :</b>
        <div class="price-sp">
          <h4>45.990.000 VND</h4>
        </div>
      </div>
      <p style="font-size: 0.7em; color: #999; margin-top: -10px; margin-bottom: 20px;">
  *Giá bán xe đã bao gồm thuế VAT, chưa bao gồm thuế trước bạ và biển số
</p>
  <form id="checkoutForm" method="POST" action="../thanhtoan/">
  <input type="hidden" name="product_image" id="product_image">
  <input type="hidden" name="product_price" id="product_price">
  <input type="hidden" name="product_name" id="product_name">
  <button type="submit" class="buy-now" onclick="prepareCheckout()">MUA NGAY</button>
</form>
    </div>
  </div>

  <script>
    const images = [
      '../image/Anh-sp-ngang-v002-U-1280x880-1.png', // white
      '../image/Anh-sp-ngang-1280x880-den.png',                             // black
      '../image/Anh-sp-ngang-1280x880-trang.png',
      '../image/Anh-sp-ngang-1280x880-do.png'
    ];

    let currentIndex = 0;

    function updateImage() {
      document.getElementById('bikeImage').src = images[currentIndex];
      document.getElementById(['white', 'black', 'gray', 'red'][currentIndex]).checked = true;
    }

    function nextColor() {
      currentIndex = (currentIndex + 1) % images.length;
      updateImage();
    }

    function prevColor() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateImage();
    }

    function changeColor(index) {
      currentIndex = index;
      updateImage();
    }
  </script>
  <script>
  const hoverXedap = document.getElementById("hoverXedap");

  hoverXedap.addEventListener("mouseenter", () => {
    spBox.style.display = "flex";

    // Chỉ hiện danh mục xe đạp điện
    document.querySelectorAll('.product-category').forEach(category => {
      category.style.display = 'none';
    });
    const xedap = document.querySelector('.product-category[data-category="xedap"]');
    if (xedap) {
      xedap.style.display = 'flex';
      xedap.style.flexWrap = 'wrap';
      xedap.style.gap = '20px';
    }

    // Cập nhật sidebar active nếu có
    document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
    const activeLi = document.querySelector('.sidebar ul li[data-category="xedap"]');
    if (activeLi) activeLi.classList.add('active');
  });
</script>
<script>
  document.getElementById('checkoutForm').addEventListener('submit', function(event) {
    document.getElementById('product_image').value = images[currentIndex];
    document.getElementById('product_price').value = 45990000;
    document.getElementById('product_name').value = 'YADEA Voltguard U';
  });
</script>
</body>
</html>
