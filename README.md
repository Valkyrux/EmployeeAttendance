## App solo lettura tabella presenze

# configurazione 
- una volta scaricata la repo:
    - configurare il file .env con un DB vuoto
    - eseguire "php artisan key:generate"
    - eseguire "composer install"
    - eseguire "npm install" 
    - eseguire "npm run dev" (compilazione del js che esegue la chiamata asicrona al server)
    - eseguire "php artisan migrate" per popolare il DB con le tabelle
    - eseguire "php artisan db:seed" per riempire le righe
    - eseguire "php artisan serve"

# il progetto
- creazione di seeder, migration e model per comunicare in modo più efficiente con il DB rispettivamente nei percorsi:
    - app/database/seeds/*
    - app/database/migrations/*
    - app/Attendance.php
    - app/Employee.php
    
- è stata realizzato un controller API (app/Http/Controllers/Api/AttendanceController.php)
che fornisce al client i dati utili per popolare le tabelle

- la libreria jQuery e la libreria datatable sono state utilizzate come cdn, sarà dunque necessaria una connessione internet.

- il template dell'interfaccia utente è stato realizzato utilizzando "blade" e si trova in "app/resources/views/welcome.blade.php" mentre il file js che esegue le chiamate all'API si trova in "app/resources/js/app.js"