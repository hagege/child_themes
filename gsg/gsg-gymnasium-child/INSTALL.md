# GSG Gymnasium Child Theme - Installationsanleitung

## 🚀 Schnellstart (5 Minuten)

### Schritt 1: Ollie Parent Theme installieren

```
1. WordPress Dashboard öffnen
2. Design > Themes > Installieren
3. Suchfeld: "Ollie" eingeben
4. "Installieren" klicken
5. "Aktivieren" klicken
```

**Wichtig:** Das Parent Theme MUSS installiert sein!

---

### Schritt 2: GSG Child Theme installieren

#### Option A: Über WordPress Dashboard (Empfohlen)

```
1. Design > Themes > Installieren
2. "Theme hochladen" klicken
3. "Datei auswählen"
4. gsg-gymnasium-child.zip auswählen
5. "Jetzt installieren"
6. Warten bis Installation abgeschlossen
7. "Aktivieren" klicken
```

#### Option B: Per FTP

```
1. ZIP-Datei auf Computer entpacken
2. Ordner "gsg-gymnasium-child" per FTP hochladen nach:
   /wp-content/themes/
3. WordPress Dashboard > Design > Themes
4. "GSG Gymnasium" Theme aktivieren
```

---

### Schritt 3: Basis-Konfiguration

#### 3.1 Logo hochladen

```
1. Customizer > Site Identity
2. "Logo auswählen"
3. Bild hochladen (empfohlen: 120x120px, PNG mit Transparenz)
4. "Veröffentlichen"
```

#### 3.2 Navigation erstellen

```
1. Design > Menüs
2. "Neues Menü erstellen"
3. Menü-Name: "Hauptmenü"
4. Links hinzufügen:
   - Startseite
   - Neuigkeiten
   - Fachbereiche
   - Termine
   - Anmeldung
   - Kontakt
5. Position: "Primary Menu" auswählen
6. "Menü speichern"
```

---

### Schritt 4: Startseite erstellen

```
1. Seiten > Neu hinzufügen
2. Titel: "Home"
3. Template auswählen (Sidebar rechts):
   - Template > "Home"
4. Alle Patterns sind automatisch eingefügt
5. Texte anpassen:
   - Überschriften bearbeiten
   - Statistiken ändern
   - Links aktualisieren
6. "Veröffentlichen"
```

#### Startseite festlegen

```
1. Einstellungen > Lesen
2. "Eine statische Seite" auswählen
3. Homepage: "Home" auswählen
4. "Änderungen speichern"
```

---

## 🎨 Patterns verwenden

### Patterns finden (WICHTIG!)

Patterns sind **NICHT** unter "Vorlagen" (Templates) zu finden!

**Richtiger Weg:**

```
1. Seite/Beitrag bearbeiten
2. (+) Symbol klicken (Block Inserter oben links)
3. "Patterns" Tab wählen (neben "Blocks" und "Media")
4. Links in der Sidebar: Kategorie "GSG" auswählen
5. Pattern anklicken zum Einfügen
```

**Alternative: Suche**

```
1. Im Editor: (+) Symbol
2. Suchfeld: "GSG" eingeben
3. Alle GSG Patterns werden angezeigt
```

### Verfügbare Patterns

1. **GSG Hero Section** - Für Startseite
2. **GSG News Grid** - 3 News-Cards
3. **GSG Fachbereiche** - 6 Fachbereich-Cards
4. **GSG Termine Liste** - Event-Cards
5. **GSG Anmeldung CTA** - Call-to-Action
6. **GSG Info Box** - Hinweis-Box
7. **GSG Accent Box** - Highlight-Box (gelb)
8. **GSG Statistiken** - 4 Zahlen-Boxen

### Pattern einfügen

```
1. Pattern aus Liste auswählen
2. Auf Pattern klicken
3. Pattern wird eingefügt
4. Texte/Bilder anpassen
```

---

## 🔧 Erweiterte Konfiguration

### Farben anpassen

