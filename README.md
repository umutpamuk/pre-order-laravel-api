
# Proje Detayları


    1. Login, Register, Products, Products_Available, Cart_ADD, Cart_LIST,
    Cart_REMOVE, Cart_UPDATE, Pre_Order_Store, Pre_Orders, Order_Approve 
    endPointleri hazırlanmıştır.

## Kurulum

Projeyi klonlayın

```bash
  git clone git@github.com:umutpamuk/pre-order-laravel-api.git
```

Proje dizinine gidin

```bash
  cd pre-order-laravel-api
```

Gerekli paketleri yükleyin

```bash
  composer install
```

.ENV Dosyasını oluşturma

```bash
  cp .env.example .env
```

```bash
.env içeriğini güncellenyiniz.

DB_DATABASE={DATABASE}
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}

TWILIO_SID=#
TWILIO_TOKEN=#
TWILIO_FROM=#
```

Tabloları oluşturun

```bash
  php artisan migrate
```
Veritabanına demo verilerin oluşturun

```bash
  php artisan db:seed
```


Test İşlemini başlat
```bash
  php artisan test
```

## API Dökümantasyonu



```http
  https://documenter.getpostman.com/view/21222352/2s93m8yLLE
```

  
