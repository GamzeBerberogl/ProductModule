<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-body {
            padding: 20px;
        }
        .btn {
            margin-right: 10px;
        }
        .price-box {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right;
            float: right;
            width: fit-content;
            display: inline-block;
        }
        .price-tl {
            font-size: 1.2em;
            margin: 0;
        }
        .price-other {
            font-size: 0.8em;
            margin: 0;
        }
        .slider-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }
        .slide {
            min-width: 100%;
            box-sizing: border-box;
            height: 100%;
        }
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .slider-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .slider-button.prev {
            left: 10px;
        }
        .slider-button.next {
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Ürün Listesi</h2>
            <a href="<?php echo base_url('product/create'); ?>" class="btn btn-primary">Yeni Ürün Ekle</a>
        </div>
        <?php if(!empty($products)): ?>
        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <?php if(isset($product->images)) : ?>
                        <?php $images = explode(',', $product->images); ?>
                        <div class="slider-container">
                            <div class="slider">
                                <?php foreach($images as $image): ?>
                                    <div class="slide">
                                        <img src="<?php echo base_url('uploads/'.$image); ?>" class="card-img-top" alt="Ürün Resmi">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-button prev" onclick="prevSlide(this)">&#10094;</button>
                            <button class="slider-button next" onclick="nextSlide(this)">&#10095;</button>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->product_title; ?></h5>
                        <p class="card-text"> <?php echo $product->product_code; ?></p>
                        <p class="card-text"> <?php echo $product->product_description; ?></p>
                        <p class="card-text"><strong> Stokta <?php echo $product->quantity; ?> adet mevcuttur. </strong> </p>
                        <div class="price-box">
                            <p class="price-tl"><strong><?php echo $product->price_tl; ?> TL</strong></p>
                            <p class="price-other"><small><?php echo $product->price_usd; ?> USD</small></p>
                            <p class="price-other"><small><?php echo $product->price_eur; ?> EUR</small></p>
                        </div>
                        <p class="card-text">
                            <strong>İndirimler:</strong>
                            <?php
                            if(isset($product->discounts)) {
                                $discounts = explode(',', $product->discounts);
                                $unique_discounts = [];
                                foreach($discounts as $discount) {
                                    list($customer_group, $priority, $discount_rate_tl, $discount_rate_usd, $discount_rate_eur, $start_date, $end_date) = explode(':', $discount);
                                    $unique_discount = [
                                        'TL' => $discount_rate_tl,
                                        'USD' => $discount_rate_usd,
                                        'EUR' => $discount_rate_eur
                                    ];
                                    $unique_discounts[] = $unique_discount;
                                }

                                // Unique discounts array to avoid repetitions
                                $unique_discounts = array_unique($unique_discounts, SORT_REGULAR);

                                foreach($unique_discounts as $discount) {
                                    if ($discount['TL']) {
                                        echo '<br>İndirim (TL): ' . $discount['TL'];
                                    }
                                    if ($discount['USD']) {
                                        echo '<br>İndirim (USD): ' . $discount['USD'];
                                    }
                                    if ($discount['EUR']) {
                                        echo '<br>İndirim (EUR): ' . $discount['EUR'];
                                    }
                                }
                            } else {
                                echo 'Yok';
                            }
                            ?>
                        </p>
                        <a href="<?php echo base_url('product/edit/'.$product->id); ?>" class="btn btn-primary">Düzenle</a>
                        <a href="<?php echo base_url('product/delete/'.$product->id); ?>" class="btn btn-danger" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">Sil</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="text-center">Henüz ürün eklenmemiş.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function nextSlide(button) {
            const slider = button.closest('.slider-container').querySelector('.slider');
            const slides = slider.querySelectorAll('.slide');
            let currentIndex = parseInt(slider.getAttribute('data-index')) || 0;
            currentIndex = (currentIndex + 1) % slides.length;
            slider.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
            slider.setAttribute('data-index', currentIndex);
        }

        function prevSlide(button) {
            const slider = button.closest('.slider-container').querySelector('.slider');
            const slides = slider.querySelectorAll('.slide');
            let currentIndex = parseInt(slider.getAttribute('data-index')) || 0;
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            slider.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
            slider.setAttribute('data-index', currentIndex);
        }
    </script>
</body>
</html>
