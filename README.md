# E-commerce raport

**Opis:**  
Projekt ma na celu stworzenie narzędzia do agregowania i prezentowania danych z platform sprzedażowych oraz reklamowych (Google Ads, Google Analytics, Meta Ads). Dane zbierane są za pomocą API, przetwarzane i prezentowane w formie gotowego wizualnego raportu, który dostępny jest w panelu oraz w formacie JSON przy skorzystaniu z API.
---

## Spis Treści

1. [Instalacja](#instalacja)
2. [Konfiguracja](#konfiguracja)
3. [Licencja](#licencja)

---

## Instalacja

Aby zainstalować projekt, wykonaj poniższe kroki:

1. Skopiuj repozytorium:
    ```bash
    git clone https://github.com/PatrykDachwitz/E-commerce-raport.git
    ```
2. Przejdź do katalogu projektu:
    ```bash
    cd E-commerce-raport
    ```
3. Zainstaluj wymagane zależności:
    ```bash
    composer install
    npm install
    ```
3. Skopiuj plik ".env"
    ```bash
    copy .env.example .env
    ```
4. Skonfiguruj dane dotyczące bazy danych w pliku ".env"
5. Wygeneruj nowy zestaw kluczy aplikacji
    ```bash
    php artisan key:generate
    ```
6. W celu wygenerowania danych Demo wykorzystaj seed "DemoSeed"
    ```bash
    php artisan db:seed DemoSeed
    ```
---

## Użycie

Aby zacząć agregowanie danych, wykonaj następujące kroki:

1. W celu skonfigurowania GA4 w folderze `storage\credentials`, wklej plik cerdentials dla api GA4 z `console.cloud.google.com` pod nazwą "credentials-google", następnie skonfiguruj token za pomocą komendy.
    ```bash
    php artisan google-auth:analytics
    ```
2. W celu skonfigurowania Google ADS w folderze `storage\credentials`, wklej plik cerdentials dla api Google ads z `console.cloud.google.com` pod nazwą "credentials-google-adwords", następnie skonfiguruj token za pomocą komendy.
    ```bash
    php artisan google-auth:adwords
    ```
3. W dalszym kroku konfiguracji Google ads należ yw pliku `.env` uzupełnić wartości: DEVELOPER_TOKEN_GOOGLE, GOOGLE_LOGIN_CUSTOMER_ID

4. W celu skonfigurowania Meta ADS należy uzupełnić token w pliku `.env`: DEVELOPER_TOKEN_FACEBOOK
5. W celu skonfigurowania wyników z platformy sprzedażowej należy uzupełnić pola w pliku `.env`: URL_API_SHOP, SHOP_API_TOKEN
6. Następnie należy dodać zadanie cron wykonywane co minute według instrukcji -> https://laravel.com/docs/10.x/scheduling#running-the-scheduler

**Dostępne endpointy API:**
W przypadku każdego z endpointów dostępne jest pole "date" w którym możemy podać datę raportu który chcemy wyświetlić, w przypadku nie uzupełnia pola, domyślną datą jest dzień popszedni. Pole dostępne jest w formacie "YYYY-mm-dd"
- `/api//report/daily` - Pobierz raport dzienny.
- `/api//report/weekly` - Pobierz raport weekendowy.
- `/api//report/comparison` - Pobierz raport porównujący wartości sprzedaży.

---

## Licencja

Projekt jest dostępny na licencji MIT.
