<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Formu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: auto;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slide img {
            width: 100%;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><?php echo isset($product) ? 'Ürün Düzenle' : 'Yeni Ürün Ekle'; ?></h2>
            <div>
                <button type="submit" form="productForm" class="btn btn-primary"><?php echo isset($product) ? 'Güncelle' : 'Kaydet'; ?></button>
                <a href="<?php echo base_url('product'); ?>" class="btn btn-secondary">İptal</a>
            </div>
        </div>
        <form id="productForm" action="<?php echo isset($product) ? base_url('product/update/'.$product->id) : base_url('product/save'); ?>" method="post" enctype="multipart/form-data">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="genel-tab" data-toggle="tab" href="#genel" role="tab" aria-controls="genel" aria-selected="true">Genel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detaylar-tab" data-toggle="tab" href="#detaylar" role="tab" aria-controls="detaylar" aria-selected="false">Detaylar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="indirim-tab" data-toggle="tab" href="#indirim" role="tab" aria-controls="indirim" aria-selected="false">İndirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="resimler-tab" data-toggle="tab" href="#resimler" role="tab" aria-controls="resimler" aria-selected="false">Resimler</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="genel" role="tabpanel" aria-labelledby="genel-tab">
                    <div class="form-group mt-3">
                        <label for="product_code">Ürün Kodu</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo isset($product->product_code) ? $product->product_code : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Durum</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" <?php echo isset($product->status) && $product->status == 1 ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?php echo isset($product->status) && $product->status == 0 ? 'selected' : ''; ?>>Pasif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Miktar (Adet)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo isset($product->quantity) ? $product->quantity : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="extra_discount">Sepet Ekstra İndirim %</label>
                        <input type="number" class="form-control" id="extra_discount" name="extra_discount" value="<?php echo isset($product->extra_discount) ? $product->extra_discount : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tax_rate">Vergi Oranı %</label>
                        <input type="number" class="form-control" id="tax_rate" name="tax_rate" value="<?php echo isset($product->tax_rate) ? $product->tax_rate : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="price_tl">Satış Fiyatı (TL)</label>
                        <input type="text" class="form-control" id="price_tl" name="price_tl" value="<?php echo isset($product->price_tl) ? $product->price_tl : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="price_usd">Satış Fiyatı (USD)</label>
                        <input type="text" class="form-control" id="price_usd" name="price_usd" value="<?php echo isset($product->price_usd) ? $product->price_usd : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="price_eur">Satış Fiyatı (EUR)</label>
                        <input type="text" class="form-control" id="price_eur" name="price_eur" value="<?php echo isset($product->price_eur) ? $product->price_eur : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="second_price_tl">2. Satış Fiyatı (TL)</label>
                        <input type="text" class="form-control" id="second_price_tl" name="second_price_tl" value="<?php echo isset($product->second_price_tl) ? $product->second_price_tl : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="stock_deduct">Stoktan Düş</label>
                        <select class="form-control" id="stock_deduct" name="stock_deduct">
                            <option value="1" <?php echo isset($product->stock_deduct) && $product->stock_deduct == 1 ? 'selected' : ''; ?>>Evet</option>
                            <option value="0" <?php echo isset($product->stock_deduct) && $product->stock_deduct == 0 ? 'selected' : ''; ?>>Hayır</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="feature_section">Özellik Bölümü</label>
                        <select class="form-control" id="feature_section" name="feature_section">
                            <option value="1" <?php echo isset($product->feature_section) && $product->feature_section == 1 ? 'selected' : ''; ?>>Açık</option>
                            <option value="0" <?php echo isset($product->feature_section) && $product->feature_section == 0 ? 'selected' : ''; ?>>Kapalı</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_product_expiry">Yeni Ürün Geçerlilik Süresi</label>
                        <input type="date" class="form-control" id="new_product_expiry" name="new_product_expiry" value="<?php echo isset($product->new_product_expiry) ? $product->new_product_expiry : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sort">Sıralama</label>
                        <input type="number" class="form-control" id="sort" name="sort" value="<?php echo isset($product->sort) ? $product->sort : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="show_on_homepage">Anasayfada Göster</label>
                        <input type="number" class="form-control" id="show_on_homepage" name="show_on_homepage" value="<?php echo isset($product->show_on_homepage) ? $product->show_on_homepage : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="is_new_product">Yeni Ürün</label>
                        <select class="form-control" id="is_new_product" name="is_new_product">
                            <option value="1" <?php echo isset($product->is_new_product) && $product->is_new_product == 1 ? 'selected' : ''; ?>>Evet</option>
                            <option value="0" <?php echo isset($product->is_new_product) && $product->is_new_product == 0 ? 'selected' : ''; ?>>Hayır</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="installment_number">Taksit Sayısı</label>
                        <input type="number" class="form-control" id="installment_number" name="installment_number" value="<?php echo isset($product->installment_number) ? $product->installment_number : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="warranty_period">Garanti Süresi (Ay)</label>
                        <input type="number" class="form-control" id="warranty_period" name="warranty_period" value="<?php echo isset($product->warranty_period) ? $product->warranty_period : ''; ?>">
                    </div>
                </div>

                <div class="tab-pane fade" id="detaylar" role="tabpanel" aria-labelledby="detaylar-tab">
                    <div class="form-group mt-3">
                        <label for="product_title">Ürün Başlığı</label>
                        <input type="text" class="form-control" id="product_title" name="product_title" value="<?php echo isset($product_details->product_title) ? $product_details->product_title : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="extra_info_title">Ek Bilgi Başlığı</label>
                        <input type="text" class="form-control" id="extra_info_title" name="extra_info_title" value="<?php echo isset($product_details->extra_info_title) ? $product_details->extra_info_title : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="extra_info_description">Ek Bilgi Açıklaması</label>
                        <textarea class="form-control" id="extra_info_description" name="extra_info_description"><?php echo isset($product_details->extra_info_description) ? $product_details->extra_info_description : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo isset($product_details->meta_title) ? $product_details->meta_title : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords"><?php echo isset($product_details->meta_keywords) ? $product_details->meta_keywords : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description"><?php echo isset($product_details->meta_description) ? $product_details->meta_description : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="seo_address">SEO Adresi</label>
                        <input type="text" class="form-control" id="seo_address" name="seo_address" value="<?php echo isset($product_details->seo_address) ? $product_details->seo_address : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_description">Ürün Açıklaması</label>
                        <textarea class="form-control" id="product_description" name="product_description"><?php echo isset($product_details->product_description) ? $product_details->product_description : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="video_embed_code">Video Embed Kodu</label>
                        <textarea class="form-control" id="video_embed_code" name="video_embed_code"><?php echo isset($product_details->video_embed_code) ? $product_details->video_embed_code : ''; ?></textarea>
                    </div>
                </div>

                <div class="tab-pane fade" id="indirim" role="tabpanel" aria-labelledby="indirim-tab">
                    <div class="form-group mt-3">
                        <label for="customer_group">Müşteri Grubu</label>
                        <input type="text" class="form-control" id="customer_group" name="customer_group" value="<?php echo isset($product_discounts[0]->customer_group) ? $product_discounts[0]->customer_group : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="priority">Öncelik</label>
                        <input type="number" class="form-control" id="priority" name="priority" value="<?php echo isset($product_discounts[0]->priority) ? $product_discounts[0]->priority : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="discount_rate_tl">İndirim Oranı (TL)</label>
                        <input type="text" class="form-control" id="discount_rate_tl" name="discount_rate_tl" value="<?php echo isset($product_discounts[0]->discount_rate_tl) ? $product_discounts[0]->discount_rate_tl : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="discount_rate_usd">İndirim Oranı (USD)</label>
                        <input type="text" class="form-control" id="discount_rate_usd" name="discount_rate_usd" value="<?php echo isset($product_discounts[0]->discount_rate_usd) ? $product_discounts[0]->discount_rate_usd : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="discount_rate_eur">İndirim Oranı (EUR)</label>
                        <input type="text" class="form-control" id="discount_rate_eur" name="discount_rate_eur" value="<?php echo isset($product_discounts[0]->discount_rate_eur) ? $product_discounts[0]->discount_rate_eur : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Başlangıç Tarihi</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($product_discounts[0]->start_date) ? $product_discounts[0]->start_date : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Bitiş Tarihi</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($product_discounts[0]->end_date) ? $product_discounts[0]->end_date : ''; ?>">
                    </div>
                </div>

                <div class="tab-pane fade" id="resimler" role="tabpanel" aria-labelledby="resimler-tab">
                    <div class="form-group mt-3">
                        <label for="image_path">Resim Yolu</label>
                        <input type="file" class="form-control-file" id="image_path" name="image_path">
                    </div>
                    <?php if(isset($product_images) && !empty($product_images)): ?>
                        <div class="slider-container mt-3">
                            <div class="slider">
                                <?php foreach ($product_images as $image) : ?>
                                    <div class="slide">
                                        <img src="<?php echo base_url('uploads/' . $image->image_path); ?>" alt="Product Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            const slider = document.querySelector('.slider');
            if (index >= totalSlides) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalSlides - 1;
            } else {
                currentIndex = index;
            }
            slider.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        setInterval(nextSlide, 3000); // Otomatik geçiş için
    </script>
</body>
</html>
