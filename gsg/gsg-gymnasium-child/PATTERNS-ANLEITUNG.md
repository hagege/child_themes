# GSG Patterns - So findest du sie!

## ✅ Patterns finden im Block Editor

### Schritt 1: Seite bearbeiten

```
1. Dashboard > Seiten > Neu hinzufügen
   ODER
   Bestehende Seite bearbeiten
```

### Schritt 2: Block Inserter öffnen

```
Klicke auf das (+) Symbol oben links
```

### Schritt 3: Patterns Tab wählen

```
Im Block Inserter:
- Oben gibt es Tabs: "Blocks", "Patterns", "Media"
- Klicke auf "Patterns"
```

### Schritt 4: Kategorie "GSG" finden

```
In der Patterns-Ansicht:
- Links siehst du Kategorien
- Scrolle nach unten
- Finde "GSG"
- Klicke darauf
```

### Schritt 5: Pattern auswählen

```
Jetzt siehst du alle 8 GSG Patterns:
1. GSG Hero Section
2. GSG News Grid
3. GSG Fachbereiche
4. GSG Termine Liste
5. GSG Anmeldung CTA
6. GSG Info Box
7. GSG Accent Box
8. GSG Statistiken

Klicke auf ein Pattern zum Einfügen
```

---

## 🔍 Patterns werden nicht angezeigt?

### Prüfe folgendes:

#### 1. Theme richtig aktiviert?

```
Design > Themes
"GSG Gymnasium" sollte aktiv sein
```

#### 2. Cache leeren

```
Browser: Strg + Shift + R (Hard Reload)
WordPress: Falls Caching-Plugin aktiv, Cache leeren
```

#### 3. Pattern-Datei prüfen

```
Per FTP/cPanel:
/wp-content/themes/gsg-gymnasium-child/patterns.php
Datei sollte existieren (58 KB)
```

#### 4. functions.php prüfen

```
Sollte diese Zeile enthalten:
require_once get_stylesheet_directory() . '/patterns.php';
```

#### 5. Debug aktivieren

```php
// In wp-config.php temporär einfügen:
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

// Dann prüfen: /wp-content/debug.log
```

---

## 📍 Wo NICHT zu suchen:

❌ **NICHT unter "Vorlagen"** (Templates)
   → Das ist für Template-Dateien (.html)

❌ **NICHT unter "Template-Parts"**
   → Das ist für Header/Footer

✅ **RICHTIG: Unter "Patterns"**
   → Im Block Inserter (+) > Patterns Tab

---

## 🎨 Alternative: Pattern per Suche finden

```
1. Im Editor: (+) Symbol klicken
2. Suchfeld oben: "GSG" eingeben
3. Alle GSG Patterns werden angezeigt
4. Pattern anklicken zum Einfügen
```

---

## 💡 Schnellzugriff

**Tastenkombination:**
```
Im Editor:
/gsg  → Enter
Zeigt alle GSG Patterns
```

---

## 🆘 Immer noch nicht sichtbar?

### Prüfe Berechtigungen:

```
Per FTP: patterns.php Berechtigung sollte 644 sein
```

### Theme neu aktivieren:

```
1. Design > Themes
2. Anderes Theme aktivieren (z.B. Twenty Twenty-Five)
3. GSG Gymnasium wieder aktivieren
4. Editor neu laden
```

### WordPress Patterns Debug:

```php
// Temporär in functions.php einfügen zum Testen:
add_action('init', function() {
    $patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
    error_log('Registered Patterns: ' . print_r($patterns, true));
});
```

---

## ✅ Erfolgreich?

Wenn du die Kategorie "GSG" siehst und die 8 Patterns verfügbar sind:
**Alles funktioniert korrekt!** 🎉

Dann kannst du:
- Patterns einfügen
- Texte anpassen
- Bilder austauschen
- Farben ändern
- Layout anpassen

---

**Viel Erfolg mit den GSG Patterns!** 📚
