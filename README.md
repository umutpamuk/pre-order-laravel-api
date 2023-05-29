
# Proje Detayları


    1. Login, Register, Products, Products_Available, Cart_ADD, Cart_LIST,
    Cart_REMOVE, Cart_UPDATE, Pre_Order_Store, Pre_Orders, Order_Approve 
    endPointleri hazırlanmıştır.

## Kurulum

Projeyi klonlayın

```bash
  git clone git@github.com:umutpamuk/OkulComTr.git
```

Proje dizinine gidin

```bash
  cd OkulComTr
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

TWILIO_SID=AC8450b5db3a8484df19e37fe40b31257a
TWILIO_TOKEN=40a1e15fe4b9f63d1ee965b07c4a6c2a
TWILIO_FROM=+15005550006
```

Tabloları oluşturun

```bash
  php artisan migrate
```
Veritabanına demo verilerin oluşturun

```bash
  php artisan db:seed
```

## API Dökümantasyonu



```http
  https://documenter.getpostman.com/view/21222352/2s93m8yLLE
```

  
