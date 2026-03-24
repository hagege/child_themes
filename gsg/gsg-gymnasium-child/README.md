# GSG Gymnasium WordPress Child Theme

Vollständiges, produktionsreifes Child Theme für das Ollie Block Theme basierend auf der GSG Gymnasium Website.

## 📦 Installation

### Schritt 1: Parent Theme

```
1. WordPress Dashboard > Design > Themes > Installieren
2. Suche "Ollie"
3. Installieren & Aktivieren
```

### Schritt 2: Child Theme

```
1. ZIP-Datei hochladen oder per FTP nach /wp-content/themes/
2. Dashboard > Design > Themes
3. "GSG Gymnasium" aktivieren
```

### Schritt 3: Navigation einrichten

```
1. Design > Menüs > Neues Menü erstellen
2. Menü-Name: "Hauptmenü"
3. Links hinzufügen: Home, Neuigkeiten, Fachbereiche, Termine, Kontakt
4. Menü speichern
```

### Schritt 4: Logo hochladen

```
1. Customizer > Site Identity
2. Logo hochladen (empfohlen: 120x120px, transparent)
3. Veröffentlichen
```

## 🎨 Enthaltene Patterns

Das Theme enthält 8 fertige Block Patterns in der Kategorie "GSG":

1. **GSG Hero Section** - Startseiten-Hero mit Statistiken
2. **GSG News Grid** - 3-spaltige News-Übersicht
3. **GSG Fachbereiche** - 6 Fachbereich-Cards
4. **GSG Termine Liste** - Event-Cards mit Datum
5. **GSG Anmeldung CTA** - Call-to-Action Sektion
6. **GSG Info Box** - Hervorgehobene Info-Box
7. **GSG Accent Box** - Gelbe Highlight-Box
8. **GSG Statistiken** - 4 Statistik-Boxen

### Patterns verwenden:

```
1. Seite bearbeiten
2. (+) Symbol klicken (Block Inserter)
3. "Patterns" Tab wählen (NICHT "Vorlagen"!)
4. Kategorie "GSG" auswählen
5. Pattern einfügen
```

**Wichtig:** Patterns sind unter **"Patterns"** zu finden, NICHT unter "Vorlagen" (Templates)!

## 📄 Templates

### Verfügbare Templates:

- **home.html** - Startseiten-Template mit allen Patterns
- Weitere Templates werden automatisch von Ollie bereitgestellt

### Template verwenden:

```
1. Seite bearbeiten
2. Seiteneinstellungen (Sidebar rechts)
3. Template > "Home" auswählen
```

## 🎯 Farbschema

Alle Farben aus dem GSG Logo:

| Farbe | Hex | Verwendung |
|-------|-----|------------|
| GSG Navy | #1E3A5F | Hauptfarbe, Überschriften |
| GSG Blue | #2B4B6F | Sekundärfarbe, Links |
| GSG Gray | #B8BCC4 | Neutrale Akzente |
| GSG Light Gray | #E8EAED | Hintergründe |
| GSG Yellow | #E5B533 | Call-to-Action, Akzente |
| GSG Gold | #D4A017 | Hover-States |

## ⚙️ Features

- ✅ theme.json mit vollständigem Design System
- ✅ 8 vorgefertigte Block Patterns
- ✅ Header & Footer Template Parts
- ✅ Responsive Design (Mobile-First)
- ✅ Accessibility-optimiert (WCAG 2.1)
- ✅ Performance-optimiert
- ✅ SEO-freundlich
- ✅ FSE-optimiert (keine Widgets/Menüs)
- ✅ Inter Schriftart (Google Fonts)

## 🚀 Quick Start - Startseite erstellen

```
1. Seiten > Neu hinzufügen
2. Titel: "Home"
3. Template: "Home" auswählen
4. Patterns werden automatisch eingefügt
5. Texte anpassen
6. Veröffentlichen
7. Einstellungen > Lesen > Statische Startseite > "Home" wählen
```

## 🔧 Anpassungen

### Farben ändern:

```
Site Editor > Styles > Colors
Alle GSG-Farben sind verfügbar
```

### Eigene Patterns erstellen:

```php
// In patterns.php neue Pattern-Funktion hinzufügen
function gsg_register_mein_pattern() {
    register_block_pattern(
        'gsg/mein-pattern',
        array(
            'title' => 'Mein Pattern',
            'categories' => array('gsg-patterns'),
            'content' => '<!-- Block Code -->'
        )
    );
}
add_action('init', 'gsg_register_mein_pattern');
```

## 🔌 Empfohlene Plugins

- **The Events Calendar** - Für Termin-Verwaltung
- **WPForms** oder **Contact Form 7** - Für Formulare
- **Yoast SEO** oder **Rank Math** - Für SEO
- **ShortPixel** - Für Bildoptimierung

## ♿ Accessibility

Das Theme ist WCAG 2.1 AA konform:

- ✅ Semantisches HTML
- ✅ ARIA Labels
- ✅ Keyboard-Navigation
- ✅ Screen-Reader optimiert
- ✅ Farbkontraste geprüft
- ✅ Focus-Styles
- ✅ Reduced Motion Support

## 🐛 Troubleshooting

### Patterns erscheinen nicht?

```
1. Prüfe ob Ollie Parent Theme installiert ist
2. Cache leeren (Browser + WordPress)
3. Theme neu aktivieren
```

### Farben werden nicht übernommen?

```
1. Site Editor > Styles > Reset to defaults
2. Seite neu laden
3. theme.json auf Syntax-Fehler prüfen
```

### Template wird nicht angezeigt?

```
1. Einstellungen > Permalinks > Änderungen speichern
2. Cache leeren
3. Theme neu aktivieren
```

## 📚 Dateistruktur

```
gsg-gymnasium-child/
├── style.css              # Child Theme Stylesheet
├── theme.json             # Design System Definition
├── functions.php          # Theme Funktionen & Features
├── patterns.php           # Block Patterns
├── README.md             # Diese Datei
├── parts/
│   ├── header.html       # Header Template Part
│   └── footer.html       # Footer Template Part
└── templates/
    └── home.html         # Startseiten-Template
```

## 🆘 Support

Bei Fragen oder Problemen:

1. README.md lesen
2. [WordPress Support Foren](https://wordpress.org/support/)
3. [Ollie Theme Dokumentation](https://olliewp.com/documentation/)

## 📄 Lizenz

GNU General Public License v2 or later

## 👥 Credits

- **Design:** Basierend auf GSG Corporate Identity
- **Entwicklung:** GSG Gymnasium IT-Team
- **Parent Theme:** [Ollie by Mike McAlister](https://olliewp.com/)

---

**Version:** 1.0.0
**Letzte Aktualisierung:** März 2026
**WordPress Version:** 6.4+
**PHP Version:** 7.4+

Viel Erfolg mit Ihrer GSG Gymnasium Website! 🎓
