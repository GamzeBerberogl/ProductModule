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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Ürün Listesi</h2>
            <a href="<?php echo site_url('product/create'); ?>" class="btn btn-primary">Yeni Ürün Ekle</a>
        </div>
        <?php if(!empty($products)): ?>
        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <?php 
                        if(isset($product->images)) {
                            $images = explode(',', $product->images);
                            echo '<img src="'.base_url('uploads/'.$images[0]).'" class="card-img-top" alt="Ürün Resmi">';
                        }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->product_title; ?></h5>
                        <p class="card-text"><strong>Ürün Kodu:</strong> <?php echo $product->product_code; ?></p>
                        <p class="card-text"><strong>Durum:</strong> <?php echo $product->status ? 'Aktif' : 'Pasif'; ?></p>
                        <p class="card-text"><strong>Miktar:</strong> <?php echo $product->quantity; ?></p>
                        <p class="card-text"><strong>Fiyat (TL):</strong> <?php echo $product->price_tl; ?></p>
                        <p class="card-text"><strong>Fiyat (USD):</strong> <?php echo $product->price_usd; ?></p>
                        <p class="card-text"><strong>Fiyat (EUR):</strong> <?php echo $product->price_eur; ?></p>
                        <p class="card-text">
                            <strong>İndirimler:</strong>
                            <?php
                            if(isset($product->discounts)) {
                                $discounts = explode(',', $product->discounts);
                                foreach($discounts as $discount) {
                                    list($customer_group, $priority, $discount_rate_tl, $discount_rate_usd, $discount_rate_eur, $start_date, $end_date) = explode(':', $discount);
                                    echo '<br>Grup: ' . $customer_group;
                                    echo '<br>Öncelik: ' . $priority;
                                    echo '<br>İndirim (TL): ' . $discount_rate_tl;
                                    echo '<br>İndirim (USD): ' . $discount_rate_usd;
                                    echo '<br>İndirim (EUR): ' . $discount_rate_eur;
                                    echo '<br>Başlangıç: ' . $start_date;
                                    echo '<br>Bitiş: ' . $end_date . '<br>';
                                }
                            } else {
                                echo 'Yok';
                            }
                            ?>
                        </p>
                        <a href="<?php echo site_url('product/edit/'.$product->id); ?>" class="btn btn-primary">Düzenle</a>
                        <a href="<?php echo site_url('product/delete/'.$product->id); ?>" class="btn btn-danger" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">Sil</a>
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
</body>
</html>