```
1. Site Editor öffnen (Design > Editor)
2. Styles > Colors
3. GSG-Farben sind verfügbar:
   - GSG Navy (Hauptfarbe)
   - GSG Yellow (Akzent)
   - GSG Gray (Neutral)
   etc.
```

---

## 📱 Mobile-Ansicht prüfen

```
1. Frontend aufrufen
2. Browser-DevTools öffnen (F12)
3. Responsive-Modus aktivieren
4. Verschiedene Geräte testen:
   - iPhone
   - iPad
   - Android
```

---

## ✅ Checkliste nach Installation

- [ ] Ollie Parent Theme installiert
- [ ] GSG Child Theme installiert & aktiviert
- [ ] Logo hochgeladen
- [ ] Navigation erstellt & zugewiesen
- [ ] Startseite mit Home-Template erstellt
- [ ] Startseite festgelegt (Einstellungen > Lesen)
- [ ] Texte in Patterns angepasst
- [ ] Mobile-Ansicht geprüft
- [ ] Permalinks gespeichert (Einstellungen > Permalinks > Speichern)
- [ ] Cache geleert (falls Caching-Plugin aktiv)

---

## 🐛 Häufige Probleme

### Problem: Patterns erscheinen nicht

**Lösung:**
```
1. Prüfen: Ist Ollie Parent Theme installiert?
2. Cache leeren (Browser + WordPress)
3. Theme neu aktivieren:
   - Anderes Theme aktivieren
   - GSG Theme wieder aktivieren
4. Seite neu laden
```

### Problem: Farben werden nicht angezeigt

**Lösung:**
```
1. Site Editor > Styles > Reset to defaults
2. Browser-Cache leeren (Strg + Shift + R)
3. WordPress Cache leeren (falls Plugin aktiv)
```

### Problem: Navigation zeigt nicht

**Lösung:**
```
1. Design > Menüs
2. Menü erstellen/bearbeiten
3. "Primary Menu" Position auswählen
4. Speichern
```

### Problem: Schriftart Inter lädt nicht

**Lösung:**
```
Normalerweise automatisch.
Falls Problem:
1. Browser-Konsole öffnen (F12)
2. Network-Tab prüfen
3. Google Fonts Verbindung prüfen
```

### Problem: Template "Home" nicht sichtbar

**Lösung:**
```
1. Permalinks neu speichern:
   Einstellungen > Permalinks > Speichern
2. Theme neu aktivieren
3. Cache leeren
```

---

## 🆘 Support

Bei weiteren Problemen:

1. **README.md** im Theme-Ordner lesen
2. **WordPress Support Foren:** https://wordpress.org/support/
3. **Ollie Dokumentation:** https://olliewp.com/documentation/

---

## 📊 System-Anforderungen

| Anforderung | Minimum | Empfohlen |
|-------------|---------|-----------|
| WordPress | 6.4 | 6.5+ |
| PHP | 7.4 | 8.0+ |
| MySQL | 5.6 | 8.0+ |
| Speicher | 64 MB | 256 MB+ |

---

## 🎓 Nächste Schritte

Nach erfolgreicher Installation:

1. **Inhalte erstellen:**
   - Weitere Seiten anlegen
   - News/Blog-Beiträge schreiben
   - Termine hinzufügen

2. **SEO einrichten:**
   - Yoast SEO oder Rank Math Plugin
   - Sitemap aktivieren
   - Meta-Beschreibungen

3. **Formulare:**
   - WPForms oder Contact Form 7
   - Kontaktformular erstellen
   - Anmeldeformular einrichten

4. **Performance:**
   - Caching-Plugin (WP Super Cache)
   - Bildoptimierung (ShortPixel)
   - CDN erwägen

5. **Backup:**
   - Backup-Plugin installieren
   - Regelmäßige Backups einrichten

---

**Viel Erfolg mit Ihrer GSG Gymnasium Website!** 🎓

Bei Fragen: README.md und CHANGELOG.md im Theme-Ordner lesen.
