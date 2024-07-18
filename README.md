# Ürün Yönetim Sistemi

Bu, CodeIgniter 3 kullanılarak oluşturulmuş basit bir ürün yönetim sistemidir. Sistem, kullanıcıların ürünleri oluşturmasına, okumasına, güncellemesine ve silmesine olanak tanır. Her ürünün detaylı bilgileri, resimleri ve indirimleri olabilir.

## Özellikler

- Ürün CRUD (Oluşturma, Okuma, Güncelleme, Silme)
- Ürün detayları yönetimi
- Ürün resimleri yönetimi
- Ürün indirimleri yönetimi
- Ürün resimleri için görüntü kaydırıcı
- Örnek veri başlatma (Seeder)

## Gereksinimler

- PHP 7.4
- MySQL
- CodeIgniter 3

## Kurulum

### Depoyu Klonlayın

git clone https://github.com/your-username/product-management-system.git

### Bağımlılıkları Yükleyin
composer install

### Veritabanını Yapılandırın
Bir veritabanı oluşturun ve sağlanan database.sql dosyasını içe aktarın.
application/config/database.php dosyasını açın ve veritabanı ayarlarını yapılandırın:

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'your_database',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);


### Örnek Test Verilerini Başlatın
Veritabanını örnek verilerle doldurmak için seeder'ı çalıştırın. Tarayıcınızı açın ve aşağıdaki URL'ye gidin:
http://localhost/your_project_directory/index.php/seeder


### Kullanım

Proje kurulumunu tamamladıktan sonra, aşağıdaki URL'ye giderek ürün yönetim sistemine erişebilirsiniz:
http://localhost/your_project_directory/index.php/product

Ürünlerin listesini görmek için:
http://localhost/your_project_directory/index.php/product

Yeni bir ürün eklemek için:
http://localhost/your_project_directory/index.php/product/create

Mevcut bir ürünü düzenlemek için:
http://localhost/your_project_directory/index.php/product/edit/{id}

Mevcut bir ürünü silmek için:
http://localhost/your_project_directory/index.php/product/delete/{id}

### Örnek Veriler

Seeder çalıştırıldığında veritabanınıza eklenen örnek ürünler:

Ürün Kodu: P001

Başlık: Sample Product 1
Detaylar: Extra Info 1, Extra description for product 1.
Fiyat: 100 TL, 20 USD, 18 EUR
İndirimler: 5% TL, 1% USD, 0.9% EUR
Görseller: sample1.jpg, sample2.jpg
Ürün Kodu: P002

Başlık: Sample Product 2
Detaylar: Extra Info 2, Extra description for product 2.
Fiyat: 200 TL, 40 USD, 36 EUR
İndirimler: 10% TL, 2% USD, 1.8% EUR
Görseller: sample3.jpg, sample4.jpg
Ürün Kodu: P003

Başlık: Sample Product 3
Detaylar: Extra Info 3, Extra description for product 3.
Fiyat: 300 TL, 60 USD, 54 EUR
İndirimler: 15% TL, 3% USD, 2.7% EUR
Görseller: sample5.jpg, sample6.jpg
